<?php
	
	App::uses('SimpleXLSX','Vendor');
	
	class MigrationController extends AppController{
		
		public function q1(){
			set_time_limit(3600);
			
			if ($this->request->is('post')) {
				$submittedFile = $this->request->data['FileUpload']['file'];
				$isXlsx         = $this->validateXlsx( $submittedFile );
				
				if($isXlsx) {
					try {
						$uploadPath = 'uploads/files/';
						$uploadFile = $uploadPath.$submittedFile['name'];
						if (move_uploaded_file($submittedFile['tmp_name'], $uploadFile)) {
							
							$content = SimpleXLSX::parse($uploadFile);
							
							$values = $this->rowsWithHeaderValuesAsKey($content);
							
							foreach($values as $value){
								$this->loadModel('Members');
								$this->Members->create();
								
								$this->loadModel('Transactions');
								$this->Transactions->create();
								
								$this->loadModel('TransactionItems');
								$this->TransactionItems->create();
								
								//date obj
								$year = date('Y', strtotime($value['Date']));
								$month = date('m', strtotime($value['Date']));
								
								//set member
								$member = explode(' ',$value['Member No']);
								$memberType = $member[0];
								$memberNum  = (int)$member[1];
								$this->Members->set('type',$memberType);
								$this->Members->set('no',$memberNum);
								$this->Members->set('name',$value['Member Name']);
								if(!empty($value['Member Company'])) $this->Transactions->set('company', $value['Member Company']);
								$newMember = $this->Members->save();
								
								//set transaction
								$this->Transactions->set('ref_no',$value['Ref No.']);
								$this->Transactions->set('member_id',$newMember['Members']['id']);
								$this->Transactions->set('member_name',$newMember['Members']['name']);
								$this->Transactions->set('member_paytype', $value['Member Pay Type']);
								$this->Transactions->set('date', $value['Date']);
								$this->Transactions->set('year', (int)$year);
								$this->Transactions->set('month', (int)$month);
								$this->Transactions->set('ref_no', $value['Ref No.']);
								$this->Transactions->set('receipt_no', $value['Receipt No']);
								$this->Transactions->set('payment_method',$value['Payment By']);
								if(!empty($value['Cheque No'])) $this->Transactions->set('cheque_no', $value['Cheque No']);
								if(!empty($value['Batch No'])) $this->Transactions->set('batch_no', $value['Batch No']);
								$this->Transactions->set('payment_type', $value['Payment Description']);
								$this->Transactions->set('renewal_year', $value['Renewal Year']);
								$this->Transactions->set('subtotal', $value['subtotal']);
								$this->Transactions->set('tax', $value['totaltax']);
								$this->Transactions->set('total', $value['total']);
								$newTransaction = $this->Transactions->save();
								
								//set Transactions Details
								$this->TransactionItems->set('transaction_id', $newTransaction['Transactions']['id']);
								$description = "Being Payment For : ".$value['Payment Description'] ." : ".$year;
								$this->TransactionItems->set('description',$description);
								$this->TransactionItems->set('quantity', 1);
								$this->TransactionItems->set('unit_price',$value['subtotal']);
								
								$sum = $value['subtotal'] * 1;
								$this->TransactionItems->set('sum',$sum);
								$this->TransactionItems->set('table','Member');
								$this->TransactionItems->set('table_id',$newMember['Members']['id']);
								$newTransactionDetail = $this->TransactionItems->save();
							}
							
						}
						
						$this->setSuccess('Successfully Migrate ');
						
					}catch (Exception $e){
						CakeLog::error($e);
						//$this->setError($e);
					}
				}else {
					$this->setError('Only Allow Excel File To Upload');
				}
			}
			
			$this->loadModel('Transactions');
			$all_transaction = $this->Transactions->find('all');
			$this->set(compact('all_transaction'));
		
		}
		
		public function q1_instruction(){

			$this->setFlash('Question: Migration of data to multiple DB table');
				
			
			
// 			$this->set('title',__('Question: Please change Pop Up to mouse over (soft click)'));
		}
		
		
		private function validateXlsx ($file)
		{
			$csv_mime_types = ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel'];
			$type = $file['type'];
			return (in_array($file['type'],$csv_mime_types)) ? true: false;
		}
		
		private function rowsWithHeaderValuesAsKey ($data)
		{
			$header_values = $rows = [];
			foreach ( $data->rows() as $k => $r ) {
				if ( $k === 0 ) {
					$header_values = $r;
					continue;
				}
				$rows[] = array_combine( $header_values, $r );
			}
			return $rows;
		}
		
	}