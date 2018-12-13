<?php
if (!class_exists('MMPayments')) {
	class MMPayments extends MMQuoteBase{
		use MMDbBase;
		
		public $isAuthorized;
		public $isPaid;
		public $paymetDate;
		public $amount;
		public $currency;
		public $card;
		public $quoteid;
		
		public function __construct(){ 
			$this->card = new MMCards();
			$this->__init();
		}	
		
		
		/* Implement MMQuoteBase abstract Members  */
		public function __init(){
			try {
				$this->_setTablename('payments');
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
						'paymetDate' => $this->paymetDate,
						'amount' => $this->amount,
						'currency' => $this->currency,
						'card' => maybe_serialize($this->card),
						'isPaid' => $this->isPaid,
						'isAuthorized' => $this->isAuthorized
				);
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		/* Implement MMQuoteBase abstract Members  */
		
		
		public function MakePayment($quoteid = null){
			try {
				$_stripeApiProxy = new MMStripeProxy();
				$result =  $_stripeApiProxy->AuthorizePayment($this,$quoteid);
				if($result){
					$this->isAuthorized = true;
					$this->isPaid = true;
					$_cryptor = new Encriptor();
					$this->card->cardNumber = $_cryptor->encrypt($this->card->cardNumber);
				}
				return $result;
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		public function _revealcc(){
			try {
				$_cryptor = new Encriptor();
				$this->card->cardNumber = $_cryptor->decrypt($this->card->cardNumber);
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		/* MMStripe member starts here */
		
	}
}