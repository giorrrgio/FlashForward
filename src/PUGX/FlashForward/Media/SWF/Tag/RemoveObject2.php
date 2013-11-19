<?php

namespace PUGX\FlashForward\Media\SWF\Tag;

use PUGX\FlashForward\IO\Bit;
use PUGX\FlashForward\Media\SWF\Parser;
use PUGX\FlashForward\Media\SWF\Tag;

class RemoveObject2 extends Tag
{
    public function isDisplayListTag()
    {
        return true;
    }

    public function parse(Parser $reader)
    {
        $this->_fields = array(
            'Depth' => $reader->getUI16LE(),
        );
    }

    public function build()
    {
        $writer = new Bit();
        $writer->putUI16LE($this->_fields['Depth']);
        return $writer->output();
    }
}
