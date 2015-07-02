<?php

// TODO: LIthium users enable in app/config/bootstrap/libraries.php
namespace FileAlterationMonitor\FileAlterationMonitor;

// use dBug
use dBug\dBug\dBug;

// use dasBug
// use dBug
use dasBug\dasBug\dasBug;

class FileAlterationMonitor {
	private $scanFolder, $initialFoundFiles;

	public function __construct($scanFolder = false) {
		// if directory exists
		if ($this -> directory_exists($scanFolder)) {

			// get set scanfolder
			$this -> scanFolder = $scanFolder;

			// update monitor
			$this -> updateMonitor();

		}
	}// end __construct()

	private function _arrayValuesRecursive($array) {
		$arrayValues = array();

		foreach ($array as $value) {
			if (is_scalar($value) OR is_resource($value)) {
				$arrayValues[] = $value;
			} elseif (is_array($value)) {
				$arrayValues = array_merge($arrayValues, $this -> _arrayValuesRecursive($value));
			}
		}

		return $arrayValues;
	}

	private function _scanDirRecursive($directory) {
		$folderContents = array();
		$directory = realpath($directory) . DIRECTORY_SEPARATOR;

		new dasBug($directory);


		foreach (scandir($directory) as $folderItem) {
			
			//
			new dasBug(scandir($directory));
			die();
			
			if ($folderItem != "." AND $folderItem != "..") {
				
				//
				if (is_dir($directory . $folderItem . DIRECTORY_SEPARATOR)) {
					
					//
					$folderContents[$folderItem] = $this -> _scanDirRecursive($directory . $folderItem . "\\");
				
				} else {
					
					//
					$folderContents[] = $folderItem;
				}
			}
		}
		
		return $folderContents;
	}

	public function getNewFiles() {
		$finalFoundFiles = $this -> _arrayValuesRecursive($this -> _scanDirRecursive($this -> scanFolder));

		if ($this -> initialFoundFiles != $finalFoundFiles) {
			$newFiles = array_diff($finalFoundFiles, $this -> initialFoundFiles);
			return empty($newFiles) ? FALSE : $newFiles;
		}
	}

	public function getRemovedFiles() {
		$finalFoundFiles = $this -> _arrayValuesRecursive($this -> _scanDirRecursive($this -> scanFolder));

		if ($this -> initialFoundFiles != $finalFoundFiles) {
			$removedFiles = array_diff($this -> initialFoundFiles, $finalFoundFiles);
			return empty($removedFiles) ? FALSE : $removedFiles;
		}
	}

	public function updateMonitor() {
		
		//
		$this->directory_exists_process($this->scanFolder);
		
		
		//
		//$this -> _scanDirRecursive($this -> scanFolder);
		die();

		//$this -> initialFoundFiles = $this -> _arrayValuesRecursive($this -> _scanDirRecursive($this -> scanFolder));
	}

	public function directory_exists($module = false) {
		// flag
		$output = false;

		//
		if (isset($module) && !empty($module)) {

			//
			if (is_dir($module)) {
				echo "is a directory";
				$output = true;
			}

		}// if $module set

		//
		return $output;
		
	}// end directory_exists()
	
	public function directory_exists_process($modules=false) {
		
		//
		if(isset($modules) && !empty($modules)){
			
			new dBug(scandir($modules));
			
			//
			foreach (scandir($modules) as $module) {
				
				if(isset($module) && !empty($module)){
					
					//
					new dBug($module);					
				}
				
				//

			}// end foreach
			
			die();
			
		}// end $mdoule
		
	}// end directory_exists_process	
	

}
?>
