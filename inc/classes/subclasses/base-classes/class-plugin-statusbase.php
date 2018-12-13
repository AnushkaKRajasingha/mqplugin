<?php
/**
 * @author Anushka Rajasingha
 * @url http://www.anushkar.com
 * @date 02/27/2015
 *
 */
if(!interface_exists ('IMMStatusBase')){
	interface IMMStatusBase{
		public function setActive($active);
		public function IsActive($uniqueid);
		public function setDelete($delete);
		public function IsDelete($uniqueid);
	}
}