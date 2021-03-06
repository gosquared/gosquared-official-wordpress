<?php
use PHPUnit\Framework\TestCase;

class GoSquaredOfficalGravityFormsTestClass extends \WP_Mock\Tools\TestCase {

	public function setUp() {
		\WP_Mock::setUp();
	}

	public function testMappingFieldValuesToGoSquaredStandardProperties()
    {
		$validReponse = Array('custom' => Array(), 'first_name' => 'user');
		$input_form=Array('id' => '1.3', 'label' => 'First Name');
		$entry=Array('id' => '27', '1.3' => 'user', '1.6' => 'name', '2' => 'user@gosquared.com', '3' => 'username', '4' => '1');
		$GFform = new GSOF_GoSquaredGFIntegration('1234568');
		$properties = $GFform->GSOF_map_properties($entry, $input_form);
		$this->assertTrue($properties == $validReponse);
    }

  public function testMappingFieldValuesToGoSquaredCustomProperties()
    {
		$validReponse = Array('custom' => Array('Username' => 'username'));
		$input_form=Array('id' => '3', 'label' => 'Username');
		$entry=Array('id' => '27', '1.3' => 'user', '1.6' => 'name', '2' => 'user@gosquared.com', '3' => 'username', '4' => '1');
		$GFform = new GSOF_GoSquaredGFIntegration('1234568');
		$properties = $GFform->GSOF_map_properties($entry, $input_form);
		$this->assertTrue($properties == $validReponse);
    }

  public function testOutputtingGSSnippetwithProperties()
		{
			$GFform = new GSOF_GoSquaredGFIntegration('1234568');
			$form = Array('fields' => Array(0 => Array('type' => 'email', 'id' => 2, 'label' => 'Email',  'inputs' => ''),
			1 => Array('type' => 'username', 'id' => 3, 'label' => 'Username','inputs' => ''), 2 => Array('inputs' => '','type' => 'password', 'id' => 4, 'label' => 'Password')));
			$entry=Array('id' => '27', '1.3' => 'user', '1.6' => 'name', '2' => 'user@gosquared.com', '3' => 'username', '4' => '1');
			$valid_response=<<<EOD
<script>if(!window._gs) {!function(g,s,q,r,d){r=g[r]=g[r]||function(){(r.q=r.q||[]).push(arguments)};d=s.createElement(q);q=s.getElementsByTagName(q)[0];d.src='//d1l6p2sc9645hc.cloudfront.net/tracker.js';q.parentNode.insertBefore(d,q)}(window,document,'script','_gs');_gs('1234568');}_gs('identify',{"custom":{"Username":"username"},"email":"user@gosquared.com"})</script>
EOD;
			$this->expectOutputString($valid_response);
			$gsSnippet = $GFform->GSOF_send($entry, $form);
		}

	public function testOutputtingGSSnippetwithPropertiesWithoutPassword()
		{
			$GFform = new GSOF_GoSquaredGFIntegration('1234568');
			$form = Array('fields' => Array(0 => Array('type' => 'email', 'id' => 2, 'label' => 'Email',  'inputs' => '', ),
			1 => Array('type' => 'username', 'id' => 3, 'label' => 'Username','inputs' => ''), 2 => Array('inputs' => '','type' => 'password', 'id' => 4, 'label' => 'Password')));
			$entry=Array('id' => '27', '1.3' => 'user', '1.6' => 'name', '2' => 'user@gosquared.com', '3' => 'username', '4' => 'password');
			$valid_response=<<<EOD
<script>if(!window._gs) {!function(g,s,q,r,d){r=g[r]=g[r]||function(){(r.q=r.q||[]).push(arguments)};d=s.createElement(q);q=s.getElementsByTagName(q)[0];d.src='//d1l6p2sc9645hc.cloudfront.net/tracker.js';q.parentNode.insertBefore(d,q)}(window,document,'script','_gs');_gs('1234568');}_gs('identify',{"custom":{"Username":"username"},"email":"user@gosquared.com"})</script>
EOD;
			$this->expectOutputString($valid_response);
			$gsSnippet = $GFform->GSOF_send($entry, $form);
		}

	public function testOutputtingGSSnippetwithPropertiesWithoutCreditCard()
		{
			$GFform = new GSOF_GoSquaredGFIntegration('1234568');
			$form = Array('fields' => Array(0 => Array('type' => 'email', 'id' => 2, 'label' => 'Email',  'inputs' => '', ),
			1 => Array('type' => 'creditcard', 'id' => 3, 'label' => 'creditcard','inputs' => ''), 2 => Array('inputs' => '','type' => 'password', 'id' => 4, 'label' => 'Password')));
			$entry=Array('id' => '27', '1.3' => 'user', '1.6' => 'name', '2' => 'user@gosquared.com', '3' => '42424242424242', '4' => 'password');
			$valid_response=<<<EOD
<script>if(!window._gs) {!function(g,s,q,r,d){r=g[r]=g[r]||function(){(r.q=r.q||[]).push(arguments)};d=s.createElement(q);q=s.getElementsByTagName(q)[0];d.src='//d1l6p2sc9645hc.cloudfront.net/tracker.js';q.parentNode.insertBefore(d,q)}(window,document,'script','_gs');_gs('1234568');}_gs('identify',{"custom":[],"email":"user@gosquared.com"})</script>
EOD;
			$this->expectOutputString($valid_response);
			$gsSnippet = $GFform->GSOF_send($entry, $form);
		}

	public function tearDown() {
	\WP_Mock::tearDown();
	}

}
