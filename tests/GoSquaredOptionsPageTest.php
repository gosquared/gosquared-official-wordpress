<?php
use PHPUnit\Framework\TestCase;

class GoSquaredOptionsPageTestClass extends \WP_Mock\Tools\TestCase {

	public function setUp() {
		\WP_Mock::setUp();
    \WP_Mock::userFunction( 'get_option', array(
    'args' =>'GSOF_gosquared_site_token',
    'return' => 'project_token',
    ));
    \WP_Mock::userFunction( 'checked', array(
    'args' => array('1', '1', false),
    'return'=>' checked="checked"',
    ));
    \WP_Mock::userFunction( 'checked', array(
    'args' => array('1', '0', false),
    'return'=>'',
    ));
	}

  public function testSiteToken() {
  $gsOfficialSettings = new GSOF_GoSquaredOptionsPage;
  $gsOfficialSettings ->GSOF_site_token();
  $validReponse=<<<EOD
<label for='GSOF_gosquared_site_token' class='gsLabel'>GoSquared Project Token: </label><input class='postform' type='text' name='GSOF_gosquared_site_token' value='project_token' /><p class='description'>You can find your GoSquared Project Token the <a href='https://www.gosquared.com/setup/general' target='#'>Project Settings</a> of your GoSquared account.</p>
EOD;
	$this->expectOutputString($validReponse);
  }

  public function testGosquaredIdentifyChecked() {
  $gsOfficialSettings = new GSOF_GoSquaredOptionsPage;
  \WP_Mock::userFunction( 'get_option', array(
  'args' =>'GSOF_gosquared_identify',
  'return' => '1',
  ));
  $gsOfficialSettings->GSOF_gosquared_identify();
  $validReponse=<<<EOD
<label for='GSOF_gosquared_identify' class='gsLabel'>Enable user tracking:  </label><input name='GSOF_gosquared_identify' id='GSOF_gosquared_identify' type='checkbox' value= '1' checked="checked"/><p class='description'>With GoSquared user tracking enabled, you'll be able to track the online behaviour of your website's logged in users, within GoSquared People.</p>
EOD;
  $this->expectOutputString($validReponse);
  }

  public function testGosquaredIdentifyUnchecked() {
  $gsOfficialSettings = new GSOF_GoSquaredOptionsPage;
  \WP_Mock::userFunction( 'get_option', array(
  'args' =>'GSOF_gosquared_identify',
  'return' => '0',
  ));
  $gsOfficialSettings->GSOF_gosquared_identify();
  $validReponse=<<<EOD
<label for='GSOF_gosquared_identify' class='gsLabel'>Enable user tracking:  </label><input name='GSOF_gosquared_identify' id='GSOF_gosquared_identify' type='checkbox' value= '1'/><p class='description'>With GoSquared user tracking enabled, you'll be able to track the online behaviour of your website's logged in users, within GoSquared People.</p>
EOD;
  $this->expectOutputString($validReponse);
  }

	public function testGosquaredGravityNotEnabled() {
	$gsOfficialSettings = new GSOF_GoSquaredOptionsPage;
	\WP_Mock::userFunction( 'is_plugin_active', array(
	'return'=>false,
	));
	$gsOfficialSettings->GSOF_gosquared_gravity_forms();
	$validReponse=<<<EOD
<p class='gsGFform'> Looking to capture leads through forms on your site? Add the <a href='https://www.gravityforms.com/' target='#'> Gravity Forms</a> plugin to enable our integration.</p><p class='description'>With the GoSquared Gravity Forms integration enabled, you'll be able to track any leads captured through Gravity Forms.</p>
EOD;
	$this->expectOutputString($validReponse);
	}

  public function testGosquaredGravityFormsUnchecked() {
  $gsOfficialSettings = new GSOF_GoSquaredOptionsPage;
	\WP_Mock::userFunction( 'is_plugin_active', array(
	'return'=>true,
	));
  \WP_Mock::userFunction( 'get_option', array(
  'args' =>'GSOF_gosquared_gravity_forms',
  'return' => '0',
  ));
  $gsOfficialSettings->GSOF_gosquared_gravity_forms();
  $validReponse=<<<EOD
<label for='GSOF_gosquared_gravity_forms' class='gsLabel'>Enable Gravity Form integration</label><input name='GSOF_gosquared_gravity_forms' id='GSOF_gosquared_gravity_forms' type='checkbox' value= '1'/><p class='description'>With the GoSquared Gravity Forms integration enabled, you'll be able to track any leads captured through Gravity Forms</p>
EOD;
  $this->expectOutputString($validReponse);
  }

  public function testGosquaredGravityFormsChecked() {
	\WP_Mock::userFunction( 'is_plugin_active', array(
		'return'=>true,
	));
  $gsOfficialSettings = new GSOF_GoSquaredOptionsPage;
  $gosquared_gravity_forms= \WP_Mock::userFunction( 'get_option', array(
  'args' =>'GSOF_gosquared_gravity_forms',
  'return' => 1,
  ));
  $gsOfficialSettings->GSOF_gosquared_gravity_forms();
  $validReponse=<<<EOD
<label for='GSOF_gosquared_gravity_forms' class='gsLabel'>Enable Gravity Form integration</label><input name='GSOF_gosquared_gravity_forms' id='GSOF_gosquared_gravity_forms' type='checkbox' value= '1' checked="checked"/><p class='description'>With the GoSquared Gravity Forms integration enabled, you'll be able to track any leads captured through Gravity Forms</p>
EOD;
  $this->expectOutputString($validReponse);
  }

	public function tearDown() {
		\WP_Mock::tearDown();
	}
}
