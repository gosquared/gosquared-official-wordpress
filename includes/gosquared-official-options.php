<?php

class GoSquaredOptionsPage {
  public function __construct() {
	   add_action( 'admin_menu', array( $this, 'admin_menu' ) );
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
}

 public function get( $key ) {
    return get_option( 'gosquared_site_token' );
  }

  public function my_options_page() {
  ?>
  <div class="wrap">
      <h2>The Official GoSquared Plugin</h2>
      <form action="options.php" method="POST">
          <?php settings_fields( 'gosquared_official_settings_group' ); ?>
          <p>You can find your GoSquared Project token <a href='https://www.gosquared.com/setup/general' target='#'>here: </a></p>
          <?php do_settings_sections( 'gosquared-official-plugin' ); ?>
          <?php submit_button(); ?>
      </form>
  </div>
  <?php
}

public function site_token() {
  $token = esc_attr( $this->get( 'gosquared_site_token' ) );
  echo "<input type='text' name='gosquared_site_token' value='$token' />";
}

}
