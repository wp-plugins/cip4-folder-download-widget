<?php

	// get param
	$target = $_GET['target'];
	$infoPath = $_GET['info'];
	
	$rootPath = '../../../';
	
	$infoPath = $rootPath . $infoPath;
	$target = $rootPath . $target;

	if(file_exists($infoPath)) {
		
		$csvInfos = array();
		
		// read info csv
		$infoFile = fopen($infoPath,"r");
		while (($line = fgetcsv($infoFile)) !== FALSE) {#
			$csvInfos[$line[0]] = $line;
		}
		fclose($infoFile);
	
	
		// extract filename for target
		$file = substr( $target, strrpos( $target, '/' ) + 1 );
		
		// increment downloads value
		if ($csvInfos[$file] != '') {
			$downloads = $csvInfos[$file][1];
			$downloads ++;
			$csvInfos[$file][1] = $downloads;
		} 
		
		// update .cip4-download-info file
		$fp = fopen($infoPath, 'w');
	
		foreach ($csvInfos as $row) {
		    fputcsv($fp, $row);
		}
	
		fclose($fp);
	} 
	
	// redirect to download
	header('Location: ' . $target);
?>