<?php
class Plugin_ShortCodes extends Plugin_Core {
	public function __construct() {
		
	}
	
	public function _getVideoPlayer($attr){
		if(isset($attr['vid'])){
			$video = new Plugin_video();
			$video->uniqueid = $attr['vid'];
			$video->_getVideoPreview();
		}
	}
	
	
	public function _getQuotePage($attr){
		$_pluginscript = new Plugin_Scripts();	
		$_pluginscript->_bootstrap();
		$_pluginscript->_fontAwsome();
		$_pluginscript->_stepsmaster(1);
		//$_pluginscript->_iChekMaster();		
		$version = self::$current_plugin_data['Version'];
		wp_enqueue_style( 'mymaidquote-style',WPQP_PLUGIN_PGDIR_URL.'/css/style_frontQuotePageView.css',array(),$version);
		wp_enqueue_style( 'mymaidquote-customstyle',admin_url( 'admin-ajax.php' ).'?action='.self::$current_plugin_data['TextDomain'].'_customStyles',array(),$version);
		wp_enqueue_script( 'mymaidquote-utility-scripts',WPQP_PLUGIN_PGDIR_URL.'/js/plugin_utilities.js',array('jquery','Bootstrap-Scripts'),$version,true);
		wp_enqueue_script( 'jquery.payment',WPQP_PLUGIN_PGDIR_URL.'/js/jquery.payment.js',array('jquery'),$version,true);
		wp_enqueue_script( 'mymaidquote-scripts',WPQP_PLUGIN_PGDIR_URL.'/js/script_frontQuotePageView.js',array('jquery','Bootstrap-Scripts'),$version,true);
		wp_enqueue_script( 'mymaidquote-localize-scripts',admin_url( 'admin-ajax.php' ).'?action='.self::$current_plugin_data['TextDomain'].'_localizeScript',array('jquery','Bootstrap-Scripts'),$version,true);
		$_quote = new MMQuotes();
		$_quote->_quoteView();
	}
}