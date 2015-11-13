<?php

namespace {%= pluginFolder %};

class SettingsPage extends AbstractSubPage {

  public function renderSettingsPage() {
    $optionName = $this->settingsPageProperties['option_name'];
    $optionGroup = $this->settingsPageProperties['option_group'];
    $settingsData = $this->getSettingsData();
    ?>

    <div class="wrap">
      <h2>{%= title %} Settings</h2>

      <p>These are the available settings.</p>

      <form action="options.php" method="post">
        <?php
        settings_fields( $optionGroup );
        ?>

        <table class="form-table">
          <tr>
            <th><label for="textbox">Textbox:</label></th>
            <td>
              <input type="text" id="textbox" name="<?php echo esc_attr( $optionName . '[textbox]' ); ?>"
                     value="<?php echo esc_attr( $settingsData['textbox'] ); ?>"/>
            </td>
          </tr>
        </table>

        <input type="submit" name="submit" id="submit" class="button button-primary" value="Save Options">
      </form>
    </div>

    <?php
  }

  public function getDefaultSettingsData() {
    $defaults = array();
    $defaults['textbox'] = '';

    return $defaults;
  }

}
