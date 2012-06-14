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
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package TYPO3
 * @subpackage Flat Manager Payment
 *
 * @author Ralf Schneider <ralf@hr-interactive.de>
 */
class Tx_Flatmgrpay_Domain_Model_BookingTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
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
	public function getFeuserReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setFeuserForStringSetsFeuser() { 
		$this->fixture->setFeuser('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getFeuser()
		);
	}
	
	/**
	 * @test
	 */
	public function getFlatReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setFlatForStringSetsFlat() { 
		$this->fixture->setFlat('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getFlat()
		);
	}
	
	/**
	 * @test
	 */
	public function getStartdayReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setStartdayForStringSetsStartday() { 
		$this->fixture->setStartday('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getStartday()
		);
	}
	
	/**
	 * @test
	 */
	public function getDaysReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setDaysForStringSetsDays() { 
		$this->fixture->setDays('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getDays()
		);
	}
	
	/**
	 * @test
	 */
	public function getPersonsReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setPersonsForStringSetsPersons() { 
		$this->fixture->setPersons('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getPersons()
		);
	}
	
}
?>