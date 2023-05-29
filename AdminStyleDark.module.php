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

  // module init
  public function init() {
    $this->addHookAfter('AdminThemeUikit::renderFile', $this, 'hookRenderFile');
  }

  public function ready() {
    $this->loadStyle(__DIR__ . "/style/dark.less");
  }

  /**
   * Hook after AdminThemeUikit::renderFile
   * Replace {{OFFCANVAS_LOGO}} with the logo URL if set in AdminThemeUikit's settings
   * Note: Only works if `site/templates/AdminThemeUikit/_offcanvas.php` exists.
   * @param HookEvent $event
   */
  function hookRenderFile($event) {
    $file = $event->arguments(0); // full path/file being rendered 
    if(basename($file) === '_offcanvas.php') {
      $logoURL = $event->object->logoURL;
  
      $markup = str_replace(
        "{{OFFCANVAS_LOGO}}",
        $logoURL,
        $event->return
      );

      $event->return = $markup;
    }
  }
}
