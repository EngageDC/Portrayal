<?php namespace Engage\Portrayal\Test;

use Engage\Portrayal\Capture;
class ParserTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * Just a simple test to ensure that the snap function
	 * is behaving correctly.
	 */
    public function testCapture() {
    	$capture = new Capture();
    	$filename = $capture->snap('https://github.com/engagedc/Portrayal', sys_get_temp_dir());

    	$this->assertTrue(file_exists($filename));
    	$this->assertGreaterThan(100, filesize($filename));

    	// Clean up
    	@unlink($filename);
    }

}