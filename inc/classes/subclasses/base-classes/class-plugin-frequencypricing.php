<?php
if (class_exists('MMQuoteBase') && !class_exists('MMFrequencyPricing')) {
	class MMFrequencyPricing extends MMQuoteBase {
		use MMDbBase;
		
		public $price;
		
		public function __construct(){ $this->__init();}	
		
		/* Implement MMQuoteBase members */
		public function __init(){
			try {
				$this->_setTablename('_frqPricing');
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		public function __setDbData(){
			$this->dbdata = array(
					'uniqueid' => $this->uniqueid,
					'description' => $this->description,
					'price' => $this->price,
					'sortOrder' => $this->sortOrder,
					'isActive' => $this->isActive
			);
		}
		
		/* Implement MMQuoteBase members */
		/* MMBathRoomPricing Members */
		
		public function SaveFrqPrice(){
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
		
		public function GetFrqPricing(){
		try {
				
				$obj_array = (array)$this->Get_FrqPricing();
				echo json_encode($obj_array);
				exit;
				
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		public function Get_FrqPricing($_isActive = 0){
			try {
				$__result =  $this->_getResults($_isActive);
				$__frequencypricing = new ArrayIterator();
				foreach ($__result as $value) {
					$__frequencyprice = new MMFrequencyPricing();
					Plugin_Utilities::injectObjectData($value, $__frequencyprice);
					$__frequencypricing->append($__frequencyprice);
				}
				return $__frequencypricing;
		
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		public function CopyFrqPricing(){
			try {
				$this->_validateId();
				$obj = $this->_getItem();
				Plugin_Utilities::injectObjectData($obj, $this);
				$this->description = 'Copy of '.$this->description;
				$this->_copy();
				exit;
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		public function DeleteFrqPricing(){
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
		/* MMBathRoomPricing Members */
	}
}