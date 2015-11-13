<?php

namespace {%= pluginFolder %};

class CustomPostType {
  protected $customPostTypes = array();

  public function __construct( $customPostTypes ) {
    $this->customPostTypes = $customPostTypes;
  }

  public function run() {
    add_action( 'init', array( $this, 'registerCustomPostTypes' ) );
  }

  public function registerCustomPostTypes() {

    // set up labels and args for custom post type register


  }
}
