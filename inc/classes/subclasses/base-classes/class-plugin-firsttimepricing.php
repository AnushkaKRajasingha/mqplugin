<?php
if (!class_exists('MMFirstTimePricing')) {
	class MMFirstTimePricing extends MMQuoteBase{
		use MMDbBase;
		public $priceoption;
		public $prices;
		
		public function __construct(){$this->__init();}
		
		/* Implement MMQuoteBase Members */
		public function __init(){
			try {
				$this->_setTablename('_firsttimepricing');
				$this->prices = [];
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		} 
		
		public function __setDbData(){
			try {
				$this->dbdata = array(
						'uniqueid' => $this->uniqueid,
						'priceoption' => $this->priceoption,
						'prices' => maybe_serialize($this->prices)
				);
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		/* Implement Ends MMQuoteBase Members */
		
		/* MMFirstTimePricing Member Starts */
		public function SaveFirstTimePrices(){
			try {
			
				$_obj = Plugin_Utilities::extractDataToOjbect($this); //var_dump($_obj); exit;
				if ($_obj == null) {
					echo json_encode(array('error'=>'Unable to extract object data'));
					exit;
				}
			
			
				if (empty($this->uniqueid)) {
					$this->_deleteAll();
					$this->uniqueid = Plugin_Utilities::getUniqueKey(10);
					//var_dump($this);
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
		
		public function GetFirstTimePrice(){
			try {
				$__result =  $this->_getRow();
				if($__result == null){
					//echo json_encode(array('error'=>'Unable to extract object data'));
					//exit;
					return null;
				}
				Plugin_Utilities::injectObjectData($__result, $this);
				$this->prices = unserialize($__result['prices']);
				//var_dump($this);
				return $this;
				//echo json_encode($this);
				//exit;
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		public function IsAllOptionSet(){
			try {
				$_showquote = true;
				$this->GetFirstTimePrice();
				if($this->priceoption == -1 ){
					$recurr_arry = []; $onetime_arry = [];
					foreach ($this->prices as $key => $value) {
						if($value == -1) {$_showquote = false; break;}
						else{ 
							$recurr_arry[] = $key; $onetime_arry[] = $value;
							//var_dump(array('recurring start price'=>$key,'one-time start price' => $value));
							/*
							$_startPricing = new MMStartPricing();
							$_startPricing->uniqueid = $value;
							$_startPricing->_getItem();
							$sqfPrice = new MMSqFootagePricing();
							$oneTimeSqfPrice = $sqfPrice->getOnetimePrice($_startPricing);
							var_dump(array('recurring start price'=>$key,'one-time start price' => $value,'one time sqfPrice' => $oneTimeSqfPrice));
							*/
						}
					}
					if($_showquote){
						$sqf = new MMSqFootagePricing();
						$sqf->isAllValueSet($recurr_arry, $onetime_arry);
					}
				}
				return $_showquote;
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		/* MMFirstTimePricing Member Ends */
	}
}
	