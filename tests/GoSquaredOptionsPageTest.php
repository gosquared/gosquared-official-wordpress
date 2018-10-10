<?php
use PHPUnit\Framework\TestCase;

class GoSquaredOptionsPageTestClass extends \WP_Mock\Tools\TestCase {

	public function setUp() {
		\WP_Mock::setUp();
    \WP_Mock::userFunction( 'get_option', array(
    'args' =>'gosquared_site_token',
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
  $gsOfficialSettings = new GoSquaredOptionsPage;
  $gsOfficialSettings ->site_token();
  $validReponse=<<<EOD
<label for='gosquared_site_token' class='gsLabel'>GoSquared Project Token: </label><input class='postform' type='text' name='gosquared_site_token' value='project_token' /><p class='description'>You can find your GoSquared project token the <a href='https://www.gosquared.com/setup/general' target='#'>project settings</a> of your GoSquared account.</p>
EOD;
	$this->expectOutputString($validReponse);
  }

  public function testGosquaredIdentifyChecked() {
  $gsOfficialSettings = new GoSquaredOptionsPage;
  \WP_Mock::userFunction( 'get_option', array(
  'args' =>'gosquared_identify',
  'return' => '1',
  ));
  $gsOfficialSettings->gosquared_identify();
  $validReponse=<<<EOD
<label for='gosquared_identify' class='gsLabel'>Enable user tracking:  </label><input name='gosquared_identify' id='gosquared_identify' type='checkbox' value= '1' checked="checked"/><p class='description'>With GoSquared user tracking enabled, you'll be able to track the online behaviour of your website's logged in users, within your GoSquared User dashboard.</p>
EOD;
  $this->expectOutputString($validReponse);
  }

  public function testGosquaredIdentifyUnchecked() {
  $gsOfficialSettings = new GoSquaredOptionsPage;
  \WP_Mock::userFunction( 'get_option', array(
  'args' =>'gosquared_identify',
  'return' => '0',
  ));
  $gsOfficialSettings->gosquared_identify();
  $validReponse=<<<EOD
<label for='gosquared_identify' class='gsLabel'>Enable user tracking:  </label><input name='gosquared_identify' id='gosquared_identify' type='checkbox' value= '1'/><p class='description'>With GoSquared user tracking enabled, you'll be able to track the online behaviour of your website's logged in users, within your GoSquared User dashboard.</p>
EOD;
  $this->expectOutputString($validReponse);
  }

	public function testGosquaredGravityNotEnabled() {
	$gsOfficialSettings = new GoSquaredOptionsPage;
	\WP_Mock::userFunction( 'is_plugin_active', array(
	'return'=>false,
	));
	$gsOfficialSettings->gosquared_gravity_forms();
	$validReponse=<<<EOD
<p class='gsGFform'> Looking to capture leads through forms on your site? add the <a href='https://www.gravityforms.com/' target='#'> Gravity Forms</a> plugin to enable our integration.</p><p class='description'>With the GoSquared Gravity Forms integration enabled, you'll be able to track any leads captured through Gravity Forms.</p>
EOD;
	$this->expectOutputString($validReponse);
	}

  public function testGosquaredGravityFormsUnchecked() {
  $gsOfficialSettings = new GoSquaredOptionsPage;
	\WP_Mock::userFunction( 'is_plugin_active', array(
	'return'=>true,
	));
  \WP_Mock::userFunction( 'get_option', array(
  'args' =>'gosquared_gravity_forms',
  'return' => '0',
  ));
  $gsOfficialSettings->gosquared_gravity_forms();
  $validReponse=<<<EOD
<label for='gosquared_gravity_forms' class='gsLabel'>Enable Gravtiy Form integration</label><input name='gosquared_gravity_forms' id='gosquared_gravity_forms' type='checkbox' value= '1'/><p class='description'>With the GoSquared Gravity Forms integration enabled, you'll be able to track any leads captured through Gravity Forms</p>
EOD;
  $this->expectOutputString($validReponse);
  }

  public function testGosquaredGravityFormsChecked() {
	\WP_Mock::userFunction( 'is_plugin_active', array(
		'return'=>true,
	));
  $gsOfficialSettings = new GoSquaredOptionsPage;
  $gosquared_gravity_forms= \WP_Mock::userFunction( 'get_option', array(
  'args' =>'gosquared_gravity_forms',
  'return' => 1,
  ));
  $gsOfficialSettings->gosquared_gravity_forms();
  $validReponse=<<<EOD
<label for='gosquared_gravity_forms' class='gsLabel'>Enable Gravtiy Form integration</label><input name='gosquared_gravity_forms' id='gosquared_gravity_forms' type='checkbox' value= '1' checked="checked"/><p class='description'>With the GoSquared Gravity Forms integration enabled, you'll be able to track any leads captured through Gravity Forms</p>
EOD;
  $this->expectOutputString($validReponse);
  }

	public function tearDown() {
		\WP_Mock::tearDown();
	}
}
