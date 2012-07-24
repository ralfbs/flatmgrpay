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
 * Test case for class Tx_Flatmgrpay_Domain_Model_Booking.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License,
 *          version 3 or later
 *         
 * @package TYPO3
 * @subpackage Flat Manager Payment
 *            
 * @author Ralf Schneider <ralf@hr-interactive.de>
 */
class Tx_Flatmgrpay_Domain_Model_BookingTest extends Tx_Extbase_Tests_Unit_BaseTestCase {

	/**
	 *
	 * @var Tx_Flatmgrpay_Domain_Model_Booking
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Tx_Flatmgrpay_Domain_Model_Booking();
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function getNameReturnsInitialValueForString() {
	}

	/**
	 * @test
	 */
	public function setNameForStringSetsName() {
		$this->fixture->setName('Conceived at T3CON10');
		$this->assertSame('Conceived at T3CON10', $this->fixture->getName());
	}

	/**
	 * @test
	 */
	public function setFlatForIntegerSetsFlat() {
		$this->fixture->setFlat(12);
		$this->assertSame(12, $this->fixture->getFlat());
	}

	/**
	 * @test
	 */
	public function getStartdayReturnsInitialValueForString() {
	}

	/**
	 * @test
	 */
	public function setStartdayForStringSetsStartday() {
		$this->fixture->setStartday('Conceived at T3CON10');
		$this->assertSame('Conceived at T3CON10', $this->fixture->getStartday());
	}

	/**
	 * @test
	 */
	public function setDaysForIntegerSetsDays() {
		$this->fixture->setDays(12);
		$this->assertSame(12, $this->fixture->getDays());
	}

	/**
	 * @test
	 */
	public function setPersonsForIntegerSetsPersons() {
		$this->fixture->setPersons(12);
		$this->assertSame(12, $this->fixture->getPersons());
	}

	/**
	 * @test
	 */
	public function getPricesEinzelzimmer() {
		$prices = $this->fixture->getPrices(8, 1);
		$this->assertEquals(array(
			28, 196, 300
		), $prices);
		$prices = $this->fixture->getPrices(9, 1);
		$this->assertEquals(array(
			28, 196, 300
		), $prices);
	}

	/**
	 * @test
	 */
	public function getPricesDoppelzimmer() {
		$prices = $this->fixture->getPrices(6, 2);
		$this->assertEquals(array(
			40, 280, 360
		), $prices);
	}

	/**
	 * @test
	 */
	public function getPricesAppartment1Person() {
		$prices = $this->fixture->getPrices(2, 1);
		$this->assertEquals(array(
			38, 240, 700
		), $prices);
	}

	/**
	 * @test
	 */
	public function getPricesAppartment2Personen() {
		$prices = $this->fixture->getPrices(2, 2);
		$this->assertEquals(array(
			65, 400, 700
		), $prices);
	}

	/**
	 * @test
	 */
	public function getTotalEinzelzimmerDay() {
		$this->fixture->setFlat(8);
		$this->assertEquals(28, $this->fixture->getTotalByDays(1));
		$this->assertEquals(168, $this->fixture->getTotalByDays(6));
	}

	/**
	 * @test
	 */
	public function getTotalEinzelzimmerWeek() {
		$this->fixture->setFlat(8);
		$this->assertEquals(196, $this->fixture->getTotalByDays(7));
	}
}
?>