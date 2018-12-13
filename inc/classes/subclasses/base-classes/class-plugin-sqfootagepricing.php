<?php
/**
 * @author Anushka Rajasingha
 * @url http://www.anushkar.com
 * @date 02/26/2015
 * @uses Square Footage Informations
 *
 */
if (interface_exists('IMMPriceBase') && !class_exists('MMSqFootagePricing')) {
	class MMSqFootagePricing extends MMQuoteBase{
		use MMDbBase;
		
		public $hometype;
		public $frequency;
		/**
		 * Cost for squarefootage
		 * @name Cost for Squarefootage
		 * @since 1.0.0
		 * @access public
		 * @var string
		 * @category varable
		 * @param ISLevel0 string directmap
		 * @uses infusionsoft_api
		 */
		public $price;
		
		public $hometypetext;
		public $frequencytext;
		
		/**
		 * Approximate squarefootage
		 * @name Approximate Squarefootage
		 * @since 1.0.0
		 * @access public
		 * @var string
		 * @category varable
		 * @param ISLevel0 string directmap
		 * @uses infusionsoft_api
		 */
		public $Approximatesquarefootage;
		

		
		public function __construct(){ $this->__init();}
		
		public function applyData(){
			try {
				if($this->uniqueid == null){
					$this->Approximatesquarefootage = '0 sqft';
				}else
					$this->Approximatesquarefootage = $this->description;
				
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
			}
		}
		
		/* Implement MMQuoteBase abstract Members  */ 		
		public function __init(){
			try {
				$this->_setTablename('_sqfootagePricing');
				$this->Approximatesquarefootage = '0 sqft';
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
					'description' => $this->description,
					'price' => $this->price,
					'sortOrder' => $this->sortOrder,
					'isActive' => $this->isActive
			);
		}
		public function SaveSqFootagePrice(){
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
					/*global $wpdb;
					printf($wpdb->last_query);*/
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
		
		
		public function GetSqFootagePricing(){
			try {
				$obj_array = (array) $this->Get_SqFootagePricing();
				echo json_encode($obj_array);
				exit;
				
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		public function GetSqFPByHomeTypeNFrq(){
			try {
				$obj_array = (array) $this->Get_SqFtgPricingByHomeTypeNFrq();
				echo json_encode($obj_array);
				exit;
		
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		public function GetSqFPByFrq(){
			try {
				$obj_array = (array) $this->Get_SqFtgPricingByFrq();
				echo json_encode($obj_array);
				exit;
		
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		/*public function Get_SqFootagePricing(){
			try {
				global $wpdb;
				$query = "select sf.*,ht.hometype hometypetext from  {$this->tablename} sf , ".$wpdb->prefix .self::$current_plugin_data['TextDomain']."_hometypes ht
where sf.hometype = ht.uniqueid and sf.isDelete = 0
order by sf.sortOrder";
				$__result =  $this->_getCustomResults($query);
				$__sqfootagePricing = new ArrayIterator();
				foreach ($__result as $value) {
					$__sqfprice = new MMSqFootagePricing();
					Plugin_Utilities::injectObjectData($value, $__sqfprice);
					$__sqfootagePricing->append($__sqfprice);
				}
				return $__sqfootagePricing;
		
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}*/
		
		public function Get_SqFootagePricing(){
			try {
				global $wpdb;
				$query = "select sf.*,fr.frequency frequencytext from  {$this->tablename} sf , ".$wpdb->prefix .self::$current_plugin_data['TextDomain']."_frequencies fr
where sf.frequency = fr.uniqueid and sf.isDelete = 0
order by sf.sortOrder";
				$__result =  $this->_getCustomResults($query);
				$__sqfootagePricing = new ArrayIterator();
				foreach ($__result as $value) {
					$__sqfprice = new MMSqFootagePricing();
					Plugin_Utilities::injectObjectData($value, $__sqfprice);
					$__sqfootagePricing->append($__sqfprice);
				}
				return $__sqfootagePricing;
		
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		public function Get_SqFtgPricingByHomeTypeNFrq(){
			try {
				if(isset($_POST['hometype']) ){ //&& isset($_POST['frequency']) ){
				global $wpdb;
				$_query = "select * from ".$this->tablename." sf where sf.hometype = '".$_POST['hometype']."'  and sf.isActive = 1 and sf.isDelete = '0'";
				$__result =  $this->_getCustomResults($_query);
				$__sqfootagePricing = new ArrayIterator();
				foreach ($__result as $value) {
					$__sqfprice = new MMSqFootagePricing();
					Plugin_Utilities::injectObjectData($value, $__sqfprice);
					$__sqfootagePricing->append($__sqfprice);
				}
				return $__sqfootagePricing;
				}
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		public function Get_SqFtgPricingByFrq(){
			try {
				if(isset($_POST['frequency']) ){
					global $wpdb;
					$_query = "select * from ".$this->tablename." sf where sf.frequency = '".$_POST['frequency']."'  and sf.isActive = 1 and sf.isDelete = '0'";
					$__result =  $this->_getCustomResults($_query);
					$__sqfootagePricing = new ArrayIterator();
					foreach ($__result as $value) {
						$__sqfprice = new MMSqFootagePricing();
						Plugin_Utilities::injectObjectData($value, $__sqfprice);
						$__sqfootagePricing->append($__sqfprice);
					}
					return $__sqfootagePricing;
				}
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		
		public function CopySqFootagePricing(){
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
		
		public function DeleteSqFootagePricing(){
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
		public function getOnetimePrice($onetimesp){
			try {				
					$_query = "select * from ".$this->tablename." sf where sf.frequency = '".$onetimesp->frequency."' and sf.description = '".$this->description."' and sf.isActive = 1 and sf.isDelete = '0'";
					$__result =  $this->_getCustomResults($_query);
					if(count($__result) <= 0) return 0 ;
					$__sqfprice = new MMSqFootagePricing();
					Plugin_Utilities::injectObjectData($__result[0], $__sqfprice);
					return $__sqfprice->price;
				exit;
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		public function isAllValueSet($recurr_arry,$onetime_arry){
			try {
				global $wpdb;
				$recurr_arry_str = "'".implode("','", $recurr_arry)."'";
				$query = "select * from (";
				foreach ($onetime_arry as $value) {
					$query .= "select t1.description, t1.frequency recurrcltype ,t2.frequency onetimecltype from (
select frequency , description 
from ".$wpdb->prefix .self::$current_plugin_data['TextDomain']."_sqfootagePricing 
where isActive = 1 and isDelete = 0 and frequency in (select distinct frequency from ".$wpdb->prefix .self::$current_plugin_data['TextDomain']."_startPricing where uniqueid in (".$recurr_arry_str."))
)t1
left join (
select frequency , description 
from ".$wpdb->prefix .self::$current_plugin_data['TextDomain']."_sqfootagePricing 
where  isActive = 1 and isDelete = 0 and frequency in (select distinct frequency from ".$wpdb->prefix .self::$current_plugin_data['TextDomain']."_startPricing where uniqueid in ('".$value."'))
)t2
on t1.description = t2.description union ";
				}
			$query = preg_replace('/union $/', ' ', $query);//	rtrim($query,'union ');
				$query .= " )t7 where t7.onetimecltype is null ";
				//printf($query);
				$_result = $this->_getCustomResults($query);
				if(count($_result) > 0){
					?>
					<div class="col-xs-12">
								<h3>Unable to genarate Quote Wizard.</h3>
								<p>You must setup one-time cleaning square foot price(s). for these square foot value(s) <br>
								<?php 
									foreach ($_result as $key => $value) {										
										echo $value['description'].'</br>';										
									}
								?>	
								</p>							
								</div>
								<?php 
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