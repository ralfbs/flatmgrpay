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

if (TYPO3_MODE === 'FE') {
    /* @var $renderer t3lib_PageRenderer */
    $renderer = t3lib_div::makeInstance('t3lib_PageRenderer');
    $renderer->addJsFile(t3lib_extMgm::siteRelPath($_EXTKEY) . 'Resources/Public/Js/flatmgrpay.js');
    // append as last:
    // $renderer->addHeaderData('<link rel="stylesheet" type="text/css" href="typo3conf/ext/hriyaml/Resources/Public/Css/mobile.css" media="all" />')
}
?>