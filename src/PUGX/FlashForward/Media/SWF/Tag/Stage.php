<?php

namespace PUGX\FlashForward\Media\SWF\Tag;

// Topレベル
use PUGX\FlashForward\Media\SVG;
use PUGX\FlashForward\Media\SWF\Parser;
use PUGX\FlashForward\Media\SWF\Tag;

class Stage extends DisplayObjectContainer
{
    protected
        $name = "root",
        $_headers = array();

    public
        $saveWithCompress = false,
        $useCompactSaveMode = false,
        $shapeConvertType = 'svg';

    public function __construct()
    {
        $this->root = $this;
    }

    public function loadFromString($swfdata)
    {
        $reader = new Parser();
        $reader->input($swfdata);
        $this->parse($reader);
    }

    public function getHeaders()
    {
        return $this->_headers;
    }

    public function getHeader($name)
    {
        return isset($this->_headers[$name]) ? $this->_headers[$name] : null;
    }

    public function getVersion()
    {
        return $this->getHeader('Version');
    }

    public function getSize()
    {
        return $this->getHeader('FileLength');
    }

    public function getFrameRate()
    {
        return $this->getHeader('FrameRate') / 0x100;
    }

    public function getFrameCount()
    {
        return $this->getHeader('FrameCount');
    }

    public function getWidth()
    {
        $rect = $this->getHeader('FrameSize');
        return ($rect['Xmax'] - $rect['Xmin']) / 20;
    }

    public function getHeight()
    {
        $rect = $this->getHeader('FrameSize');
        return ($rect['Ymax'] - $rect['Ymin']) / 20;
    }

    public function getBackgroundColor()
    {
        foreach ($this->_tags as $tag) {
            if ($tag->getCode() === Tag::SET_BACKGROUND_COLOR) {
                $color = $tag->getField('BackgroundColor');
                return sprintf("#%02x%02x%02x", $color['Red'], $color['Green'], $color['Blue']);
            }
        }
        return null;
    }

    public function getTagByCharacterId($characterId)
    {
        foreach ($this->_tags as $tag) {
            if ($tag->getCharacterId() === $characterId) {
                return $tag;
            }
        }
        return null;
    }

    public function parse(Parser $reader)
    {
        $this->_headers = $reader->getSWFHeader();
        parent::parse($reader);
    }

    public function build()
    {
        $writer = new Parser();
        $writer->putSWFHeader($this->_headers);
        foreach ($this->_tags as $tag) {
            $tag->write($writer);
        }
        $fileLength                   = $writer->getByteOffset();
        $this->_headers['FileLength'] = $fileLength;
        $writer->setFileLength($fileLength);
        return $writer->output();
    }

    public function getElementIdString()
    {
        return 'root';
    }

    public function getDefinitionTags()
    {
        $definitionTags = array();
        foreach ($this->_tags as $tag) {
            if ($tag && $tag->isDefinitionTag()) {
                $definitionTags[] = $tag;
            }
        }
        return $definitionTags;
    }

    public function getSVGDefinitions($exclude_tags = false)
    {
        if ($exclude_tags === false) {
            $exclude_tags = array(
                Tag::DEFINE_SPRITE,
                Tag::DEFINE_BITS,
                Tag::DEFINE_BITS_JPEG2,
                Tag::DEFINE_BITS_JPEG3,
                Tag::DEFINE_BITS_JPEG4,
                Tag::DEFINE_BITS_LOSSLESS,
                Tag::DEFINE_BITS_LOSSLESS2,
            );
        }
        $defsList = array();
        foreach ($this->_tags as $tag) {
            if ($tag && $tag->isDefinitionTag() && method_exists($tag, 'convertSVG')) {
                $url = $tag->getElementSavedUrl();
                if (!isset($defsList[$url])) {
                    $defsList[$url] = SVG::newElement('defs');
                }
                if (in_array($tag->getCode(), $exclude_tags)) {
                    continue;
                }
                $defsList[$url]->addNode($tag->convertSVG());
            }
        }
        return $defsList;
    }

    public function getArrayDefinitions()
    {
        $defsList = array();
        foreach ($this->_tags as $tag) {
            if ($tag && $tag->isDefinitionTag() && method_exists($tag, 'convertArray')) {
                if (!isset($defsList[$tag->getElementSavedUrl()])) {
                    $defsList[$tag->getElementSavedUrl()] = array();
                }
                $url = $tag->getElementSavedUrl();
                if (!isset($defsList[$url])) {
                    $defsList[$url] = array();
                }
                $defsList[$url][$tag->getElementIdString()] = $tag->convertArray();
            }
        }
        return $defsList;
    }

    public function getResourceTags()
    {
        $defs = array();
        foreach ($this->_tags as $tag) {
            if ($tag && $tag->isDefinitionTag() && method_exists($tag, 'convertImageData')) {
                $defs[] = $tag;
            }
        }
        return $defs;
    }

    public function convertSVG()
    {
        $frameSize  = $this->getHeader('FrameSize');
        $frameRate  = $this->getHeader('FrameRate');
        $frameCount = $this->getHeader('FrameCount');

        $svg = new SVG($frameSize['Xmax'] / 20, $frameSize['Ymax'] / 20);
        //$defs = Media_SVG::newElement('defs');

        // Definition
        $defs = $this->getSVGDefinitions(array());

        $display = parent::convertSVG();

        foreach ($defs as $def) {
            $svg->addNode($def);
        }
        $svg->addNode($display->set('transform', 'scale(0.05)'));
        return $svg;
    }

    public function convertCanvas()
    {
        $frameSize  = $this->getHeader('FrameSize');
        $frameRate  = $this->getHeader('FrameRate');
        $frameCount = $this->getHeader('FrameCount');

        $svg = new SVG($frameSize['Xmax'] / 20, $frameSize['Ymax'] / 20);
        //$defs = Media_SVG::newElement('defs');

        // Definition
        $defs = $this->getSVGDefinitions(array());

        $display = parent::convertSVG();

        return compact('frameSize', 'defs', 'display');
    }

    public function convertArray()
    {
        return array(
            'meta' => $this->getMetaArray(),
            'dict' => $this->getDictionaryArray(),
            'ctls' => $this->getControlsArray(),
        );
    }

    public function getMetaArray()
    {
        $rect = $this->getHeader('FrameSize');
        return array(
            'version' => $this->getVersion(),
            'fcon'    => $this->getFrameCount(),
            'fps'     => $this->getFrameRate(),
            'bgcolor' => $this->getBackgroundColor(),
            'size'    => array(
                $rect['Xmin'],
                $rect['Ymin'],
                $rect['Xmax'],
                $rect['Ymax'],
            ),
        );
    }

    public function getDictionaryArray()
    {
        $ret = array();
        foreach ($this->_tags as $tag) {
            if ($tag && $tag->isDefinitionTag()) {
                $def = $tag->getDictionaryArray();
                if ($def) $ret[] = $def;
            }
        }
        return $ret;
    }

    public function convertEncoding($value)
    {
        if ($this->getVersion() <= 4.0) {
            return mb_convert_encoding($value, 'utf-8', 'sjis-win');
        }
        return $value;
    }

    public function getGroupName()
    {
        return "";
    }

}
