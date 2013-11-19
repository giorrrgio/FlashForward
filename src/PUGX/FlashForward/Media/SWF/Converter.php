<?php

namespace PUGX\FlashForward\Media\SWF;

use PUGX\FlashForward\Media\SVG;
use PUGX\FlashForward\Media\SWF\Tag\Stage;

/**
 * Media_SWF_Converter
 *
 * @package   Media_SWF
 * @version   $Id$
 * @copyright Copyright (C) 2010 KAYAC Inc.
 * @author    Kensaku Araga <araga-kensaku@kayac.com>
 */
class Converter
{
    public $stage;

    public function parse($swfdata)
    {
        $this->stage = new Stage();
        $this->stage->loadFromString($swfdata);
    }

    public function toSVG()
    {
        $svg = $this->toSVGObject();
        return $svg->toString();
    }

    public function toCanvas()
    {
        return $this->stage->convertCanvas();
    }

    public function toJSON()
    {
        $array = $this->stage->convertArray();
        return json_encode($array);
    }

    public function toEaselJsJson()
    {
        $svg = $this->stage->convertEaselJsBuilderJson();
        return $svg->toString();
    }

    public function saveDeliveryContent($directory, $image_as_svg = false)
    {
        if (!file_exists($directory)) {
            mkdir($directory, 0775);
        }

        file_put_contents($directory . '/index.json', json_encode($this->stage->convertArray()));

        if (!file_exists($directory . "/defines")) {
            mkdir($directory . "/defines", 0775);
        }

        $excules = ($image_as_svg) ? array(Tag::DEFINE_SPRITE) : false;

        // Shapes
        $frameSize = $this->stage->getHeader('FrameSize');
        $defsList  = $this->stage->getSVGDefinitions($excules);

        foreach ($defsList as $savedName => $defs) {
            $svg = new SVG($frameSize['Xmax'], $frameSize['Ymax']);
            $svg->addNode($defs);
            file_put_contents($directory . '/' . $savedName, $svg->toString($this->stage->saveWithCompress));
            $svg = null;
        }

        // for canvas
        // file_put_contents($directory.'/shapes.json', json_encode($defs->createArray()));

        // JSON
        $defsList = $this->stage->getArrayDefinitions();
        foreach ($defsList as $savedName => $defs) {
            file_put_contents($directory . '/' . $savedName, json_encode($defs));
        }

        // Resouce
        foreach ($this->stage->getResourceTags() as $tag) {
            $image = $tag->convertImageData();
            file_put_contents($directory . '/defines/' . $tag->getElementIdString() . '.' . $tag->filetype, $image);
        }
        return true;
    }
}
