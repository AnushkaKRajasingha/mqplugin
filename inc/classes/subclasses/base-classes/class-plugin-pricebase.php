<?php
/**
 * @author Anushka Rajasingha
 * @url http://www.anushkar.com
 * @date 02/27/2015
 *
 */
if(!interface_exists ('IMMPriceBase')){
	interface IMMPriceBase{
		public function setDescription($description);
		public function getDescription($uniqueid = null);
		public function setPrice($price);
		public function getPrice($uniqueid = null);
		public function setSortOrder($sortorder);
		public function getSortOrder($uniqueid = null);
	}
}