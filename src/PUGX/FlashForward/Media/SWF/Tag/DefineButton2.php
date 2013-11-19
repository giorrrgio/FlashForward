<?php

namespace PUGX\FlashForward\Media\SWF\Tag;

use PUGX\FlashForward\Media\SWF\Parser;
use PUGX\FlashForward\Media\SWF\Tag;

class DefineButton2 extends Tag
{
    public function parse(Parser $reader)
    {
        $this->_fields['CharacterId'] = $reader->getUI16LE(); // CharacterId
        $this->reset($reader);
        parent::parse($reader);
    }

    public function getDictionaryArray()
    {
        return false;
    }
}
