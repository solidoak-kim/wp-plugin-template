<?php

/*
 *  Plugin Name: {%= title %}
 *  Description: A plugin for MyPlay
 *  Version: {%= version %}
 *
 */

use {%= pluginFolder %}\Plugin;
use {%= pluginFolder %}\SettingsPage;

spl_autoload_register( function ( $className ) {

  if ( false !== strpos( $className, '{%= pluginFolder %}' ) ) {
    $classesDir = realpath( plugin_dir_path( __FILE__ ) ) . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR;
    $classFile = str_replace( '\\', DIRECTORY_SEPARATOR, $className ) . '.php';
    require_once $classesDir . $classFile;
  }

} );


add_action( 'plugins_loaded', function () {

  $plugin = new Plugin(); // Create the plugin container
  $plugin['path'] = realpath( plugin_dir_path( __FILE__ ) ) . DIRECTORY_SEPARATOR;
  $plugin['url'] = plugin_dir_url( __FILE__ );
  $plugin['version'] = '0.0.1';
  $plugin['settingsPageProperties'] = array(
    'parent_slug'  => 'options-general.php',
    'page_title'   => '{%= title %}',
    'menu_title'   => '{%= title %}',
    'capability'   => 'manage_options',
    'menu_slug'    => '{%= name %}-settings',
    'option_group' => '{%= name %}_option_group',
    'option_name'  => '{%= name %}_option_name'
  );
  $plugin['settingsPage'] = function ( $plugin ) {
    static $object;

    if ( null !== $object ) {
      return $object;
    }

    return new SettingsPage( $plugin['settingsPageProperties'] );
  };

  $plugin->run();

} );
