<?php 
/**
 * @author Anushka Rajasingha
 * @url http://www.anushkar.com
 * @date 02/26/2015
 * @uses Hourly Work Details
 *
 */
if (!class_exists('MMHourlyRates')) {
	class MMHourlyRates extends MMQuoteBase{
		use MMDbBase;
		public $numberofhours;
		/**
		 * Hourly Rate
		 * @name Hourly Rate
		 * @since 1.0.0
		 * @access public
		 * @var string
		 * @category varable
		 * @param ISLevel0 string directmap
		 * @uses infusionsoft_api
		 */
		public $hourlyrate;
		public $price;
		
		/**
		 * First Time Clean Hours
		 * @name First Time Clean Hours
		 * @since 1.0.0
		 * @access public
		 * @var string
		 * @category varable
		 * @param ISLevel0 string directmap
		 * @uses infusionsoft_api
		 */
		public $FirstTimeCleanHours ;
		
		/**
		 * One Time or Move Out Clean Hours
		 * @name One Time or Move Out Clean Hours
		 * @since 1.0.0
		 * @access public
		 * @var string
		 * @category varable
		 * @param ISLevel0 string directmap
		 * @uses infusionsoft_api
		 */
		public $OneTimeMoveOutCleanHours ;
		
		public function __construct(){$this->__init();}
		
		public function applyData(){
			try {
				$this->hourlyrate = $this->hourlyrate == NULL ? (float)0 : $this->hourlyrate;
				$this->description = $this->description == NULL ? 'N/A' : $this->description;				
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
			}
		}
		
		/* Implement MMQuoteBase abstract Members  */
		public function __init(){
			try {
				//$this->_setTablename('_hourlyrates');
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
						'numberofhours' => $this->numberofhours,
						'hourlyrate' => $this->hourlyrate,
						'price' => $this->price
						);
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		/* Implement MMQuoteBase abstract Members  */
		
		public function GetTotalCost(){
			try {
				$this->price = $this->numberofhours * $this->hourlyrate;
				return $this->price;
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
	}
}
	