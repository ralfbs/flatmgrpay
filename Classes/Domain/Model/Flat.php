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
class Tx_Flatmgrpay_Domain_Model_Flat extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 *
	 * @var string
	 */
	protected $name;

	/**
	 *
	 * @var string
	 */
	protected $minprice;

	/**
	 *
	 * @var integer
	 */
	protected $category;

	/**
	 *
	 * @var integer
	 */
	protected $capacity;

	/**
	 *
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 *
	 * @return string
	 */
	public function getMinprice() {
		return $this->minprice;
	}

	/**
	 *
	 * @return integer
	 */
	public function getCategory() {
		return $this->category;
	}

	/**
	 *
	 * @return integer
	 */
	public function getCapacity() {
		return $this->capacity;
	}

	/**
	 *
	 * @param string $name        	
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 *
	 * @param string $minprice        	
	 */
	public function setMinprice($minprice) {
		$this->minprice = $minprice;
	}

	/**
	 *
	 * @param integer $category        	
	 */
	public function setCategory($category) {
		$this->category = $category;
	}

	/**
	 *
	 * @param integer $capacity        	
	 */
	public function setCapacity($capacity) {
		$this->capacity = $capacity;
	}
	
}
?>