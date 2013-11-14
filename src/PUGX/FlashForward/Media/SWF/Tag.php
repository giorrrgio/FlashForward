<?php

namespace PUGX\FlashForward\Media\SWF;

class Tag
{
  const END                               = 0;
  const SHOW_FRAME                        = 1;
  const DEFINE_SHAPE                      = 2;
  const FREE_CHARACTER                    = 3;
  const PLACE_OBJECT                      = 4;
  const REMOVE_OBJECT                     = 5;
  const DEFINE_BITS                       = 6;
  const DEFINE_BUTTON                     = 7;
  const JPEGTABLES                        = 8;
  const SET_BACKGROUND_COLOR              = 9;
  const DEFINE_FONT                       = 10;
  const DEFINE_TEXT                       = 11;
  const DO_ACTION                         = 12;
  const DEFINE_FONT_INFO                  = 13;
  const DEFINE_SOUND                      = 14;
  const START_SOUND                       = 15;
  const STOP_SOUND                        = 16;
  const DEFINE_BUTTON_SOUND               = 17;
  const SOUND_STREAM_HEAD                 = 18;
  const SOUND_STREAM_BLOCK                = 19;
  const DEFINE_BITS_LOSSLESS              = 20;
  const DEFINE_BITS_JPEG2                 = 21;
  const DEFINE_SHAPE2                     = 22;
  const DEFINE_BUTTON_CXFORM              = 23;
  const PROTECT                           = 24;
  const PATHS_ARE_POSTSCRIPT              = 25;
  const PLACE_OBJECT2                     = 26;
  const REMOVE_OBJECT2                    = 28;
  const SYNC_FRAME                        = 29;
  const FREE_ALL                          = 31;
  const DEFINE_SHAPE3                     = 32;
  const DEFINE_TEXT2                      = 33;
  const DEFINE_BUTTON2                    = 34;
  const DEFINE_BITS_JPEG3                 = 35;
  const DEFINE_BITS_LOSSLESS2             = 36;
  const DEFINE_EDIT_TEXT                  = 37;
  const DEFINE_VIDEO                      = 38;
  const DEFINE_SPRITE                     = 39;
  const NAME_CHARACTER                    = 40;
  const PRODUCT_INFO                      = 41;
  const DEFINE_TEXT_FORMAT                = 42;
  const FRAME_LABEL                       = 43;
  const SOUND_STREAM_HEAD2                = 45;
  const DEFINE_MORPH_SHAPE                = 46;
  const GENERATE_FRAME                    = 47;
  const DEFINE_FONT2                      = 48;
  const GENERATOR_COMMAND                 = 49;
  const DEFINE_COMMAND_OBJECT             = 50;
  const CHARACTER_SET                     = 51;
  const EXTERNAL_FONT                     = 52;
  const EXPORT_ASSETS                     = 56;
  const IMPORT_ASSETS                     = 57;
  const ENABLE_DEBUGGER                   = 58;
  const DO_INIT_ACTION                    = 59;
  const DEFINE_VIDEO_STREAM               = 60;
  const VIDEO_FRAME                       = 61;
  const DEFINE_FONT_INFO2                 = 62;
  const DEBUG_ID                          = 63;
  const ENABLE_DEBUGGER2                  = 64;
  const SCRIPT_LIMITS                     = 65;
  const SET_TAB_INDEX                     = 66;
  const FILE_ATTRIBUTES                   = 69;
  const PLACE_OBJECT3                     = 70;
  const IMPORT_ASSETS2                    = 71;
  const DEFINE_FONT_ALIGN_ZONES           = 73;
  const CSMTEXT_SETTINGS                  = 74;
  const DEFINE_FONT3                      = 75;
  const SYMBOL_CLASS                      = 76;
  const METADATA                          = 77;
  const DEFINE_SCALING_GRID               = 78;
  const DO_ABC                            = 82;
  const DEFINE_SHAPE4                     = 83;
  const DEFINE_MORPH_SHAPE2               = 84;
  const DEFINE_SCENE_AND_FRAME_LABEL_DATA = 86;
  const DEFINE_BINARY_DATA                = 87;
  const DEFINE_FONT_NAME                  = 88;
  const START_SOUND2                      = 89;
  const DEFINE_BITS_JPEG4                 = 90;
  const DEFINE_FONT4                      = 91;


  public static $names = array(
      0  => '\PUGX\FlashForward\Media\SWF\Tag\End',
      1  => '\PUGX\FlashForward\Media\SWF\Tag\ShowFrame',
      2  => '\PUGX\FlashForward\Media\SWF\Tag\DefineShape',
      3  => '\PUGX\FlashForward\Media\SWF\Tag\FreeCharacter',
      4  => '\PUGX\FlashForward\Media\SWF\Tag\PlaceObject',
      5  => '\PUGX\FlashForward\Media\SWF\Tag\RemoveObject',
      6  => '\PUGX\FlashForward\Media\SWF\Tag\DefineBits',
      7  => '\PUGX\FlashForward\Media\SWF\Tag\DefineButton',
      8  => '\PUGX\FlashForward\Media\SWF\Tag\JPEGTables',
      9  => '\PUGX\FlashForward\Media\SWF\Tag\SetBackgroundColor',
      10 => '\PUGX\FlashForward\Media\SWF\Tag\DefineFont',
      11 => '\PUGX\FlashForward\Media\SWF\Tag\DefineText',
      12 => '\PUGX\FlashForward\Media\SWF\Tag\DoAction',
      13 => '\PUGX\FlashForward\Media\SWF\Tag\DefineFontInfo',
      14 => '\PUGX\FlashForward\Media\SWF\Tag\DefineSound',
      15 => '\PUGX\FlashForward\Media\SWF\Tag\StartSound',
      16 => '\PUGX\FlashForward\Media\SWF\Tag\StopSound',
      17 => '\PUGX\FlashForward\Media\SWF\Tag\DefineButtonSound',
      18 => '\PUGX\FlashForward\Media\SWF\Tag\SoundStreamHead',
      19 => '\PUGX\FlashForward\Media\SWF\Tag\SoundStreamBlock',
      20 => '\PUGX\FlashForward\Media\SWF\Tag\DefineBitsLossless',
      21 => '\PUGX\FlashForward\Media\SWF\Tag\DefineBitsJPEG2',
      22 => '\PUGX\FlashForward\Media\SWF\Tag\DefineShape2',
      23 => '\PUGX\FlashForward\Media\SWF\Tag\DefineButtonCxform',
      24 => '\PUGX\FlashForward\Media\SWF\Tag\Protect',
      25 => '\PUGX\FlashForward\Media\SWF\Tag\PathsArePostscript',
      26 => '\PUGX\FlashForward\Media\SWF\Tag\PlaceObject2',
      28 => '\PUGX\FlashForward\Media\SWF\Tag\RemoveObject2',
      29 => '\PUGX\FlashForward\Media\SWF\Tag\SyncFrame',
      31 => '\PUGX\FlashForward\Media\SWF\Tag\FreeAll',
      32 => '\PUGX\FlashForward\Media\SWF\Tag\DefineShape3',
      33 => '\PUGX\FlashForward\Media\SWF\Tag\DefineText2',
      34 => '\PUGX\FlashForward\Media\SWF\Tag\DefineButton2',
      35 => '\PUGX\FlashForward\Media\SWF\Tag\DefineBitsJPEG3',
      36 => '\PUGX\FlashForward\Media\SWF\Tag\DefineBitsLossless2',
      37 => '\PUGX\FlashForward\Media\SWF\Tag\DefineEditText',
      38 => '\PUGX\FlashForward\Media\SWF\Tag\DefineVideo',
      39 => '\PUGX\FlashForward\Media\SWF\Tag\DefineSprite',
      40 => '\PUGX\FlashForward\Media\SWF\Tag\NameCharacter',
      41 => '\PUGX\FlashForward\Media\SWF\Tag\ProductInfo',
      42 => '\PUGX\FlashForward\Media\SWF\Tag\DefineTextFormat',
      43 => '\PUGX\FlashForward\Media\SWF\Tag\FrameLabel',
      45 => '\PUGX\FlashForward\Media\SWF\Tag\SoundStreamHead2',
      46 => '\PUGX\FlashForward\Media\SWF\Tag\DefineMorphShape',
      47 => '\PUGX\FlashForward\Media\SWF\Tag\GenerateFrame',
      48 => '\PUGX\FlashForward\Media\SWF\Tag\DefineFont2',
      49 => '\PUGX\FlashForward\Media\SWF\Tag\GeneratorCommand',
      50 => '\PUGX\FlashForward\Media\SWF\Tag\DefineCommandObject',
      51 => '\PUGX\FlashForward\Media\SWF\Tag\CharacterSet',
      52 => '\PUGX\FlashForward\Media\SWF\Tag\ExternalFont',
      56 => '\PUGX\FlashForward\Media\SWF\Tag\ExportAssets',
      57 => '\PUGX\FlashForward\Media\SWF\Tag\ImportAssets',
      58 => '\PUGX\FlashForward\Media\SWF\Tag\EnableDebugger',
      59 => '\PUGX\FlashForward\Media\SWF\Tag\DoInitAction',
      60 => '\PUGX\FlashForward\Media\SWF\Tag\DefineVideoStream',
      61 => '\PUGX\FlashForward\Media\SWF\Tag\VideoFrame',
      62 => '\PUGX\FlashForward\Media\SWF\Tag\DefineFontInfo2',
      63 => '\PUGX\FlashForward\Media\SWF\Tag\DebugID',
      64 => '\PUGX\FlashForward\Media\SWF\Tag\EnableDebugger2',
      65 => '\PUGX\FlashForward\Media\SWF\Tag\ScriptLimits',
      66 => '\PUGX\FlashForward\Media\SWF\Tag\SetTabIndex',
      69 => '\PUGX\FlashForward\Media\SWF\Tag\FileAttributes',
      70 => '\PUGX\FlashForward\Media\SWF\Tag\PlaceObject3',
      71 => '\PUGX\FlashForward\Media\SWF\Tag\ImportAssets2',
      73 => '\PUGX\FlashForward\Media\SWF\Tag\DefineFontAlignZones',
      74 => '\PUGX\FlashForward\Media\SWF\Tag\CSMTextSettings',
      75 => '\PUGX\FlashForward\Media\SWF\Tag\DefineFont3',
      76 => '\PUGX\FlashForward\Media\SWF\Tag\SymbolClass',
      77 => '\PUGX\FlashForward\Media\SWF\Tag\Metadata',
      78 => '\PUGX\FlashForward\Media\SWF\Tag\DefineScalingGrid',
      82 => '\PUGX\FlashForward\Media\SWF\Tag\DoABC',
      83 => '\PUGX\FlashForward\Media\SWF\Tag\DefineShape4',
      84 => '\PUGX\FlashForward\Media\SWF\Tag\DefineMorphShape2',
      86 => '\PUGX\FlashForward\Media\SWF\Tag\DefineSceneAndFrameLabelData',
      87 => '\PUGX\FlashForward\Media\SWF\Tag\DefineBinaryData',
      88 => '\PUGX\FlashForward\Media\SWF\Tag\DefineFontName',
      89 => '\PUGX\FlashForward\Media\SWF\Tag\StartSound2',
      90 => '\PUGX\FlashForward\Media\SWF\Tag\DefineBitsJPEG4',
      91 => '\PUGX\FlashForward\Media\SWF\Tag\DefineFont4',
  );
  
  public static function name($code)
  {
    return isset(self::$names[$code]) ? self::$names[$code] : "";
  }

  public
    $firstParentId = false;
  
  protected
    $root,
    $content,
    $code,
    $length,
    $longFormat,
    $offset,
    $characterId,
    $type,
    $_fields;

  public function __construct($code, $length = null, $longFormat = null, Parser $reader = null, $root = null)
  {
    $this->code   = $code;
    $this->length = $length;
    $this->longFormat = $longFormat;
    $this->root = $root;

    $this->offset = $reader->getByteOffset();
    $this->parse($reader);

    if (!$this->isDisplayListTag() && $this->hasField('CharacterId')) {
      $this->characterId = $this->getField('CharacterId');
    }
  }

  public function isDisplayListTag()
  {
    return false;
  }

  public function isDefinitionTag()
  {
    if ($this->isDisplayListTag()) {
      return false;
    } 
    return $this->hasField('CharacterId');
  }

  public function getFirstParentTag()
  {
    return ($this->firstParentId) ? $this->root->getTagByCharacterId($this->firstParentId): $this->root;
  }

  public function getGroupName()
  {
    if ($this->root->useCompactSaveMode) {
      return $this->root->getGroupName();
    }
    $parent = $this->getFirstParentTag();
    if (empty($this->name)) {
      return $parent->getGroupName();
    }
    return $parent->getGroupName().$this->name.".";
  }

  public function getCharacterId()
  {
    return $this->characterId;
  }

  public function getElementIdString()
  {
    return 'cid_'.$this->getCharacterId();
  }

  public function getElementType()
  {
    return $this->type ? $this->type : "unknown";
  }

  public function getElementSavedUrl()
  {
    return false;
  }

  public function getDictionaryArray()
  {
    return array(
      'cid' => $this->getElementIdString(),
      'type'=> $this->getElementType(),
      'url' => $this->getElementSavedUrl(),
    );
  }

  public function getCode()
  {
    return $this->code;
  }

  public function getTagName()
  {
    return self::name($this->code);
  }

  public function getFields()
  {
    return $this->_fields;
  }

  public function hasField($field)
  {
    return empty($this->_fields[$field]) ? false : true;
  }

  public function getField($field)
  {
    return isset($this->_fields[$field]) ? $this->_fields[$field] : null;
  }

  public function setField($field, $value)
  {
    $this->_fields[$field] = $value;
  }

  public function parseContent($content)
  {
    $reader = new Parser();
    $reader->input($content);
    $this->parse($reader);
  }

  public function parse(Parser $reader)
  {
    $this->content = $reader->getData($this->length);
  }

  public function reset(Parser $reader)
  {
    $reader->byteAlign();
    list($byte_offset, $bit_offset) = $reader->getOffset();
    $reader->setOffset($this->offset, $bit_offset);
  }

  public function getRest(Parser $reader)
  {
    return $reader->getData($this->length - $reader->getByteOffset() + $this->offset);
  }

  public function write(Parser $writer)
  {
    $content = $this->build();
    $this->length = strlen($content);

    $this->writeCodeAndLength($writer);
    $writer->putData($content);
  }

  public function writeCodeAndLength(Parser $writer)
  {
    $writer->putCodeAndLength(array(
      'Code'       => $this->code,
      'Length'     => $this->length,
      'LongFormat' => $this->longFormat,
    ));
  }

  public function build()
  {
    return $this->content;
  }

  public function dump($indent)
  {
    return array();
  }
}
