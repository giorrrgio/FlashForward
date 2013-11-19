<?php

namespace PUGX\FlashForward\Media\SWF\Tag;

use PUGX\FlashForward\Media\SWF\Parser;
use PUGX\FlashForward\Media\SWF\Tag;

class SetBackgroundColor extends Tag
{
    public function parse(Parser $reader)
    {
        $this->_fields['BackgroundColor'] = $reader->getRGB();
        $this->reset($reader);
        parent::parse($reader);
    }
}
