<?php
if (interface_exists('IMMPriceBase') && !class_exists('MMStartPricing')) {
	class MMStartPricing extends MMQuoteBase{
		use MMDbBase;
		
		public $hometype;
		public $frequency;		
		public $price;
		
		public $hometypetext;
		public $frequencytext;
		public $isRecurring;
		

		
		public function __construct(){ $this->__init();}
		
		/* Implement MMQuoteBase abstract Members  */ 		
		public function __init(){
			try {
				$this->_setTablename('_startPricing');
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
					'hometype' => $this->hometype,
					'frequency' => $this->frequency,
					'price' => $this->price,
					'sortOrder' => $this->sortOrder,
					'isActive' => $this->isActive
			);
		}
		public function SaveStartPrice(){
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
		
		public function _GetStartPricing($_isActive = 0){
			try {
				$_isActive = $_isActive == 1 ? ' sp.isActive = 1 and ': '';				
				global $wpdb;
				$query = "select  sp.id,sp.uniqueid,ht.hometype hometypetext,fr.frequency frequencytext,sp.description,sp.price,sp.sortOrder,sp.copyof,sp.isActive,sp.isDelete,sp.createdate,sp.hometype,sp.frequency ,fr.isRecurring
				from {$this->tablename} sp , {$wpdb->prefix}".self::$current_plugin_data['TextDomain']."_hometypes ht, {$wpdb->prefix}".self::$current_plugin_data['TextDomain']."_frequencies fr
where {$_isActive} sp.hometype = ht.uniqueid and sp.frequency = fr.uniqueid and sp.isDelete = 0  order by sp.sortOrder";
				$__result =  $this->_getCustomResults($query) ;
				$__startPricing = new ArrayIterator();
				foreach ($__result as $value) {
				$__startprice = new MMStartPricing();
				Plugin_Utilities::injectObjectData($value, $__startprice);
				$__startPricing->append($__startprice);
				}
				return $__startPricing;
			
			} catch (Exception $e) {
			$errorlogger = new ErrorLogger();
			$errorlogger->add_message($e->getMessage());
			exit;
			}
		}
		
		public function _GetStartPricingForFirsttime($_isActive = 0,$_hometype = null){
			try {
				$_isActive = $_isActive == 1 ? ' sp.isActive = 1 and ': '';
				global $wpdb;
				$query = "select  sp.id,sp.uniqueid,ht.hometype hometypetext,fr.frequency frequencytext,sp.description,sp.price,sp.sortOrder,sp.copyof,sp.isActive,sp.isDelete,sp.createdate,sp.hometype,sp.frequency ,fr.isRecurring
				from {$this->tablename} sp , {$wpdb->prefix}".self::$current_plugin_data['TextDomain']."_hometypes ht, {$wpdb->prefix}".self::$current_plugin_data['TextDomain']."_frequencies fr
				where ht.uniqueid = '{$_hometype}' and {$_isActive} sp.hometype = ht.uniqueid and sp.frequency = fr.uniqueid and sp.isDelete = 0 and fr.isRecurring = 0  order by sp.sortOrder";
				$__result =  $this->_getCustomResults($query) ;
				$__startPricing = new ArrayIterator();
				foreach ($__result as $value) {
					$__startprice = new MMStartPricing();
					Plugin_Utilities::injectObjectData($value, $__startprice);
					$__startPricing->append($__startprice);
				}
				return $__startPricing;
					
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		
		public function GetStartPricing(){
			try {
				$obj_array = (array) $this->_GetStartPricing();
				echo json_encode($obj_array);
				exit;
				
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		public function _getStartPrice(){
			try {
				$this->_validateId();
				$obj = $this->_getItem();
				Plugin_Utilities::injectObjectData($obj, $this);
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		public function CopyStartPricing(){
			try {
				$this->_validateId();
				$obj = $this->_getItem();
				Plugin_Utilities::injectObjectData($obj, $this);
				//$this->hometype = 'Copy of '.$this->hometype;				
				$this->_copy();
				exit;
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		public function DeleteStartPricing(){
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
		
		public function GetHousTypes($_isActive = 0){
			try {
				$_isActive = $_isActive == 1 ? ' sp.isActive = 1 and ': '';
				global $wpdb;
				$query = "select sp.hometype,ht.hometype hometypetext,ht.iconImageUrl,min(sp.price) price from ".$this->tablename." sp, ".$wpdb->prefix .self::$current_plugin_data['TextDomain']."_hometypes ht where {$_isActive} sp.isDelete = 0 and sp.hometype = ht.uniqueid group by sp.hometype,hometypetext,ht.iconImageUrl order by ht.sortOrder";
				
				$__result =  $this->_getCustomResults($query); //"select distinct hometype from ".$this->tablename." where isDelete=0");
				//$__result =  $this->_getCustomResults("select distinct hometype from ".$this->tablename." where isDelete=0");
				//$_hometypes = array_map(function ($ar) {return array($ar['hometype'] => $ar['iconImageUrl']);}, $__result); 
				//var_dump($_hometypes);
				//$_hometype_distinct = array_unique($_hometypes);
				return $__result;
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		public function GetCleaningTypes($_isActive = 0){
			try {
				$_isActive = $_isActive == 1 ? ' sp.isActive = 1 and ': '';
				global $wpdb;
				$query = "select sp.frequency,fr.frequency frequencytext,fr.iconImageUrl,min(sp.price) price from ".$this->tablename." sp, ".$wpdb->prefix .self::$current_plugin_data['TextDomain']."_frequencies fr where {$_isActive} sp.isDelete = 0 and sp.frequency = fr.uniqueid group by sp.frequency,frequencytext,fr.iconImageUrl order by sp.sortOrder";
				$__result =  $this->_getCustomResults($query); //"select distinct hometype from ".$this->tablename." where isDelete=0");
				return $__result;
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		

		 /**
		 * Ajax Function to get Type of cleanig
		 * @since 1.0.0
		 * @access public
		 * @return JSON
		 * @var Ajax
		 * @category AjaxFunction
		 */
		public function GetStartPricingFrequency(){
			try {
				if (isset($_POST['hometype'])) {
				global $wpdb;
				$query = "select sp.uniqueid, sp.frequency,fq.frequency frequencytext,fq.iconImageUrl,fq.isRecurring, sp.price from  ".$this->tablename." sp,".$wpdb->prefix .self::$current_plugin_data['TextDomain']."_frequencies fq where sp.isActive = 1 and sp.hometype='".$_POST['hometype']."' and sp.isDelete=0 and sp.frequency = fq.uniqueid group by sp.frequency order by fq.sortOrder";
				// Changed the sort order by type of cleaning as a fix for the issue #44
				// you will need to set the sort order of Starting Price tab in Pricing setting section  
				//$__result = $wpdb->get_results("select sp.frequency,sp.price from ".$this->tablename." sp where sp.hometype='".$_POST['hometype']."' and sp.isDelete=0 group by sp.frequency ",ARRAY_A);
				$__result = $wpdb->get_results($query,ARRAY_A);
				echo json_encode($__result);
				exit;
				}
				else{
					echo json_encode(array('error'=>'Invalid Home Type'));
					exit;
				}
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		/* MMStartPricing Members */
	}
}