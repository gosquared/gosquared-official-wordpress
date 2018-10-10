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
  $validReponse="<input type='text' name='gosquared_site_token' value='project_token' />";
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
<input name='gosquared_identify' id='gosquared_identify' type='checkbox' value= '1' checked="checked"/>
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
  $validReponse="<input name='gosquared_identify' id='gosquared_identify' type='checkbox' value= '1'/>";
  $this->expectOutputString($validReponse);
  }

  public function testGosquaredGravityFormsUnchecked() {
  $gsOfficialSettings = new GoSquaredOptionsPage;
  \WP_Mock::userFunction( 'get_option', array(
  'args' =>'gosquared_gravity_forms',
  'return' => '0',
  ));
  $gsOfficialSettings->gosquared_gravity_forms();
  $validReponse="<input name='gosquared_gravity_forms' id='gosquared_gravity_forms' type='checkbox' value= '1'/>";
  $this->expectOutputString($validReponse);
  }

  public function testGosquaredGravityFormsChecked() {
  $gsOfficialSettings = new GoSquaredOptionsPage;
  $gosquared_gravity_forms= \WP_Mock::userFunction( 'get_option', array(
  'args' =>'gosquared_gravity_forms',
  'return' => 1,
  ));
  $gsOfficialSettings->gosquared_gravity_forms();
  $validReponse=<<<EOD
<input name='gosquared_gravity_forms' id='gosquared_gravity_forms' type='checkbox' value= '1' checked="checked"/>
EOD;
  $this->expectOutputString($validReponse);
  }

	public function tearDown() {
		\WP_Mock::tearDown();
	}
}
