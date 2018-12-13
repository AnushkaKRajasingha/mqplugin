<?php
if (!class_exists('MMCards')) {
	class MMCards extends MMQuoteBase{
		use MMDbBase;
		
		public $cardNumber;
		public $expMonth;
		public $expYear;
		public $nameOnCard;
		public $cvv;
		
		public $billingAddress;
		public $billingAddress1;
		public $billingcity;
		public $billingstate;
		public $billingzipcode;
		public $billingemailAddress;
		
		public function __construct(){ $this->__init();}
		
		/* Implement MMQuoteBase abstract Members  */
		public function __init(){
			try {
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		public function __setDbData(){}
		/* Implement MMQuoteBase abstract Members  */
		
	}
}