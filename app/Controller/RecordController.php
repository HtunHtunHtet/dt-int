<?php
	class RecordController extends AppController{
		
		var $components = array('RequestHandler');
		
		
		public function index(){
			ini_set('memory_limit','256M');
			set_time_limit(0);
			
			$this->setFlash('Listing Record page too slow, try to optimize it.');
			
			//$records = $this->Record->find('all');
			$records = $this->Record->find('list', array(
				'fields' => array('Record.id', 'Record.name'),
				'order' => 'Record.id ASC',
			));
			
			
			$this->set('records',$records);
			
			$this->set('title',__('List Record'));
		}
		
/*		public function getRecords(){
			//false auto render template
			$this->autoRender = false;
			
			
			$records = $this->Record->find('list', array(
							'fields' => array('Record.id', 'Record.name'),
							'limit' => 10,
							'offset'=> 10,
							'order' => 'Record.id ASC',
						));
			return json_encode(array ('records'=>$records));
		}*/
		
		
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