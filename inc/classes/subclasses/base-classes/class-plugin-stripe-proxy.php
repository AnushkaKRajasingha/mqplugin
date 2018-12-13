<?php

global $stripe_options;
// load the stripe libraries
if ( !class_exists( 'Stripe' ) )
	require_once WPQP_CLS_DIR . '/subclasses/stripe-lib/init.php';

if (!class_exists('MMStripeProxy')) {	
	class MMStripeProxy extends MMQuoteBase{
		use MMDbBase;
		
		public $_apiKey; 
		public $_secret;
		public $_allowtocharge;
		public function __construct(){ $this->__init();}
		
		/* Implement MMQuoteBase abstract Members  */
		public function __init(){
			try {
					$_sysSet = new MMSystemSettings();
					$_sysSet->GetSystemSetting();
					$this->_apiKey = $_sysSet->stripeapitype === '1' ? $_sysSet->apistripekey : $_sysSet->apistripetestkey;
					$this->_secret =  $_sysSet->stripeapitype === '1' ? $_sysSet->apistripevalue : $_sysSet->apistripetestvalue;
					$this->_allowtocharge = $_sysSet->stripeapicharge === '1' ? true : false;
					Stripe\Stripe::setApiKey($this->_apiKey );
					//echo 'safly passed __init';
			} catch (Exception $e) {
					$errorlogger = new ErrorLogger();
					$errorlogger->add_message($e->getMessage());
					exit;
			}
		}
		public function __setDbData(){}
		/* Implement MMQuoteBase abstract Members  */
		
		/* MMStripe member starts here */
		public function AuthorizePayment($payment = null,$quoteid = null){
			try {
				/*if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == 'off') {
					echo json_encode(array('error'=>'Please enable SSl/TSL on your web site to accept payments'));
					exit;
				}*/
				
				
				if($payment != null){
					try {
					$option = array('api_key' => $this->_secret );
					$__payment = new MMPayments();
					$__payment = $payment;
					
					
					$_customer_param = array(
							'email' => $__payment->card->billingemailAddress,
							'description' => $__payment->card->nameOnCard.' - Customer of quote with ref no. '.$quoteid
					);
					
					$customer = Stripe\Customer::create($_customer_param,$this->_secret);
				
					$customer->save();
					
					$card = array(
							'number' => $__payment->card->cardNumber,
							'exp_month' => $__payment->card->expMonth,
							'exp_year' => $__payment->card->expYear,
							'cvc' => $__payment->card->cvv,
							'address_city' => $__payment->card->billingcity,
							'address_line1' => $__payment->card->billingAddress,
							'address_line2' => $__payment->card->billingAddress1,
							'address_state' => $__payment->card->billingstate,
							'address_zip' => $__payment->card->billingzipcode,
							'name' => $__payment->card->nameOnCard
					);
					
					
					try{
							$cardtoken = Stripe\Token::create(array('card'=>$card),$this->_secret);
							$createdcustomer = Stripe\Customer::retrieve($customer->id,$this->_secret);
							$createdCard = $customer->sources->create(array("card" => $cardtoken->id));
							if($this->_allowtocharge){
							 $charge = array(
									'amount' => $__payment->amount * 100,
									'currency' => $__payment->currency,
									'customer' => $customer->id,
									'receipt_email' => $__payment->card->billingemailAddress
							);					
							$charge = Stripe\Charge::create($charge,$option);					
							return array('charge_id' => $charge->id,'customer_id' => $customer->id); 
							}
							return array('customer_id' => $customer->id);
					} catch (Stripe\Error\Card $ecus) {
						$customer->delete();
						$errorlogger = new ErrorLogger();
						$errorlogger->add_message('HttpStatus - '.$ecus->getHttpStatus());
						$actual = $ecus->getJsonBody();
						$errorlogger->add_message($actual['error']['message']);
						return array('error' => $actual['error']['message']);
					}
					
					} catch (Stripe\Error\Card $e) {
						
						$errorlogger = new ErrorLogger();
						$errorlogger->add_message('HttpStatus - '.$e->getHttpStatus());
						$actual = $e->getJsonBody();						
						$errorlogger->add_message($actual['error']['message']);		
						return array('error' => $actual['error']['message']);						
					}
					return false;
				}
			} catch (Exception $e) {
				$errorlogger = new ErrorLogger();
				$errorlogger->add_message($e->getMessage());
				exit;
			}
		}
		
		/* MMStripe member ends here */
	}
}
	