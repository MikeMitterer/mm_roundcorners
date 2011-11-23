<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

require_once(PATH_site . '/typo3conf/ext/' . $_EXTKEY . '/pi1/class.tx_mmroundcorners_helper.php');

//t3lib_extMgm::addPlugin(Array('LLL:EXT:mm_roundcorners/locallang_db.xml:tt_content.splash_layout_pi1', $_EXTKEY.'_pi1'),'splash_layout');

t3lib_div::loadTCA('tt_content');

tx_mmroundcorners_pi1::generateListboxEntry($_EXTKEY,55,65);


t3lib_extMgm::addStaticFile($_EXTKEY,"static/","MM RoundCorners");

?>