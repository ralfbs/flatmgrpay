<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'Faltmgrpay',
	'flatmgrpay'
);

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Flat Manager Payment');

			t3lib_extMgm::addLLrefForTCAdescr('tx_flatmgrpay_domain_model_booking', 'EXT:flatmgrpay/Resources/Private/Language/locallang_csh_tx_flatmgrpay_domain_model_booking.xml');
			t3lib_extMgm::allowTableOnStandardPages('tx_flatmgrpay_domain_model_booking');
			$TCA['tx_flatmgrpay_domain_model_booking'] = array(
				'ctrl' => array(
					'title'	=> 'LLL:EXT:flatmgrpay/Resources/Private/Language/locallang_db.xml:tx_flatmgrpay_domain_model_booking',
					'label' => 'name',
					'tstamp' => 'tstamp',
					'crdate' => 'crdate',
					'cruser_id' => 'cruser_id',
					'dividers2tabs' => TRUE,
					'versioningWS' => 2,
					'versioning_followPages' => TRUE,
					'origUid' => 't3_origuid',
					'languageField' => 'sys_language_uid',
					'transOrigPointerField' => 'l10n_parent',
					'transOrigDiffSourceField' => 'l10n_diffsource',
					'delete' => 'deleted',
					'enablecolumns' => array(
						'disabled' => 'hidden',
						'starttime' => 'starttime',
						'endtime' => 'endtime',
					),
					'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Booking.php',
					'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_flatmgrpay_domain_model_booking.gif'
				),
			);

?>