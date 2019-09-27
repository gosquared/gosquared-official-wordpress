<?php

class GSOF_GoSquaredOptionsPage {
  public function __construct() {
	   add_action( 'admin_menu', array( $this, 'GSOF_admin_menu' ) );
     add_action( 'admin_enqueue_scripts', array( $this, 'load_custom_wp_admin_style') );
	}

  function load_custom_wp_admin_style() {
      wp_register_style( 'gs_custom_wp_admin_css', plugins_url( 'css/goSquaredStyle.css', dirname(__FILE__) ), false, '1.0.0' );
      wp_enqueue_style( 'gs_custom_wp_admin_css' );
  }

  public function GSOF_admin_menu() {
    add_options_page(
    'GoSquared Settings',
    'GoSquared',
    'manage_options',
    'gosquared-official-plugin',
    array($this, 'GSOF_options_page')
    );
    add_action('admin_init', array($this, 'GSOF_settings_page'));
}

public function GSOF_settings_page(){
    register_setting( 'gosquared_official_settings_group', 'GSOF_gosquared_site_token' );
    register_setting( 'gosquared_official_settings_group', 'GSOF_gosquared_identify' );
    register_setting( 'gosquared_official_settings_group', 'GSOF_gosquared_badge' );
    register_setting( 'gosquared_official_settings_group', 'GSOF_gosquared_gravity_forms' );
}

 public function GSOF_get( $key ) {
    return get_option( $key );
  }

  public function GSOF_options_page() {
  ?>
  <div class="wrap">
      <h2>The Official GoSquared Plugin</h2>
      <?php $this->GSOF_display_gosquared_link(); ?>
      <div class="form-table">
      <form action="options.php" method="POST">
          <?php settings_fields( 'gosquared_official_settings_group' ); ?>
          <div class="gsOptions">
          <?php $this->GSOF_site_token(); ?>
          </div>
          <div class="gsOptions">
          <?php $this->GSOF_gosquared_identify(); ?>
         </div>
         <div class="gsOptions">
          <?php $this->GSOF_gosquared_gravity_forms(); ?>
         </div>
         <div class="gsOptions">
          <?php $this->GSOF_gosquared_badge(); ?>
         </div>
          <?php submit_button(); ?>
      </form>
      <p class='gsSignUp'>Don't have a GoSquared account? You can <a href='https://www.gosquared.com/join/wordpress' target='#'>sign up</a> here.</p>
    </div>
  </div>
  <?php
}

public function GSOF_site_token() {
  $token = esc_attr( $this->GSOF_get( 'GSOF_gosquared_site_token' ));
  echo "<label for='GSOF_gosquared_site_token' class='gsLabel'>GoSquared Project Token: </label>";
  echo "<input class='postform' type='text' name='GSOF_gosquared_site_token' value='$token' />";
  echo "<p class='description'>You can find your GoSquared Project Token the <a href='https://www.gosquared.com/setup/general' target='#'>Project Settings</a> of your GoSquared account.</p>";
}

public function GSOF_gosquared_identify() {
echo "<label for='GSOF_gosquared_identify' class='gsLabel'>Enable user tracking:  </label>";
echo "<input name='GSOF_gosquared_identify' id='GSOF_gosquared_identify' type='checkbox' value= '1'" . checked(1, $this->GSOF_get( 'GSOF_gosquared_identify' ), false) . "/>";
echo "<p class='description'>With GoSquared user tracking enabled, you'll be able to track the online behaviour of your website's logged in users, within GoSquared People.</p>";
}

public function GSOF_gosquared_gravity_forms() {
  if (is_plugin_active('gravityforms/gravityforms.php') ) {
  echo "<label for='GSOF_gosquared_gravity_forms' class='gsLabel'>Enable Gravity Form integration</label>";
  echo "<input name='GSOF_gosquared_gravity_forms' id='GSOF_gosquared_gravity_forms' type='checkbox' value= '1'" . checked(1, $this->GSOF_get( 'GSOF_gosquared_gravity_forms' ), false) . "/>";
  echo "<p class='description'>With the GoSquared Gravity Forms integration enabled, you'll be able to track any leads captured through Gravity Forms</p>";
  } else {
  echo "<p class='gsGFform'> Looking to capture leads through forms on your site? Add the <a href='https://www.gravityforms.com/' target='#'> Gravity Forms</a> plugin to enable our integration.</p>";
  echo "<p class='description'>With the GoSquared Gravity Forms integration enabled, you'll be able to track any leads captured through Gravity Forms.</p>";
  }
}

public function GSOF_display_gosquared_link(){
  if ($this->GSOF_get( 'GSOF_gosquared_site_token' )){
  $token = esc_attr( $this->GSOF_get( 'GSOF_gosquared_site_token' ));
  echo "<p class='gsDashboardLink'>View your <a href='https://www.gosquared.com/now/" . $token . "' target='#'>GoSquared Dashboard</a></h3>";
  }
}

public function GSOF_gosquared_badge() {
echo "<label for='GSOF_gosquared_badge' class='gsLabel'>Enable GoSquared Badge:  </label>";
echo "<input name='GSOF_gosquared_badge' id='GSOF_gosquared_badge' type='checkbox' value= '1'" . checked(1, $this->GSOF_get( 'GSOF_gosquared_badge' ), false) . "/>";
echo "<p class='description'>With the GoSquared badge installed, you'll be able to track an additional 10,000 pageviews each month, for free!</p>";
}

}
