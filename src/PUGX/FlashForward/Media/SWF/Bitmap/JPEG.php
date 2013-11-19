<?php

namespace PUGX\FlashForward\Bitmap;

use PUGX\FlashForward\Media\SWF\Bitmap;
use PUGX\FlashForward\IO\JPEG as IOJPEG;

class JPEG extends Bitmap
{
    public function build()
    {
        $jpegdata = file_get_contents($this->image_file);

        $swf_jpeg = new IOJPEG();
        $swf_jpeg->input($jpegdata);
        $jpeg_table = $swf_jpeg->getEncodingTables();
        $jpeg_image = $swf_jpeg->getImageData();

        $this->code    = 21;
        $this->content = $jpeg_table . $jpeg_image;
    }
}
