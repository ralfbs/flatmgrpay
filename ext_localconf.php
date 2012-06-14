<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Faltmgrpay',
	array(
		'Booking' => 'new, create',
		
	),
	// non-cacheable actions
	array(
		'Booking' => 'new, create',
		
	)
);

?>