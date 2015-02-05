<?php

	// SECURITY MECHANISM
	// Due to directory traversal protection you can only download files if there exist a 
	// file ".cip4-download-info.csv" in the same directory.
	
	// get param
	$target = $_GET['target'];
	
	
	
	$rootPath = '../../../';
	
	// $infoPath = $rootPath . $infoPath;
	$target = $rootPath . $target;

	$pos = strrpos($target, '/');
	$infoPath = substr($target, 0, $pos+1) . '.cip4-download-info.csv';

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
		
		// redirect to download
		header('Content-Description: File Transfer');
	    header('Content-Disposition: attachment; filename="' . basename($target) . '"');
		header('Content-Type: application/octet-stream');
	    header('Content-Length: ' . filesize($target));
	    readfile($target, true);
		
	} else {
		
		echo "ERROR: Due to security reasons, the download is not possible (protection against directory traversal).";
	}
	
	
?>