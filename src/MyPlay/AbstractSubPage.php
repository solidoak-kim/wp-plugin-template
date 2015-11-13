<?php

namespace MyPlay;

abstract class AbstractSubPage {
  protected $settingsPageProperties;

  public function __construct( $settingsPageProperties ) {
    $this->settingsPageProperties = $settingsPageProperties;
  }

  public function run() {
    add_action( 'admin_menu', array( $this, 'addMenuAndPage' ) );
    add_action( 'admin_init', array( $this, 'registerSettings' ) );
  }

  public function addMenuAndPage() {

    add_submenu_page(
      $this->settingsPageProperties['parent_slug'],
      $this->settingsPageProperties['page_title'],
      $this->settingsPageProperties['menu_title'],
      $this->settingsPageProperties['capability'],
      $this->settingsPageProperties['menu_slug'],
      array( $this, 'renderSettingsPage' )
    );

  }

  public function registerSettings() {

    register_setting(
      $this->settingsPageProperties['option_group'],
      $this->settingsPageProperties['option_name']
    );

  }

  public function getSettingsData() {
    return get_option(
      $this->settingsPageProperties['option_name'], $this->getDefaultSettingsData()
    );
  }

  public function renderSettingsPage() {

  }

  public function getDefaultSettingsData() {
    $defaults = array();

    return $defaults;
  }

}

