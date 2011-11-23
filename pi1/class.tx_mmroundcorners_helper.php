<?php

class tx_mmroundcorners_pi1 {

	function generateListboxEntry($extkey,$keyStart,$keyEnd) {
		global $TCA;
		
		for($key = $keyStart;$key < $keyEnd;$key++) {
			$TCA['tt_content']['columns']['section_frame']['config']['items'][] = 
				Array('LLL:EXT:' . $extkey . 
					'/locallang_db.php:tt_content.section_frames_'.$key,$key);
		}
	}
	
	function generateTSCommand(&$htmlparser,$extkey,$keyStart,$keyEnd,$template,$subTemplateName) {
		$roundborder 	= $htmlparser->getSubpart($template,$subTemplateName);
		$block1			= $htmlparser->getSubpart($roundborder,'###BEFORECONTENT###');
		$block2			= $htmlparser->getSubpart($roundborder,'###AFTERCONTENT###');
		
		//t3lib_div::debug($template,'$template');
		
		for($key = $keyStart;$key < $keyEnd;$key++) {
			$boxnumber = $key - $keyStart;
			
			$markerArray['###BOXNUMBER###'] = $boxnumber + 1;
			
			$CSSCode1	= trim(tx_mmroundcorners_pi1::substituteMarkerArray($block1,$markerArray)); 
			$CSSCode2	= trim(tx_mmroundcorners_pi1::substituteMarkerArray($block2,$markerArray)); 
			
			//$CSSCode1 = '';
			//$CSSCode2 = '';
			
			//t3lib_div::debug($CSSCode1,'$CSSCode1');
			//t3lib_div::debug($CSSCode2,'$CSSCode2');
			
			$TSCommand1 = 'tt_content.stdWrap.innerWrap.cObject.' . $key . ' = TEXT';
			$TSCommand2 = 'tt_content.stdWrap.innerWrap.cObject.' . $key . '.value = ' . 
				$CSSCode1 . '|' . $CSSCode2;
			
			$TSCommand2 = str_replace(Array("\n","\r","\t"),'',$TSCommand2);
			
			//t3lib_div::debug($TSCommand2,'$TSCommand2');
			
			t3lib_extMgm::addTypoScript($extkey,'setup',$TSCommand1,43);
			t3lib_extMgm::addTypoScript($extkey,'setup',$TSCommand2,43);
		}
	}
	
	function substituteMarkerArray($content,$markContentArray) {
		foreach($markContentArray as $marker => $markContent) {
			$content = str_replace($marker,$markContent,$content);
		}
		return $content;
	}
	
	function getFileContent($incFile)    {
		$content = '';
		if ($incFile && $fd=fopen($incFile,'rb')) {
				while (!feof($fd)) {
				$content.=fread($fd, 5000);
			}
			fclose( $fd );
			return $content;
		}
	}
}

?>