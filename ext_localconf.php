<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

require_once(PATH_site . '/typo3conf/ext/' . $_EXTKEY . '/pi1/class.tx_mmroundcorners_helper.php');


//t3lib_extMgm::addPItoST43($_EXTKEY,'pi1/class.tx_mmroundcorners_pi1.php','_pi1','splash_layout',1);


  ## Setting TypoScript for the image in the textbox:
//t3lib_extMgm::addTypoScript($_EXTKEY,'setup','
//	plugin.tx_mmroundcorners_pi1_pi1.IMAGEcObject {
//	  file.width=100
//	}
//',43);
$templateName	= 'roundcorners.html';
$htmlparser		= t3lib_div::makeInstance("t3lib_parsehtml");
$templateFile	= PATH_site . '/typo3conf/ext/' . $_EXTKEY . '/res/template/' . $templateName;
$template 		= tx_mmroundcorners_pi1::getFileContent($templateFile);

tx_mmroundcorners_pi1::generateTSCommand($htmlparser,$_EXTKEY,55,60,$template,'###ROUNDBORDER###');
tx_mmroundcorners_pi1::generateTSCommand($htmlparser,$_EXTKEY,60,65,$template,'###ROUNDBOX###');




?>