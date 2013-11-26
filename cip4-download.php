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
	header('Content-Description: File Transfer');
    header('Content-Disposition: attachment; filename=' . basename($target));
	header('Content-Type: application/octet-stream');
    header('Content-Length: ' . filesize($target));
    readfile($target, true);
?>