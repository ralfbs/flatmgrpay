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
class Tx_Flatmgrpay_Controller_BookingController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * all payment providers
	 *
	 * @var array
	 */
	protected $_paymentProviders = array();

	/**
	 * bookingRepository
	 *
	 * @var Tx_Flatmgrpay_Domain_Repository_BookingRepository
	 */
	protected $bookingRepository;

	/**
	 * injectBookingRepository
	 *
	 * @param $bookingRepository Tx_Flatmgrpay_Domain_Repository_BookingRepository       	
	 * @return void
	 */
	public function injectBookingRepository(Tx_Flatmgrpay_Domain_Repository_BookingRepository $bookingRepository) {
		$this->bookingRepository = $bookingRepository;
	}

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$bookings = $this->bookingRepository->findAll();
		$this->view->assign('bookings', $bookings);
	}

	/**
	 * action show
	 *
	 * @param $booking Tx_Flatmgrpay_Domain_Model_Booking       	
	 * @return void
	 */
	public function showAction(Tx_Flatmgrpay_Domain_Model_Booking $booking) {
		$this->view->assign('booking', $booking);
	}

	/**
	 * action new
	 *
	 * @param $newBooking @dontvalidate       	
	 * @return void
	 */
	public function newAction(Tx_Flatmgrpay_Domain_Model_Booking $newBooking = NULL) {
		$this->_initPaymentProviders();
		foreach ($this->_paymentProviders as $providerObj) {
			$tmpArr = $providerObj->getAvailablePaymentMethods();
		}
		$this->view->assign('paymentMethods', $tmpArr);
		$this->view->assign('newBooking', $newBooking);
	}

	
	
	
	/**
	 * action create
	 *
	 * @param $newBooking x_Flatmgrpay_Domain_Model_Booking       	
	 * @return void
	 */
	public function createAction(Tx_Flatmgrpay_Domain_Model_Booking $booking) {
		$fail = false;
		$selectedPaymentMethod = 'paymentlib_worldpay_creditcard';
		$providerFactoryObj = tx_paymentlib_providerfactory::getInstance();
		$providerObj = $providerFactoryObj->getProviderObjectByPaymentMethod($selectedPaymentMethod);
		$ok = $providerObj->transaction_init(TX_PAYMENTLIB_TRANSACTION_ACTION_AUTHORIZEANDTRANSFER, $selectedPaymentMethod, TX_PAYMENTLIB_GATEWAYMODE_FORM, 'flatmgrpay');
		if (! $ok) {
			$this->flashMessageContainer->add('ERROR: Could not initialize transaction.');
			$fail = true;
		}
		$this->bookingRepository->add($booking);
		$transactionDetails = array(
			'transaction' => array(
			'amount' => '6.60', 'currency' => 'EUR'
		), 'options' => array(
			'reference' => 'abx'
		)
		);
		$ok = $providerObj->transaction_setDetails($transactionDetails);
		if (! $ok) {
			$this->flashMessageContainer->add('ERROR: Setting details of transaction failed.');
			$fail = true;
		}
		if (! $fail) {
			$formAction = $providerObj->transaction_formGetActionURI();
			$this->view->assign('formAction', $formAction);
			$hiddenFieldsArr = $providerObj->transaction_formGetHiddenFields();
			$this->view->assign('hiddenFields', $hiddenFieldsArr);
		}
		$this->view->assign('booking', $booking);
	}

	/**
	 * action transact - call the actual transaction
	 *
	 * @param $newBooking x_Flatmgrpay_Domain_Model_Booking       	
	 * @return void
	 */
	public function transactAction(Tx_Flatmgrpay_Domain_Model_Booking $createBooking) {
	}

	/**
	 * action edit
	 *
	 * @param $bookin Tx_Flatmgrpay_Domain_Model_Booking       	
	 * @return void
	 */
	public function editAction(Tx_Flatmgrpay_Domain_Model_Booking $booking) {
		$this->view->assign('booking', $booking);
	}

	/**
	 * action update
	 *
	 * @param $booking Tx_Flatmgrpay_Domain_Model_Booking
	 *       	 * @return void
	 */
	public function updateAction(Tx_Flatmgrpay_Domain_Model_Booking $booking) {
		$this->bookingRepository->update($booking);
		$this->flashMessageContainer->add('Your Booking was updated.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param $bookin Tx_Flatmgrpay_Domain_Model_Booking       	
	 * @return void
	 */
	public function deleteAction(Tx_Flatmgrpay_Domain_Model_Booking $booking) {
		$this->bookingRepository->remove($booking);
		$this->flashMessageContainer->add('Your Booking was removed.');
		$this->redirect('list');
	}

	/**
	 * include and initialize the Paymentlib
	 *
	 * @return void
	 */
	protected function _initPaymentProviders() {
		$providerFactoryObj = tx_paymentlib_providerfactory::getInstance();
		$this->_paymentProviders = $providerFactoryObj->getProviderObjects();
	}
}
?>