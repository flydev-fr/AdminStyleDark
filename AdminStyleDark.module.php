<?php namespace ProcessWire;

require_once wire('config')->paths->siteModules . "Less/AdminStyle.php";

class AdminStyleDark extends WireData implements Module {

  use AdminStyle;

  public static function getModuleInfo() {
    $package = json_decode(file_get_contents(__DIR__ . "/package.json"));
    
    return [
      'title' => 'AdminStyleDark',
      'version' => $package->version,
      'summary' => 'Dark Style for AdminThemeUikit',
      'autoload' => true,
      'singular' => true,
      'icon' => 'moon-o',
      'requires' => [
        'ProcessWire>=3.0.178',
        'Less>=4',
      ],
      'installs' => [
      ],
    ];
  }

  public function ready() {
    $this->loadStyle(__DIR__ . "/style/dark.less");
  }
}
