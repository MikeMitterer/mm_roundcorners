<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2008 Mike Mitterer <office@bitcon.at>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
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
 * Plugin 'RoundCorners' for the 'mm_roundcorners' extension.
 *
 * @author	Mike Mitterer <office@bitcon.at>
 */


require_once(PATH_tslib.'class.tslib_pibase.php');

class tx_mmroundcorners_pi1 extends tslib_pibase {
	var $prefixId = 'tx_mmroundcorners_pi1';		// Same as class name
	var $scriptRelPath = 'pi1/class.tx_mmroundcorners_pi1.php';	// Path to this script relative to the extension dir.
	var $extKey = 'mm_roundcorners';	// The extension key.
	var $pi_checkCHash = TRUE;
	
	/**
	 * The main method of the PlugIn
	 *
	 * @param	string		$content: The PlugIn content
	 * @param	array		$conf: The PlugIn configuration
	 * @return	The content that is displayed on the website (Textbox)
	 */
	function main($content,$conf)	{
	
			// Processes the image-field content:
			// $conf['IMAGEcObject.'] is passed to the getImage() function as TypoScript
			// configuration for the image (except filename which is set automatically here)
		$imageFiles = explode(',',$this->cObj->data['image']);	// This returns an array with image-filenames, if many
		$imageRows=array();	// Accumulates the images
		reset($imageFiles);
		while(list(,$iFile)=each($imageFiles))	{
			$imageRows[] = '<tr>
				<td>'.$this->getImage($iFile,$conf['IMAGEcObject.']).'</td>
			</tr>';
		}
		$imageBlock = count($imageRows)?'<table border=0 cellpadding=5 cellspacing=0>'.implode('',$imageRows).'</table>':'<img src=clear.gif width=100 height=1>';
	
			// Sets bodytext
		$bodyText = nl2br($this->cObj->data['bodytext']);
	
			// And compiles everything into a table:
		$finalContent = '<table border=1>
			<tr>
				<td valign=top>'.$imageBlock.'</td>
				<td valign=top>'.$bodyText.'</td>
			</tr>
		</table>';
	
			// And returns content
		return $finalContent;
	}
	
	/**
	 * This calls a function in the TypoScript API which will return an image tag with the image
	 * processed according to the parsed TypoScript content in the $TSconf array.
	 *
	 * @param	string		$filename: The filename of the image
	 * @param	array		$TSconf: The TS configuration for displaying the image
	 * @return	The image HTML code
	 */
	function getImage($filename,$TSconf)	{
		list($theImage)=explode(',',$filename);
		$TSconf['file'] = 'uploads/pics/'.$theImage;
		$img = $this->cObj->IMAGE($TSconf);
		return $img;
	}
}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/mm_roundcorners/pi1/class.tx_mmroundcorners_pi1.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/mm_roundcorners/pi1/class.tx_mmroundcorners_pi1.php']);
}

?>