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
 *         
 */
class Tx_Flatmgrpay_Domain_Repository_FlatRepository extends Tx_Extbase_Persistence_Repository {

	/**
	 * (non-PHPdoc)
	 *
	 * @see Tx_Extbase_Persistence_Repository::findAll()
	 */
	public function findAll() {
		$sql = "SELECT * FROM `tx_flatmgr_flat` WHERE `deleted` = 0 ";
		$query = $this->createQuery();
		$query->statement($sql);
		return $query->execute();
	}

	/**
	 * (non-PHPdoc)
	 * 
	 * @see Tx_Extbase_Persistence_Repository::findByUid()
	 */
	public function findByUid($uid) {
		$sql = "SELECT * FROM `tx_flatmgr_flat` WHERE `deleted` = 0 AND `uid` = {$uid}";
		$query = $this->createQuery();
		$query->statement($sql);
		return $query->execute();
	}

	/**
	 * 
	 * @param integer $uid
	 * @return Tx_Flatmgrpay_Domain_Model_Flat
	 */
	public function getFlatByUid($uid) {
		$flats = $this->findByUid($uid);
		return $flats->getFirst();
	}
}
?>