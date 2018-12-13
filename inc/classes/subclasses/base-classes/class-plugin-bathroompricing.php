<?php
/**
 * @author Anushka Rajasingha
 * @url http://www.anushkar.com
 * @date 02/26/2015
 * @uses Bathroom Information
 *
 */
if (class_exists('MMQuoteBase') && !class_exists('MMBathroomPricing')) {
	class MMBathroomPricing extends MMQuoteBase {
		use MMDbBase;
		/**
		 * Number of bathrooms
		 * @name Number of bathrooms
		 * @since 1.0.0
		 * @access public
		 * @var int
		 * @category varable
		 * @param ISLevel0 string directmap
		 * @uses infusionsoft_api
		 */
		public $bathrcount;
		/**
		 * Cost of bathrooms
		 * @name Cost of bathrooms
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
				$this->_setTablename('_bathroomPricing');
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		public function __setDbData(){
			$this->dbdata = array(
					'uniqueid' => $this->uniqueid,
					'bathrcount' => $this->bathrcount,
					'description' => $this->bathrcount > 1 ? 'Bathrooms' : 'Bathroom', // $this->description,
					'price' => $this->price,
					'sortOrder' => $this->sortOrder,
					'isActive' => $this->isActive
			);
		}
		
		/* Implement MMQuoteBase members */
		/* MMBathRoomPricing Members */
		
		public function SaveBathroomPrice(){
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
		
		public function GetBathroomPricing(){
		try {
				$obj_array = (array) $this->Get_BathroomPricing();
				echo json_encode($obj_array);
				exit;
				
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		public function Get_BathroomPricing($_isActive = 0){
			try {
				$__result =  $this->_getResults($_isActive);
				$__bathroomPricing = new ArrayIterator();
				foreach ($__result as $value) {
					$__bathroomprice = new MMBathroomPricing();
					Plugin_Utilities::injectObjectData($value, $__bathroomprice);
					$__bathroomPricing->append($__bathroomprice);
				}
				return $__bathroomPricing;
		
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		public function CopyBathroomPricing(){
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
		
		public function DeleteBathroomPricing(){
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