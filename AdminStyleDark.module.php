<?php namespace ProcessWire;
/**
 * Based on Bernhard Baumrock `AdminStyleRock` module (https://github.com/baumrock/AdminStyleRock)
 */
class AdminStyleDark extends WireData implements Module {

  public $logo;
  public $rockprimary;

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
        'Less',
      ],
      'installs' => [
      ],
    ];
  }

  public function ready() {
    // do everything below only on admin pages
    if($this->wire->page->template != 'admin') return;

    $config = $this->wire()->config;
    $min = !$config->debug;

    $style = $config->paths($this)."styles/dark.less";
    $compiled = $config->paths->assets."admin";
    if($min) $compiled .= ".min.css";
    else $compiled .= ".css";

    // prepare less vars
    $vars = [];

    $config->AdminThemeUikit = [
      'style' => $style,
      'compress' => $min,
      'customCssFile' => $compiled,
      'recompile' => @(filemtime($style) > filemtime($compiled)),
      'vars' => $vars,
    ];
  }

  public function addDarkStyles(HookEvent $event) {
    if($this->wire->page->template == 'admin') return;
    $rf = $event->object;
    $rf->styles()->add(__DIR__."/styles/dark.less");    
  }
}
