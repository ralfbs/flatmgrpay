<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 
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
 * @see http://www.benny-vs-web.de/typo3/extbase-session-handler-selbstgebastelt/
 *      $sessionHandler = t3lib_div::makeInstance('Tx_Flatmgrpay_Session_Flat');
 *     
 * @package mpistbase
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License,
 *          version 3 or later
 */
class Tx_Flatmgrpay_Session_Flat implements t3lib_Singleton {

	/**
	 * Write an array to the sesion
	 *
	 * @param $params array       	
	 */
	public static function writeToSession(array $params = array()) {
		$session = self::getParams();
		if (array_key_exists('flatUid', $session) and array_key_exists('flat_Uid', $params)) {
			if ($session['flatUid'] != $params['flatUid']) {
				unset($session['flat']);
				unset($session['flatUid']);
			}
		}
		$newSession = $params;
		if (!empty($session)) {
			$newSession = array_merge((array)$session, (array) $params);
		}
		// make sure empty values do not overwrite
		foreach($newSession as $key => $value) {
			if (empty($value)) {
				unset($newSession[$key]);
			}
		}
		self::_writeToSession($newSession);
	}

	/**
	 * get all params from session or one specific if given
	 *
	 * @return array
	 */
	public static function getParams() {
		$params = self::_restoreFromSession();
		if (array_key_exists('start', $params) and array_key_exists('end', $params)) {
			$startTimestamp = strtotime($params['start']);
			$endTimestamp = strtotime($params['end']);
			
			// fix calc on some OS!?
			$extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['flatmgrpay']);
			$endTimestamp +=  (int)$extConf['daysOffset'] * 86400;
			$endDate = new DateTime();
			$endDate->setTimestamp($endTimestamp);
			
			$params['end'] = (string) $endDate->format('d.m.Y');
			
			$params['days'] = ($endTimestamp - $startTimestamp) / 86400;
		}
		return (array)$params;
	}

	/**
	 * get all params from session or one specific if given
	 *
	 * @param $key string
	 *       	 ('start', 'end', 'days', 'email', 'flatUid', 'flat')
	 * @return string
	 */
	public static function getParam($key) {
		$params = self::getParams();
		if (array_key_exists($key, $params)) {
			return $params[$key];
		}
	}

	/**
	 * Returns the object stored in the user´s PHP session
	 *
	 * @return Object the stored object
	 */
	protected static function _restoreFromSession() {
		$sessionData = $GLOBALS['TSFE']->fe_user->getKey('ses', 'tx_flatmgrpay');
		return (array)unserialize($sessionData);
	}

	/**
	 * Writes an object into the PHP session
	 *
	 * @param $object any
	 *       	 object to store into the session
	 * @return Tx_MyExt_Domain_Session_SessionHandler this
	 */
	protected static function _writeToSession($object) {
		$sessionData = serialize($object);
		$GLOBALS['TSFE']->fe_user->setKey('ses', 'tx_flatmgrpay', $sessionData);
		$GLOBALS['TSFE']->fe_user->storeSessionData();
		return $this;
	}

	/**
	 * Cleans up the session: removes the stored object from the PHP session
	 *
	 * @return Tx_MyExt_Domain_Session_SessionHandler this
	 */
	protected static function _cleanUpSession() {
		$GLOBALS['TSFE']->fe_user->setKey('ses', 'tx_flatmgrpay', NULL);
		$GLOBALS['TSFE']->fe_user->storeSessionData();
		return $this;
	}
}
?>