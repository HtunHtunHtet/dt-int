<?php

class FileUploadController extends AppController {
	
	
	/**
	 * File Upload
	 */
	public function index() {
		set_time_limit(3600);
		
		if ($this->request->is('post')) {
			$submittedFile     = $this->request->data['FileUpload']['file'];
			$isCSV            = $this->FileUpload->validateCSV($submittedFile);
			
			if($isCSV){
				try{
					$uploadPath = 'uploads/files/';
					$uploadFile = $uploadPath.$submittedFile['name'];
					if (move_uploaded_file($submittedFile['tmp_name'], $uploadFile)){
						$contents       = file_get_contents($uploadFile);
						$myString       = preg_replace(array('/\n/', '/\r/'), '#PH#', $contents);
						$explode        = explode("#PH#", $myString);
						$finalDataArray = array();
						
						foreach( $explode as $data ) {
							$secondaryDateArray = array();
							if(strpos($data , ",") > 0) {
								$dataExplode    = explode(",",$data);
								foreach ($dataExplode as $key => $d) {
									if( $d !=="Name"  && $d !=="Email") {
										//$this->FileUpload->set('')
										($key== 0 ) ? $secondaryDateArray["Name"] = $d
													: $secondaryDateArray["Email"] = $d ;
										
									}
								}
								
							}
							
							if(count($secondaryDateArray) > 0){
								array_push($finalDataArray, $secondaryDateArray);
							}
							
						}
						
						if(count($finalDataArray) > 0) {
							foreach($finalDataArray as $k => $value) {
								$this->FileUpload->create();
								$this->FileUpload->set('name',$value['Name']);
								$this->FileUpload->set('email',$value['Email']);
								$this->FileUpload->save();
								
								//log success
								CakeLog::info('Successfully added Date : Name = '.$value['Name'].' Email = '.$value['Email']);
							}
						}
						
						//$this->Session->setFlash('Data Imported', 'flash_success');
						$this->setSuccess('Data Imported');
						
						
					}
				}catch (Exception $e){
					CakeLog::error($e);
					$this->setError($e);
				}
				
			}else {
				//invalid csv
				$this->setError('Invalid File Extension. Only .csv extension are allow to upload');
				
			}
		}
		
		$this->set('title', __('File Upload Answer'));

		$file_uploads = $this->FileUpload->find('all');
		$this->set(compact('file_uploads'));
	}
}