<?php
if (interface_exists('IMMPriceBase') && !class_exists('MMFrequencies')) {
	class MMFrequencies extends MMQuoteBase{
		use MMDbBase;
		
		public $frequency;
		public $iconImageUrl;
		public $isRecurring;
		

		
		public function __construct(){ $this->__init();}
		
		/* Implement MMQuoteBase abstract Members  */ 		
		public function __init(){
			try {
				$this->_setTablename('_frequencies');
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		/* Implement MMQuoteBase abstract Members  ends */
		
		 
		
		/* MMHomeType Members */
		
		
		public function __setDbData(){
			$this->dbdata = array(
					'uniqueid' => $this->uniqueid,
					'frequency' => $this->frequency,
					'iconImageUrl' => $this->iconImageUrl,
					'sortOrder' => $this->sortOrder,
					'isActive' => $this->isActive,
					'isRecurring' => $this->isRecurring
			);
		}
		public function SaveFrequencies(){
			try {
				
				$_obj = Plugin_Utilities::extractDataToOjbect($this); //var_dump($_obj); exit;
				if ($_obj == null) {
					echo json_encode(array('error'=>'Unable to extract object data'));
					exit;
				}			
				
				
				if (empty($this->uniqueid)) {
					$this->uniqueid = Plugin_Utilities::getUniqueKey(10);
					$this->__setDbData();
					$this->_save();
					exit;
				}
				else{
					$this->__setDbData();
					$this->_update();
					echo json_encode($this);
					exit;
				}
				
				
				
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		
		public function GetFrequencies(){
			try {
				$obj_array = $this->Get_Frequencies();
				echo json_encode($obj_array);
				exit;
				
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		public function Get_Frequencies($_isActive = 0){
			try {
				$__result =  $this->_getResults($_isActive);
				$__frequencies = new ArrayIterator();
				foreach ($__result as $value) {
					$__frequency = new MMFrequencies();
					Plugin_Utilities::injectObjectData($value, $__frequency);
					$__frequencies->append($__frequency);
				}
				$obj_array = (array) $__frequencies;
				return $obj_array;
		
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		public function CopyFrequencies(){
			try {
				$this->_validateId();
				$obj = $this->_getItem();
				Plugin_Utilities::injectObjectData($obj, $this);
				$this->frequency = 'Copy of '.$this->frequency;				
				$this->_copy();
				exit;
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		public function DelFrequencies(){
			try {
				$this->_validateId();
				$obj = $this->_getItem();
				Plugin_Utilities::injectObjectData($obj, $this);
				$this->isDelete = "1";
				$this->__setDbData();
				$this->dbdata["isDelete"] = $this->isDelete;
				$this->_update();
				echo json_encode($this);
				exit;
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		
		/* MMHomeType Members */
	}
}