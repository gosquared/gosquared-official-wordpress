<?php
use PHPUnit\Framework\TestCase;

class GoSquaredOfficalTestClass extends \WP_Mock\Tools\TestCase {
	public function setUp() {
		\WP_Mock::setUp();

	}

  public function GoSquaredOfficialTest()
      {

      $gsOfficial = new GoSquaredOfficial();
      $this->gsOfficialSettings = \Mockery::mock(GoSquaredOptionsPage::class);
      $this->$gsOfficial->expects($this->once())
            ->method($this->gsOfficialSettings->get);
      }

	public function tearDown() {
		\WP_Mock::tearDown();
	}

}
