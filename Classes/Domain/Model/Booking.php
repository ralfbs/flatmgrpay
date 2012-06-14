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
 *
 * @package flatmgrpay
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
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
	 * @var integer
	 * @validate NotEmpty
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
	 * @var integer
	 * @validate NotEmpty
	 */
	protected $days;

	/**
	 * Personen
	 *
	 * @var integer
	 * @validate NotEmpty
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
	 * @param string $startday
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
	 * @param integer $flat
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
	 * @param integer $days
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
	 * @param integer $persons
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
	 * @param string $name
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
	 * @param Tx_Extbase_Domain_Model_FrontendUser $feuser
	 * @return void
	 */
	public function setFeuser(Tx_Extbase_Domain_Model_FrontendUser $feuser) {
		$this->feuser = $feuser;
	}

}
?>