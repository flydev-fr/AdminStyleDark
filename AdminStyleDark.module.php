<?php namespace ProcessWire;

require_once wire('config')->paths->siteModules . "Less/AdminStyle.php";

class AdminStyleDark extends WireData implements Module {

  use AdminStyle;

  public static function getModuleInfo() {
    return [
      'title' => 'AdminStyleDark',
      'version' => '1.0.0',
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
    $this->loadStyle(__DIR__ . "/styles/dark.less");
  }
}
