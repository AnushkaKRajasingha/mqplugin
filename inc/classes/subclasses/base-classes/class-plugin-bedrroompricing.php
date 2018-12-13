<?php
/**
 * @author Anushka Rajasingha
 * @url http://www.anushkar.com
 * @date 02/26/2015
 * @uses Bedroom Information
 *
 */
if (class_exists('MMQuoteBase') && !class_exists('MMBedroomPricing')) {
	class MMBedroomPricing extends MMQuoteBase {
		use MMDbBase;
		/**
		 * Number of bedrooms
		 * @name Number of bedrooms
		 * @since 1.0.0
		 * @access public
		 * @var int
		 * @category varable
		 * @param ISLevel0 string directmap
		 * @uses infusionsoft_api
		 */
		public $brcount;
		/**
		 * Cost of bedrooms
		 * @name Cost of bedrooms
		 * @since 1.0.0
		 * @access public
		 * @var float
		 * @category varable
		 * @param ISLevel0 string directmap
		 * @uses infusionsoft_api
		 */
		public $price;
		
		public function __construct(){ $this->__init();}	
		
		/* Implement MMQuoteBase members */
		public function __init(){
			try {
				$this->_setTablename('_bedroomPricing');
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		public function __setDbData(){
			$this->dbdata = array(
					'uniqueid' => $this->uniqueid,
					'brcount' => $this->brcount,
					'description' => $this->brcount > 1 ? 'Bedrooms' : 'Bedroom',
					'price' => $this->price,
					'sortOrder' => $this->sortOrder,
					'isActive' => $this->isActive
			);
		}
		
		/* Implement MMQuoteBase members */
		/* MMBedRoomPricing Members */
		
		public function SaveBedroomPrice(){
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
		
		public function GetBedroomPricing(){
		try {				
				$obj_array = (array) $this->Get_BedroomPricing();
				echo json_encode($obj_array);
				exit;
				
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		public function Get_BedroomPricing($_isActive = 0){
			try {
				$__result =  $this->_getResults($_isActive);
				$__bedroomPricing = new ArrayIterator();
				foreach ($__result as $value) {
					$__bedroomprice = new MMBedroomPricing();
					Plugin_Utilities::injectObjectData($value, $__bedroomprice);
					$__bedroomPricing->append($__bedroomprice);
				}
				return $__bedroomPricing;
		
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		public function CopyBedroomPricing(){
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
		
		public function DeleteBedroomPricing(){
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
		/* MMBedRoomPricing Members */
	}
}