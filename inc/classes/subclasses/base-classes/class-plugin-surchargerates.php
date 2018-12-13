<?php
if (interface_exists('IMMPriceBase') && !class_exists('MMSurchargeRates')) {
	class MMSurchargeRates extends MMQuoteBase{
		use MMDbBase;		
		public $dayofweek;
		public $price;
		
		
		public function __construct(){ $this->__init();}
		
		/* Implement MMQuoteBase abstract Members  */ 		
		public function __init(){
			try {
				$this->_setTablename('_surchargerates');
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		/* Implement MMQuoteBase abstract Members  ends */
		
		 
		
		/* MMStartPricing Members */
		
		public function __setDbData(){
			$this->dbdata = array(
					'uniqueid' => $this->uniqueid,
					'dayofweek' => $this->dayofweek,
					'price' => $this->price,
					'sortOrder' => $this->sortOrder,
					'isActive' => $this->isActive
			);
		}
		public function SaveSurchargeRate(){
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
		
		
		public function GetSurchargeRates(){
			try {
				$__result =  $this->_getResults(); // var_dump($__result); exit;
				$__surchargerates = new ArrayIterator();
				foreach ($__result as $value) {
					$__surchargerate = new MMSurchargeRates();
					Plugin_Utilities::injectObjectData($value, $__surchargerate);
					$__surchargerates->append($__surchargerate);
				}
				$obj_array = (array) $__surchargerates;
				echo json_encode($obj_array);
				exit;
				
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		public function GetSurchargeRateByDate($date){
			try {
				$__dayofweek = date('l',strtotime($date)); //var_dump($__dayofweek);
				global $wpdb;
				// req#0005 by AKR 
				$_query = "select sc.dayofweek,sc.isActive, max(sc.price) price from ".$this->tablename." sc where sc.dayofweek = '".$__dayofweek."' and sc.isDelete = 0 group by sc.dayofweek,sc.isActive"; // sc.isActive = 1 and
				$__result =  $this->_getCustomResults($_query);
				if($__result == null) { return false;}
				return $__result;
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		public function CopySurchargeRates(){
			try {
				$this->_validateId();
				$obj = $this->_getItem();
				Plugin_Utilities::injectObjectData($obj, $this);
				$this->description = 'Copy of '.$this->dayofweek;				
				$this->_copy();
				exit;
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		public function DeleteSurchargeRates(){
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
		
		
		/* MMStartPricing Members */
	}
}