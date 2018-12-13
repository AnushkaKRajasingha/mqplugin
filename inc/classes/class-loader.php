<?php
class Loader{
	public function __construct(){}
	public function classloader(){
		if (is_admin()) {

			$classes = array( 
					'ErrorLogger' => WPQP_CLS_DIR.'/subclasses/class-plugin-errorlogger.php',
					'Plugin_Utilities' 	=> WPQP_CLS_DIR.'/subclasses/class-plugin-utilities.php',
					'Plugin_Settings' =>  WPQP_CLS_DIR.'/subclasses/class-plugin-settings.php',
					'Plugin_lisense' =>  WPQP_CLS_DIR.'/subclasses/class-plugin-licensing.php',
					'Plugin_Header' => WPQP_CLS_DIR.'/subclasses/class-plugin-wpheader.php',					
					'Add_Hooks' 		 => WPQP_CLS_DIR.'/subclasses/class-add-hooks.php',
					'MMEDD_SL_Plugin_Updater' 	=> WPQP_CLS_DIR.'/subclasses/class-plugin-updater.php',
					'Plugin_Menu' 		 => WPQP_CLS_DIR.'/subclasses/class-plugin-menu.php',
					'Plugin_Scripts' 	=> WPQP_CLS_DIR.'/subclasses/class-plugin-script.php',
					'Plugin_Functions' 	=> WPQP_CLS_DIR.'/subclasses/class-plugin-functions.php',					
					'Plugin_page' 	=> WPQP_CLS_DIR.'/subclasses/class-plugin-pages.php',
					/* Plugin Active classes */ 	
					'MMDbBase' => WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-dbbase.php',
					'IMMStatusBase'	=> 	WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-statusbase.php',					
					'IMMPriceBase' => 	WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-pricebase.php',
					'MMQuoteBase' => 	WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-quotebase.php',
					'MMGoogleAnalytics' 	=> WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-ga.php',
					'MMSystemSettings' 	=> WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-syssettings.php',
					'MMGRProxy' 	=> WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-gr-proxy.php',
					'MMStripeProxy' => WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-stripe-proxy.php',
					'MMInfusionsoftProxy' => WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-infusionsoft-proxy.php',
					'MMHomeTypes' 	=> WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-hometypes.php',
					'MMFrequencies' 	=> WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-frequencies.php',
					'MMStartPricing' 	=> WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-startpricing.php',
					'MMBedroomPricing' 	=> WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-bedrroompricing.php',
					'MMBathroomPricing' 	=> WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-bathroompricing.php',
					'MMFrequencyPricing' 	=> WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-frequencypricing.php',
					'MMPetPricing' 	=> WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-petpricing.php',
					'MMSqFootagePricing' 	=> WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-sqfootagepricing.php',
					'MMServAreaPricing' 	=> WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-servareapricing.php',
					'MMAvailableDates' 	=> WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-availabledates.php',
					'MMSurchargeRates' 	=> WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-surchargerates.php',
					'MMAdditionalServs' 	=> WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-additionalserv.php',
					'MMAMarketing' 	=> WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-marketing.php',
					'MMContacts' => WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-contacts.php',
					'MMFirstTimePricing' => WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-firsttimepricing.php',
					'MMHourlyRates' => WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-hourlyrates.php',
					'MMCards' => WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-cards.php',
					'MMPayments' => WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-payment.php',
					'Encriptor' => WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-cryptor.php',
					'MMQuotes' 	=> WPQP_CLS_DIR.'/subclasses/class-plugin-quote.php',
					'Plugin_ShortCodes' 	=> WPQP_CLS_DIR.'/subclasses/class-plugin-shortcodes.php',
			);
			$this->register_classes( $classes );
		}elseif (!is_admin()){
			$classes = array(
					'ErrorLogger' => WPQP_CLS_DIR.'/subclasses/class-plugin-errorlogger.php',					
					'Plugin_Utilities' 	=> WPQP_CLS_DIR.'/subclasses/class-plugin-utilities.php',
					'Plugin_Settings' =>  WPQP_CLS_DIR.'/subclasses/class-plugin-settings.php',
					'Plugin_lisense' =>  WPQP_CLS_DIR.'/subclasses/class-plugin-licensing.php',
					'Plugin_Header' => WPQP_CLS_DIR.'/subclasses/class-plugin-wpheader.php',											
					'Add_Hooks' 		 => WPQP_CLS_DIR.'/subclasses/class-add-hooks.php',
					'Plugin_Scripts' 	=> WPQP_CLS_DIR.'/subclasses/class-plugin-script.php',
					'Plugin_Functions' 	=> WPQP_CLS_DIR.'/subclasses/class-plugin-functions.php',
					'MMDbBase' => WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-dbbase.php',
					'IMMStatusBase'	=> 	WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-statusbase.php',
					'IMMPriceBase' => 	WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-pricebase.php',
					'MMQuoteBase' => 	WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-quotebase.php',
					'MMGoogleAnalytics' 	=> WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-ga.php',
					'MMSystemSettings' 	=> WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-syssettings.php',
					'MMGRProxy' 	=> WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-gr-proxy.php',
					'MMStripeProxy' => WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-stripe-proxy.php',
					'MMInfusionsoftProxy' => WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-infusionsoft-proxy.php',
					'MMHomeTypes' 	=> WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-hometypes.php',
					'MMFrequencies' 	=> WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-frequencies.php',
					'MMStartPricing' 	=> WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-startpricing.php',
					'MMBedroomPricing' 	=> WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-bedrroompricing.php',
					'MMBathroomPricing' 	=> WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-bathroompricing.php',
					'MMFrequencyPricing' 	=> WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-frequencypricing.php',
					'MMPetPricing' 	=> WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-petpricing.php',
					'MMSqFootagePricing' 	=> WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-sqfootagepricing.php',
					'MMServAreaPricing' 	=> WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-servareapricing.php',
					'MMAvailableDates' 	=> WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-availabledates.php',
					'MMSurchargeRates' 	=> WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-surchargerates.php',
					'MMAdditionalServs' 	=> WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-additionalserv.php',
					'MMAMarketing' 	=> WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-marketing.php',
					'MMFirstTimePricing' => WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-firsttimepricing.php',
					'MMHourlyRates' => WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-hourlyrates.php',
					'MMContacts' => WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-contacts.php',
					'MMCards' => WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-cards.php',
					'MMPayments' => WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-payment.php',
					'Encriptor' => WPQP_CLS_DIR.'/subclasses/base-classes/class-plugin-cryptor.php',
					'MMQuotes' 	=> WPQP_CLS_DIR.'/subclasses/class-plugin-quote.php',
					'Plugin_ShortCodes' 	=> WPQP_CLS_DIR.'/subclasses/class-plugin-shortcodes.php',
			);
			$this->register_classes( $classes );
		}else{
			
		}
	}
}