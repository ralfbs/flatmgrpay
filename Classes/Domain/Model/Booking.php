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
	 * prices
	 * 1: Appartment, 1 Person => (Preis/Tag, Preis/Woche, Preis/Monat)
	 * 2: Appartment, 2 Personen
	 * einzel: Einzelzimmer
	 * doppel: Doppelzimmer
	 *
	 * @var array
	 *
	 *
	 *
	 */
	protected $prices = array(
		'1' => array(
		38, 240, 700
	), '2' => array(
		65, 400, 700
	), 'einzel' => array(
		array(
		28, 196, 300
	)
	), 'doppel' => array(
		40, 280, 360
	)
	);

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
		switch ($this->name) {
			case 'a1':
			case 'a2':
			case 'b1':
			case 'b2':
				$prices = $this->prices[$this->persons];
				break;
			case 'h3':
			case 'h4':
			case 'h5':
				$prices = $this->prices['einzel'];
				break;
			case 'h1':
			case 'h2':
			case 'h6':
			case 'h7':
				$prices = $this->prices['doppel'];
				break;
			default:
				$prices = 0;
				break;
		}
		$days = $this->getDays();
		if (7 >= $days) {
			$total = $prices[0] * $days;
		} elseif (31 >= $days) {
			$total = $prices[1];
		} else {
			$total = $prices[2] * ceil($days / 31);
		}
		
		return $total;
	}

	/**
	 * Berechnet die Höhe der notwendig Anzahlung
	 */
	public function getAnzahlung() {
		$extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['flatmgrpay']);
		$downpaymentRate = (int) $extConf['downpaymentRate'];
		return $this->getTotal() * $downpaymentRate / 100;
	}
}
?>