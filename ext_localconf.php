<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}


Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Flatmgrpay',
	array(
		'Booking' => 'new, create, confirm, scan',
		
	),
	// non-cacheable actions
	array(
		'Booking' => 'new, create, confirm, scan',
		
	)
);


if (t3lib_extMgm::isLoaded('paymentlib', true)) {
	require_once(t3lib_extMgm::extPath('paymentlib') . 'lib/class.tx_paymentlib_providerfactory.php');

}
?>