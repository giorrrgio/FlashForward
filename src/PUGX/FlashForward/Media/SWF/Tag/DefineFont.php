<?php

namespace PUGX\FlashForward\Media\SWF\Tag;

use PUGX\FlashForward\Media\SWF\Parser;
use PUGX\FlashForward\Media\SWF\Tag;

class DefineFont extends Tag
{
    public function parse(Parser $reader)
    {
        $this->_fields = array(
            'FontID' => $reader->getUI16LE(),
        );
        $this->reset($reader);
        parent::parse($reader);
    }
}
