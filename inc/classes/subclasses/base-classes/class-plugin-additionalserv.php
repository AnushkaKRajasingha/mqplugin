<?php
if (interface_exists('IMMPriceBase') && !class_exists('MMAdditionalServs')) {
	class MMAdditionalServs extends MMQuoteBase{
		use MMDbBase;		
		public $frequency;
		public $iconImageUrl;
		public $price;
		
		public $frequencytext;
		public $frequencyisRecurring;
		
		public function __construct(){ $this->__init();}
		
		/* Implement MMQuoteBase abstract Members  */ 		
		public function __init(){
			try {
				$this->_setTablename('_additionalserv');
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
					'frequency' => $this->frequency,
					'description' => $this->description,
					'iconImageUrl' => $this->iconImageUrl,
					'price' => $this->price,
					'sortOrder' => $this->sortOrder,
					'isActive' => $this->isActive
			);
		}
		public function SaveAdditionalServ(){
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
		
		
		public function GetAdditionalServs(){
			try {
				$obj_array = (array) $this->Get_AdditionalServs();
				echo json_encode($obj_array);
				exit;
				
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		public function Get_AdditionalServs($_isActive = 0 ){
			try {
				global $wpdb;
				$_isActive = $_isActive == 1 ? ' ads.isActive = 1 and ': '';
				$query = "select ads.*,IFNULL(fr.frequency,'All') frequencytext,IFNULL(fr.isRecurring,2) frequencyisRecurring from {$this->tablename} ads left join ".$wpdb->prefix .self::$current_plugin_data['TextDomain']."_frequencies fr on ads.frequency = fr.uniqueid 
where {$_isActive} ads.isDelete = 0 order by ads.sortOrder";
				$__result =  $this->_getCustomResults($query); // var_dump($__result); exit;
				$__additionalservs = new ArrayIterator();
				foreach ($__result as $value) {
					$__additionalserv = new MMAdditionalServs();
					Plugin_Utilities::injectObjectData($value, $__additionalserv);
					$__additionalservs->append($__additionalserv);
				}
				return $__additionalservs;
		
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		public function CopyAdditionalServs(){
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
		
		public function DeleteAdditionalServs(){
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