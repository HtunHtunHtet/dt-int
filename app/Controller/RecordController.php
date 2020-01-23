<?php
	class RecordController extends AppController{
		
		var $components = array('RequestHandler');
		
		
		public function index(){
			ini_set('memory_limit','256M');
			set_time_limit(0);
			
			$this->setFlash('Listing Record page too slow, try to optimize it.');
			
			//$records = $this->Record->find('all');
			//$this->set('records',$records);
			
			
			/*$query  = "SELECT * FROM records LIMIT 10,20";
			$recordTest = $this->Record->query($query);
			$this->set('records', $recordTest);*/
			
			$this->set ('records', array());
			
			$this->set('title',__('List Record'));
		}
		
		public function getRecords(){
			//false auto render template
			$this->autoRender = false;
			
			
			/*$records = $this->Record->find('all', array(
							'limit' => 10,
							'offset'=> 10,
							'order' => 'Record.id ASC',
						));*/
			
			$records = $this->Record->find('all');
			
			return json_encode($records);
		}
		
		
// 		public function update(){
// 			ini_set('memory_limit','256M');
			
// 			$records = array();
// 			for($i=1; $i<= 1000; $i++){
// 				$record = array(
// 					'Record'=>array(
// 						'name'=>"Record $i"
// 					)			
// 				);
				
// 				for($j=1;$j<=rand(4,8);$j++){
// 					@$record['RecordItem'][] = array(
// 						'name'=>"Record Item $j"		
// 					);
// 				}
				
// 				$this->Record->saveAssociated($record);
// 			}
			
			
			
// 		}
	}