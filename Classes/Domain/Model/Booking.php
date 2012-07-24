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
	 */
	protected $prices = array(
		'1' => array(
		38, 240, 700
	), '2' => array(
		65, 400, 700
	), 'einzel' => array(
		28, 196, 300
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
	 *
	 * @var Tx_Flatmgrpay_Domain_Model_Flat
	 */
	protected $flatObject;

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
	 *
	 * @return array pricelist for different durations
	 * @param integer $flat        	
	 * @param integer $persons        	
	 */
	public function getPrices($flat, $persons) {
		switch ($flat) {
			// Appartment (1-2 Pers)
			case '2':
			case '3':
			case '4':
			case '5':
				$prices = $this->prices[$persons];
				break;
			// Hostelzimmer (ein Bett: einzel)
			case '8':
			case '9':
				$prices = $this->prices['einzel'];
				break;
			// Hostelzimmer (zwei Betten: doppel)
			case '6':
			case '7':
			case '10':
			case '11':
			case '12':
			case '13':
				$prices = $this->prices['doppel'];
				break;
			default:
				$prices = array(
					0, 0, 0
				);
				break;
		}
		return $prices;
	}

	/**
	 * calculate days, weeks or months and select the proper price
	 * moved to this method for unit testing
	 *
	 * @param integer $days        	
	 * @return float
	 */
	public function getTotalByDays($days) {
		$prices = $this->getPrices($this->flat, $this->persons);
		$daysRemaining = $days;
		$total = 0;
		$months = 0;
		while ($daysRemaining > 30) {
			$months ++;
			$daysRemaining -= 30;
			$total += $prices[2];
		}
		$weeks = 0;
		while ($daysRemaining > 6) {
			$weeks ++;
			$daysRemaining -= 6;
			$total += $prices[1];
		}
		if (TYPO3_DLOG) {
			t3lib_div::devLog('getTotalByDays', 'flatmgrpay', - 1, array(
				'days' => $days, "months" => $months, 'weeks' => $weeks, 'daysRemaining' => $daysRemaining
			));
		}
		$total += $daysRemaining * $prices[0];
		return $total;
	}

	/**
	 * Berechnet die Gesamtkosten für den angegebenen Zeitraum
	 *
	 * @return integer
	 */
	public function getTotal() {
		$prices = $this->getPrices($this->flat, $this->persons);
		return $this->getTotalByDays($this->days);
	}

	/**
	 * Berechnet die Höhe der notwendig Anzahlung
	 */
	public function getAnzahlung() {
		$extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['flatmgrpay']);
		$downpaymentRate = (int) $extConf['downpaymentRate'];
		return $this->getTotal() * $downpaymentRate / 100;
	}

	/**
	 *
	 * @return Tx_Flatmgrpay_Domain_Model_Flat
	 */
	public function getFlatObject($flat) {
		if (! $this->flatObject instanceof Tx_Flatmgrpay_Domain_Model_Flat) {
			/*
			 * @var $flatRepositry
			 * Tx_Flatmgrpay_Domain_Repository_FlatRepository
			 */
			$flatRepositry = t3lib_div::makeInstance('Tx_Flatmgrpay_Domain_Repository_FlatRepository');
			$this->flatObject = $flatRepositry->getFlatByUid($flat);
		}
		return $this->flatObject;
	}
}
?>