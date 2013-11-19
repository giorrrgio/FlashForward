<?php

namespace PUGX\FlashForward\Media\SWF\Tag;

use PUGX\FlashForward\Media\SWF\Parser;
use PUGX\FlashForward\Media\SWF\Tag;

class FrameLabel extends Tag
{
    public function parse(Parser $reader)
    {
        $this->_fields = array(
            'Name' => $reader->getString(),
        );
        $this->reset($reader);
        parent::parse($reader);
    }
}
