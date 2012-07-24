<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Ralf Schneider <ralf@hr-interactive.de>, hr-interactive
 *  			
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
/**
 * Test case for class Tx_Flatmgrpay_Domain_Repositry_FlatRepositry.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License,
 *          version 3 or later
 *         
 * @package TYPO3
 * @subpackage Flat Manager Payment
 *            
 * @author Ralf Schneider <ralf@hr-interactive.de>
 */
class Tx_Flatmgrpay_Domain_Model_FlatRepositryTest extends Tx_Extbase_Tests_Unit_BaseTestCase {

	/**
	 *
	 * @var Tx_Flatmgrpay_Domain_Repository_FlatRepository
	 */
	protected $fixture;

	public function setUp() {
		$this->testingFramework = new Tx_Phpunit_Framework('tx_flatmgrpay');
		$this->fixture = $this->objectManager->get('Tx_Flatmgrpay_Domain_Repository_FlatRepository');
	}

	public function tearDown() {
		$this->testingFramework->cleanUp();
		unset($this->testingFramework, $this->fixture);
	}

	/**
	 * @test
	 */
	public function getFixturesWorkes() {
		$ret = $this->fixture->findAll();
		$this->assertNotEmpty($ret);
		$i = 0;
		foreach ($ret as $key => $value) {
			$i ++;
		}
		$this->assertEquals(13, $i);
	}
	
	
	/**
	 * @test
	 */
	public function findByUid() {
		$flat = $this->fixture->getFlatByUid(2);
		$this->assertInstanceOf(Tx_Flatmgrpay_Domain_Model_Flat, $flat);
	}
}
?>