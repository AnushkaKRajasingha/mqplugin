<?php
/**
 * @author Anushka Rajasingha
 * @url http://www.anushkar.com
 * @date 02/26/2015
 * @uses Quote Schedule Information
 *
 */
if (interface_exists('IMMPriceBase') && !class_exists('MMAvailableDates')) {
	class MMAvailableDates extends MMQuoteBase{
		use MMDbBase;

		public $availabledate;
		
		/**
		 * Scheduled date
		 * @name Scheduled Date
		 * @since 1.0.0
		 * @access public
		 * @var DateTime
		 * @category varable
		 * @param ISLevel0 string directmap
		 * @uses infusionsoft_api
		 */
		public $scheduleddate;
		
		/**
		 * Scheduled date String
		 * @name Scheduled Date String
		 * @since 1.0.0
		 * @access public
		 * @var string
		 * @category varable
		 * @param ISLevel0 string directmap
		 * @uses infusionsoft_api
		 */
		public $scheduleddatestring;
		
		public function __construct(){ 
			$this->__init();
		}
		
		public function applyData(){
			try {
				$this->scheduleddate = date('m-d-Y',strtotime($this->availabledate));
				$this->scheduleddatestring = date('m-d-Y',strtotime($this->availabledate));
				$this->description = $this->description == Null ? 'N/A' : $this->description;
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
			}
		}
		
		/* Implement MMQuoteBase abstract Members  */ 		
		public function __init(){
			try {
				$this->_setTablename('_availabledates');
				
				add_action( 'wp', array(&$this , '_automatic_dateadd_schedule') );
				add_action('dateupdate_daily_event', array(&$this , '_dateupdate_daily_event'));
				register_deactivation_hook(__FILE__, array(&$this , '_automatic_dateadd_deactivation'));
				
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
					'availabledate' => date("Y-m-d",strtotime($this->availabledate)),
					'description' => $this->description,
					'sortOrder' => $this->sortOrder,
					'isActive' => $this->isActive
			);
		}
		public function SaveAvailableDate(){
			try {
				
				$_obj = Plugin_Utilities::extractDataToOjbect($this); //var_dump($_obj); exit;
				if ($_obj == null) {
					echo json_encode(array('error'=>'Unable to extract object data'));
					exit;
				}			
				
				if (isset($_POST['data']) && isset($_POST['data']['availabledateto'])) {								
					$this->SaveDateRange($_POST['data']['availabledateto']);
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
		
		private function SaveDateRange($todate){
			try {
				global $wpdb;
				$_startDate = new DateTime($this->availabledate); 
				$_endDate = new DateTime($todate); $_endDate->add(new DateInterval( "P1D" ));
				$periodInterval = new DateInterval( "P1D" );
				$period = new DatePeriod( $_startDate, $periodInterval, $_endDate );
				
				foreach ($period as $date) {
					//echo $date->format("Y-m-d") , PHP_EOL;
					$_query = "Delete from ".$this->tablename." where availabledate = '".$date->format("Y-m-d")."' and isActive = 1";
					$affects = $this->_query($_query);
					if($affects <= 0 ) {
						$_query = "select * from ".$this->tablename." where availabledate = '".$date->format("Y-m-d")."' and isActive = 0";
						$result = $this->_getCustomResults($_query);  // var_dump(count($result) > 0);
						if(count($result) <= 0){
							$affects = 1;
						}
					}
					if($affects > 0) {
					$this->availabledate = $date->format("Y-m-d");
					$this->uniqueid = Plugin_Utilities::getUniqueKey(10);
					$this->__setDbData();
					$this->_save();
					}
				}				
				
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		
		
		
		public function GetAvailableDates(){
			try {
				$obj_array = (array) $this->Get_AvailableDates();
				echo json_encode($obj_array);
				exit;
				
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		public function Get_AvailableDates($_isActive = 0){
			try {
				if($_isActive){
					$_query = "select * from ".$this->tablename." where isActive = 1 and isDelete=0 and availabledate > NOW() order by availabledate";					
				}
				else
					$_query = "select * from ".$this->tablename." where isDelete=0 and availabledate >= NOW() order by availabledate";
				
				$__result =  $this->_getCustomResults($_query);// var_dump($__result); exit;
				$__availabledates = new ArrayIterator();
				foreach ($__result as $value) {
					$__availabledate = new MMAvailableDates();
					Plugin_Utilities::injectObjectData($value, $__availabledate);
					$__availabledates->append($__availabledate);
				}				
				return $__availabledates;
		
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		public function CopyAvailableDates(){
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
		
		public function DeleteAvailableDates(){
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
		
		/* Automatic date action hook starts */
		public function _automatic_dateadd_schedule() {
			if ( !wp_next_scheduled('dateupdate_daily_event') ) {
				wp_schedule_event( time(), 'daily', 'dateupdate_daily_event');
			}
		}
		
		public function _automatic_dateadd_deactivation(){
			wp_clear_scheduled_hook('dateupdate_daily_event');
		}
		
		
		public function _dateupdate_daily_event(){
			try {
				$__sysset = new MMSystemSettings(); $__sysset->GetSystemSetting();
				if($__sysset->dateautoupdate == 1){
					$today = date('m/d/Y');
					$todate = date('m/d/Y', strtotime("+30 days"));
					$this->availabledate = $today;
					$this->isActive = 1;
					$this->SaveDateRange($todate);	
				}			
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		/* Automatic date action hook starts */
	}
	
}