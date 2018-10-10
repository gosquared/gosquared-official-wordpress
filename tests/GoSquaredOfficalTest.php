<?php
use PHPUnit\Framework\TestCase;

class GoSquaredOfficalTestClass extends \WP_Mock\Tools\TestCase {

	public function setUp() {
		\WP_Mock::setUp();
		$current_user = new stdClass();
		$current_user->user_email="user@gosquared.com";
		$current_user->user_firstname="user";
		$current_user->user_lastname="name";
		$current_user->user_login="username";
		\WP_Mock::userFunction( 'wp_get_current_user', array(
		'return' => $current_user,
		));
		\WP_Mock::userFunction( 'get_option', array(
		'args' =>'gosquared_site_token',
		'return' => 'project_token',
		));
	}

	public function testGSSnippet() {
		$gsOfficial = new GoSquaredOfficial();
		$gsOfficial->gsOfficialSettings = new GoSquaredOptionsPage;
		$validReponse="<script>!function(g,s,q,r,d){r=g[r]=g[r]||function(){(r.q=r.q||[]).push(arguments)};d=s.createElement(q);q=s.getElementsByTagName(q)[0];d.src='//d1l6p2sc9645hc.cloudfront.net/tracker.js';q.parentNode.insertBefore(d,q)}(window,document,'script','_gs');_gs('project_token');</script>";
		$this->expectOutputString($validReponse);
		$gsOfficial -> gs_snippet();
	}

	public function testAddIdentify() {
		$gsOfficial = new GoSquaredOfficial();
		$validReponse=<<<EOD
_gs('identify',{"custom":{"username":"username"},"email":"user@gosquared.com","first_name":"user","last_name":"name"})
EOD;
		$this->expectOutputString($validReponse);
		$gsOfficial -> add_identify();
	}

	public function tearDown() {
		\WP_Mock::tearDown();
	}
}
