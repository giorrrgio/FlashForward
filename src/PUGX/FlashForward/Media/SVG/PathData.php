<?php

namespace PUGX\FlashForward\Media\SVG;

class PathData
{
  public
    $direction = true,
    $currentX = 0,
    $currentY = 0,
    $data = array();

  public function __construct($direction) 
  {
    $this->direction = ($direction == "-") ? false: true;
  }

  public function add($data)
  {
    $this->data[] = $data;
  }

  public function getData()
  {
    if (count($this->data) == 0) {
      return array();
    }
    if ($this->direction) {
      return $this->data;
    } else {
      return array_merge(array(array("M", $this->currentX, $this->currentY)), array_reverse($this->data));
    }
  }
}
