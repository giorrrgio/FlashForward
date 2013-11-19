<?php

namespace PUGX\FlashForward\Media\Canvas;

use PUGX\FlashForward\Media\SVG;

class Converter
{
    protected $svg;
    protected $defsTree;
    protected $planeNodeTree;

    public function __construct ($svg)
    {
        $this->svg = $svg;
        $this->canvasTree = array();
        $this->paths = array();
        $this->planeNodeTree = array();
    }

    public function toEaselJson()
    {
        $this->convertDefs();
        $this->convertUses();

        return json_encode($this->canvasTree);
    }

    protected function createContainer(SVG\Element $node)
    {
        return array(
            'type' => 'Container',
            'transform' => $node->has('transform') ? $node->get('transform')['matrix']: null,
            'polyname' => $node->get('name')
        );
    }

    private function hex2rgb($hex)
    {
        // strip off any leading #
        if (0 === strpos($hex, '#')) {
            $hex = substr($hex, 1);
        } else if (0 === strpos($hex, '&H')) {
            $hex = substr($hex, 2);
        }

        // break into hex 3-tuple
        $cutpoint = ceil(strlen($hex) / 2)-1;
        $rgbHex = explode(':', wordwrap($hex, $cutpoint, ':', $cutpoint), 3);

        $rgb = array();
        // convert each tuple to decimal
        $rgb['r'] = (isset($rgbHex[0]) ? hexdec($rgbHex[0]) : 0);
        $rgb['g'] = (isset($rgbHex[1]) ? hexdec($rgbHex[1]) : 0);
        $rgb['b'] = (isset($rgbHex[2]) ? hexdec($rgbHex[2]) : 0);

        return $rgb;
    }

    protected function canvasDraw($svgAttributes)
    {
        $draw = array();
        $draw[] = array(
            'type'       => 'beginFill',
            'properties' => array(
                'fill' => $this->hex2rgb($svgAttributes['fill'])
            )
        );
        foreach ($svgAttributes as $key => $val) {
            $j = 0;
            if ($key == "d") {
                foreach ($val as $b) {
                    if ($b === "M") {
                        $params = array($val[$j+1], $val[$j+2]);
                        $draw[] = array(
                            'type'       => 'moveTo',
                            'properties' => array(
                                'x' => $params[0],
                                'y' => $params[1]
                            )
                        );
                        $test = 2;
                    } elseif ($b === "C") {
                        $params = array($val[$j+1], $val[$j+2], $val[$j+3], $val[$j+4], $val[$j+5], $val[$j+6]);
                        for ($i = 0; $i < (sizeof($params) - 6); $i +=6) {
                            $offset = $i;
                            $draw[] = array(
                                'type'       => 'bezierCurveTo',
                                'properties' => array(
                                    'cp1x' => $params[$offset],
                                    'cp1y' => $params[$offset + 1],
                                    'cp2x' => $params[$offset + 2],
                                    'cp2y' => $params[$offset + 3],
                                    'x' => $params[$offset + 4],
                                    'y' => $params[$offset + 5]
                                )
                            );
                        }
                    } elseif ($b === "L") {
                        $i = 1;
                        $next = 1;
                        while (is_numeric($next)) {
                            $currX = $val[$j+$i];
                            $currY = $val[$j+$i+1];
                            $params = array($currX, $currY);
                            $draw[] = array(
                                'type'       => 'lineTo',
                                'properties' => array(
                                    'x' => $params[0],
                                    'y' => $params[1]
                                )
                            );
                            $next = $val[$j+$i+2];
                            $i+=2;
                        }
                        $test = 3;
                    } elseif ($b === "Z") {
                        $draw[] = array(
                            'type'       => 'closePath'
                        );
                    } elseif ($b === "Q") {
                        $i = 1;
                        $next = 1;
                        while (is_numeric($next)) {
                            $currCPX = $val[$j+$i];
                            $currCPY = $val[$j+$i+1];
                            $currX = $val[$j+$i+2];
                            $currY = $val[$j+$i+3];
                            $params = array($currCPX, $currCPY, $currX, $currY);
                            $draw[] = array(
                                'type'       => 'quadraticCurveTo',
                                'properties' => array(
                                    'cpx' => $params[0],
                                    'cpy' => $params[1],
                                    'x' => $params[2],
                                    'y' => $params[3]
                                )
                            );
                            $next = $val[$j+$i+4];
                            $i+=4;
                        }
                    }
                    $j++;
                }
                /*                $results = array_filter($bang, $shall_i_clean);
                                echo "ctx.beginPath();n";
                                foreach ($results as $r) {
                                    echo $r . "n";
                                }
                                echo "ctx.stroke();nctx.fill();n";*/
            }
        }
        return array(
            'index' => 0,
            'type' => 'Shape',
            'graphics' => array(
                'draw' => $draw
            )
        );
    }

    protected function parseNode($node)
    {
        $res = null;
        if ('g' == $node->getName()) {
            $res = $this->createContainer($node);
            foreach ($node->getNode() as $childNode) {
                $res['children'][uniqid()] = $this->parseNode($childNode);
            }
        } elseif ('path' == $node->getName()) {
            $res = $this->canvasDraw($node->createArray());
        } elseif ('use' == $node->getName()) {
            $href = str_replace('#','',$node->get('href'));
            $container = $this->createContainer($node);
            $container['children'][uniqid()] = $this->planeNodeTree[$href];
            $res = $container;
        }

        if ($node->get('id')) {
            $this->planeNodeTree[$node->get('id')] = $res;
        }
        return $res;
    }

    public function convertDefs()
    {
        foreach ($this->svg['defs'] as $node) {
            foreach ($node->getNode() as $childNode) {
                $this->defsTree[] = $this->parseNode($childNode);
            }
        }
    }

    public function convertUses()
    {
        $this->canvasTree['elements']['mainContainer'] = array(
            'type' => 'Container',
            'properties' => array(
                'scaleX' => 0.01,
                'scaleY' => 0.01
            )
        );
        foreach ($this->svg['display']->getNode() as $node) {
            foreach ($node->getNode() as $childNode) {
                $container = $this->createContainer($childNode);
                $href = str_replace('#','',$childNode->get('href'));
                $container['children'][uniqid()] = $this->planeNodeTree[$href];
                $this->canvasTree['elements']['mainContainer']['children'][uniqid()] = $container;
            }
        }
    }
}