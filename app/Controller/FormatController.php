<?php
	class FormatController extends AppController{
		
		public function q1(){
			
			if ($this->request->is('post')) {
				$type  = $this->request->data("Type")['type'];
				if(empty($type)){
					$this->setError('Type cannot be empty, please choose one');
					$this->redirect("q1");
					
				}
				$this->redirect(array('controller' => 'Format', 'action' => 'submitted_detail', $type));
			}
			
// 			$this->set('title',__('Question: Please change Pop Up to mouse over (soft click)'));
		}
		
		public function q1_detail(){

			$this->setFlash('Question: Please change Pop Up to mouse over (soft click)');
				
			
			
// 			$this->set('title',__('Question: Please change Pop Up to mouse over (soft click)'));
		}
		
		public function submitted_detail($type=null){
			$this->setSuccess('Submitted ! Customer Choice is [ <strong>'.$type.' ]</strong>');
		}
		
	}