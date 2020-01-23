<?php

class FileUpload extends AppModel {
	
	public function validateCSV ($file) {
		$csv_mime_types = ['text/csv'];
		$type = $file['type'];
		return (in_array($file['type'],$csv_mime_types)) ? true: false;
	}

}