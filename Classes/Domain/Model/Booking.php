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
 *  the Free Software Foundation; either version 3 of the License, or
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
 *
 * @package flatmgrpay
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License,
 *          version 3 or later
 */
class Tx_Flatmgrpay_Domain_Model_Booking extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * Name
	 *
	 * @var string
	 */
	protected $name;

	/**
	 * Zimmer
	 *
	 * @var integer @validate NotEmpty
	 */
	protected $flat;

	/**
	 * Anreisetag
	 *
	 * @var string
	 */
	protected $startday;

	/**
	 * Nächte
	 *
	 * @var integer @validate NotEmpty
	 */
	protected $days;

	/**
	 * Personen
	 *
	 * @var integer @validate NotEmpty
	 */
	protected $persons;

	/**
	 * FeUser
	 *
	 * @var Tx_Extbase_Domain_Model_FrontendUser
	 */
	protected $feuser;

	/**
	 * Returns the startday
	 *
	 * @return string startday
	 */
	public function getStartday() {
		return $this->startday;
	}

	/**
	 * Sets the startday
	 *
	 * @param $startday string       	
	 * @return string startday
	 */
	public function setStartday($startday) {
		$this->startday = $startday;
	}

	/**
	 * Returns the flat
	 *
	 * @return integer flat
	 */
	public function getFlat() {
		return $this->flat;
	}

	/**
	 * Sets the flat
	 *
	 * @param $flat integer       	
	 * @return integer flat
	 */
	public function setFlat($flat) {
		$this->flat = $flat;
	}

	/**
	 * Returns the days
	 *
	 * @return integer days
	 */
	public function getDays() {
		return $this->days;
	}

	/**
	 * Sets the days
	 *
	 * @param $days integer       	
	 * @return integer days
	 */
	public function setDays($days) {
		$this->days = $days;
	}

	/**
	 * Returns the persons
	 *
	 * @return integer persons
	 */
	public function getPersons() {
		return $this->persons;
	}

	/**
	 * Sets the persons
	 *
	 * @param $persons integer       	
	 * @return integer persons
	 */
	public function setPersons($persons) {
		$this->persons = $persons;
	}

	/**
	 * Returns the name
	 *
	 * @return string name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets the name
	 *
	 * @param $name string       	
	 * @return string name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Returns the feuser
	 *
	 * @return Tx_Extbase_Domain_Model_FrontendUser $feuser
	 */
	public function getFeuser() {
		return $this->feuser;
	}

	/**
	 * Sets the feuser
	 *
	 * @param $feuser Tx_Extbase_Domain_Model_FrontendUser       	
	 * @return void
	 */
	public function setFeuser(Tx_Extbase_Domain_Model_FrontendUser $feuser) {
		$this->feuser = $feuser;
	}

	/**
	 * Berechnet die Gesamtkosten für den angegebenen Zeitraum
	 *
	 * @return float
	 */
	public function getTotal() {
		switch ((int) $this->getPersons()) {
			case 1:
				$costPerDay = 33;
				break;
			case 2:
				$costPerDay = 28;
				break;
			case 3:
				$costPerDay = 25;
				break;
			case 4:
				$costPerDay = 20;
				break;
			default:
				$costPerDay = 33;
				break;
		}
		return $this->getDays() * $costPerDay;
	}

	/**
	 * Berechnet die Höhe der notwendig Anzahlung
	 */
	public function getAnzahlung() {
		return $this->getTotal() * 0.2;
	}
}
?>