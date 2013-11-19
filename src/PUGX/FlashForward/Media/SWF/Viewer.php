<?php

namespace PUGX\FlashForward\Media\SWF;

use PUGX\FlashForward\Media\SWF;

class Viewer extends SWF
{
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

    public function getHumanizedDefines()
    {
        $defines = array();
        foreach ($this->_tags as $tag) {
            if (isset($tag['CharacterId'])) {
                $defines[] = array(
                    'TagName'     => Tag::name($tag['Code']),
                    'Code'        => $tag['Code'],
                    'CharacterId' => $tag['CharacterId'],
                    'Length'      => $tag['Length'],
                );
            }
        }
        return $defines;
    }
}
