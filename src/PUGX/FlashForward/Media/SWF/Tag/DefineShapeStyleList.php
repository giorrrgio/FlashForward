<?php

namespace PUGX\FlashForward\Media\SWF\Tag;

use PUGX\FlashForward\Media\SVG\Path;

class DefineShapeStyleList
{
    public
        $styles = array(),
        $fillStyle0 = 0,
        $fillStyle1 = 0,
        $lineStyle = 0,
        $fillStyles = array(),
        $lineStyles = array();

    public function setFillStyle0($id)
    {
        $this->fillStyle0 = $id;
    }

    public function setFillStyle1($id)
    {
        $this->fillStyle1 = $id;
    }

    public function setLineStyle($id)
    {
        $this->lineStyle = $id;
    }

    public function addFillStyle($fillStyle)
    {
        $this->fillStyles[] = $fillStyle;
    }

    public function addLineStyle($lineStyle)
    {
        $this->lineStyles[] = $lineStyle;
    }

    public function getFillStyle($id)
    {
        return (isset($this->fillStyles[$id - 1])) ? $this->fillStyles[$id - 1] : null;
    }

    public function getLineStyle($id)
    {
        return (isset($this->lineStyles[$id - 1])) ? $this->lineStyles[$id - 1] : null;
    }

    public function update()
    {
        $this->styles = array();
        if ($this->fillStyle0 > 0) {
            $style = $this->getFillStyle($this->fillStyle0);
            if ($style instanceof Path) $style->direction('+');
            $this->styles[] = $style;
        }
        if ($this->fillStyle1 > 0) {
            $style = $this->getFillStyle($this->fillStyle1);
            if ($style instanceof Path) $style->direction('-');
            $this->styles[] = $style;
        }
        if ($this->lineStyle > 0) {
            $style          = $this->getLineStyle($this->lineStyle);
            $this->styles[] = $style;
        }
        return $this;
    }

    public function moveTo($x, $y)
    {
        foreach ($this->styles as $style) {
            if ($style instanceof Path)
                $style->moveTo($x, $y);
        }
    }

    public function closePath()
    {
        foreach ($this->styles as $style) {
            if ($style instanceof Path)
                $style->closePath();
        }
    }

    public function lineTo($x, $y)
    {
        foreach ($this->styles as $style) {
            if ($style instanceof Path)
                $style->lineTo($x, $y);
        }
    }

    public function curveTo($cx, $cy, $x, $y)
    {
        foreach ($this->styles as $style) {
            if ($style instanceof Path)
                $style->curveTo($cx, $cy, $x, $y);
        }
    }

    public function getAllStyles()
    {
        return array_merge($this->fillStyles, $this->lineStyles);
    }
}
