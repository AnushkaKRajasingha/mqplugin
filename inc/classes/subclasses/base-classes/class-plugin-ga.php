<?php
if(!class_exists('MMGoogleAnalytics')){
	class MMGoogleAnalytics{
		public $googleanalyticid ; 
		public $gacode;
		public $trackingcode1;
		public $trackingcode2;
		public $trackingcode3;
		public $trackingcode4;
		
		private $_gacode = "(function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='https://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');";
		
		public function __construct(){
			
		}
		
		public function _setGaCode($gaid){
			$this->googleanalyticid = $gaid;
			$this->gacode = str_replace('UA-XXXXX-X', $this->googleanalyticid, $this->_gacode);
			return $this->gacode;
		}
	}
}