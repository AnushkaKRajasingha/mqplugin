<?php
if (interface_exists('IMMPriceBase') && !class_exists('MMHomeTypes')) {
	class MMHomeTypes extends MMQuoteBase{
		use MMDbBase;
		
		public $hometype;
		public $iconImageUrl;
		

		
		public function __construct(){ $this->__init();}
		
		/* Implement MMQuoteBase abstract Members  */ 		
		public function __init(){
			try {
				$this->_setTablename('_hometypes');
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
					'hometype' => $this->hometype,
					'iconImageUrl' => $this->iconImageUrl,
					'sortOrder' => $this->sortOrder,
					'isActive' => $this->isActive
			);
		}
		public function SaveHomeTypee(){
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
		
		
		public function GetHomeType(){
			try {
				
				$obj_array = $this->GetHomeTypes();
				echo json_encode($obj_array);
				exit;
				
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		public function GetHomeTypes($_isActive = 0){
			try {
				$__result =  $this->_getResults($_isActive);
				$__hometypes = new ArrayIterator();
				foreach ($__result as $value) {
					$__hometype = new MMHomeTypes();
					Plugin_Utilities::injectObjectData($value, $__hometype);
					$__hometypes->append($__hometype);
				}
				$obj_array = (array) $__hometypes;
				return $obj_array;
		
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		public function CopyHomeType(){
			try {
				$this->_validateId();
				$obj = $this->_getItem();
				Plugin_Utilities::injectObjectData($obj, $this);
				$this->hometype = 'Copy of '.$this->hometype;				
				$this->_copy();
				exit;
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		public function DelHomeTypepe(){
			try {
				//var_dump($_POST['data']);
				$validate = $this->_validateId();				
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