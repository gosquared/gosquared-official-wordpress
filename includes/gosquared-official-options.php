<?php

class GoSquaredOptionsPage {
  public function __construct() {
	   add_action( 'admin_menu', array( $this, 'admin_menu' ) );
     add_action( 'admin_enqueue_scripts', array( $this, 'load_custom_wp_admin_style') );
	}

  function load_custom_wp_admin_style() {
      wp_register_style( 'gs_custom_wp_admin_css', plugins_url( 'css/goSquaredStyle.css', dirname(__FILE__) ), false, '1.0.0' );
      wp_enqueue_style( 'gs_custom_wp_admin_css' );
  }

  public function admin_menu() {
    add_options_page(
    'GoSquared Settings',
    'GoSquared',
    'manage_options',
    'gosquared-official-plugin',
    array($this, 'my_options_page')
    );
    add_action('admin_init', array($this, 'settings_page'));
}

public function settings_page(){
    register_setting( 'gosquared_official_settings_group', 'gosquared_site_token' );
    register_setting( 'gosquared_official_settings_group', 'gosquared_identify' );
    register_setting( 'gosquared_official_settings_group', 'gosquared_gravity_forms' );

    add_settings_section(
      'gosquared_settings_section',
      'GoSquared Settings',
      '__return_false',
      'gosquared-official-plugin'
    );
    add_settings_field(
  		'gosquared_site_token',
  		'GoSquared Project Token',
  	 	 array( $this, 'site_token' ),
  		'gosquared-official-plugin',
  		'gosquared_settings_section'
  	);
    add_settings_field(
      'gosquared_identify',
      'Activate user tracking',
       array( $this, 'gosquared_identify' ),
      'gosquared-official-plugin',
      'gosquared_settings_section'
    );
      add_settings_field(
        'gosquared_gravity_forms',
        'Activate GoSquared Gravity Forms Integration',
         array( $this, 'gosquared_gravity_forms' ),
        'gosquared-official-plugin',
        'gosquared_settings_section'
      );
}

 public function get( $key ) {
    return get_option( $key );
  }

  public function my_options_page() {
  ?>
  <div class="wrap">
      <h2>The Official GoSquared Plugin</h2>
      <?php $this->display_gosquared_link(); ?>
      <div class="form-table">
      <form action="options.php" method="POST">
          <?php settings_fields( 'gosquared_official_settings_group' ); ?>
          <div class="gsOptions">
          <?php $this->site_token(); ?>
          </div>
          <div class="gsOptions">
          <?php $this->gosquared_identify(); ?>
         </div>
         <div class="gsOptions">
          <?php $this->gosquared_gravity_forms(); ?>
         </div>
          <?php submit_button(); ?>
      </form>
      <p class='gsSignUp'>Don't have a GoSquared account? You can <a href='https://www.gosquared.com/join/wordpress' target='#'>sign up</a> here.</p>
    </div>
  </div>
  <?php
}

public function site_token() {
  $token = esc_attr( $this->get( 'gosquared_site_token' ));
  echo "<label for='gosquared_site_token' class='gsLabel'>GoSquared Project Token: </label>";
  echo "<input class='postform' type='text' name='gosquared_site_token' value='$token' />";
  echo "<p class='description'>You can find your GoSquared project token the <a href='https://www.gosquared.com/setup/general' target='#'>project settings</a> of your GoSquared account.</p>";
}

public function gosquared_identify() {
echo "<label for='gosquared_identify' class='gsLabel'>Enable user tracking:  </label>";
echo "<input name='gosquared_identify' id='gosquared_identify' type='checkbox' value= '1'" . checked(1, $this->get( 'gosquared_identify' ), false) . "/>";
echo "<p class='description'>With GoSquared user tracking enabled, you'll be able to track the online behaviour of your website's logged in users, within your GoSquared User dashboard.</p>";
}

public function gosquared_gravity_forms() {
  if (is_plugin_active('gravityforms/gravityforms.php') ) {
  echo "<label for='gosquared_gravity_forms' class='gsLabel'>Enable Gravity Form integration</label>";
  echo "<input name='gosquared_gravity_forms' id='gosquared_gravity_forms' type='checkbox' value= '1'" . checked(1, $this->get( 'gosquared_gravity_forms' ), false) . "/>";
  echo "<p class='description'>With the GoSquared Gravity Forms integration enabled, you'll be able to track any leads captured through Gravity Forms</p>";
  } else {
  echo "<p class='gsGFform'> Looking to capture leads through forms on your site? add the <a href='https://www.gravityforms.com/' target='#'> Gravity Forms</a> plugin to enable our integration.</p>";
  echo "<p class='description'>With the GoSquared Gravity Forms integration enabled, you'll be able to track any leads captured through Gravity Forms.</p>";
  }
}

public function display_gosquared_link(){
  if ($this->get( 'gosquared_site_token' )){
  $token = esc_attr( $this->get( 'gosquared_site_token' ));
  echo "<p class='gsDashboardLink'>View your <a href='https://www.gosquared.com/now/" . $token . "' target='#'>GoSquared Dashboard</a></h3>";
  }
}

}
