<?php
namespace LC;

class PodObject {
  public $pod_page_title;
  public $pod_page_section;
  private $pod;
  
  static function init($pod) {
    self::$pod = $pod;
  }
}
