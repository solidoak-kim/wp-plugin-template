<?php

namespace {%= pluginFolder %};

class {%= pluginFolder %}Widget extends WP_Widget {

  public function __construct() {
    // Instantiate the parent object
    parent::__construct( '{%= name %}', '{%= title %}', array( 'description' => '{%= description %}' ) );

  }

  public function run() {
    add_action( 'widgets_init', array( $this, 'registerWidget' ) );

  }

  public function registerWidget() {
    register_widget( __CLASS__ );
  }

  public function widget( $args, $instance ) {
  }

  public function update( $new, $old ) {
  }

  public function form( $instance ) {
  }

}
