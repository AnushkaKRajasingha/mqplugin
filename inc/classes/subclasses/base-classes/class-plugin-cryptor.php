<?php
class Encriptor
{
	// The key
	private $_key ;
	// App key
	private $_appkey = 'ahrld8gl';
	
	
	// Generates the key
	public function __construct($key = '', $md5 = true)
	{
		$key = empty($key) ? $this->_appkey : $key;
		$key = str_split($md5 ? md5($key) : sha1($key), 1);
		$signal = false;
		$sum = 0;

		foreach($key as $char)
		{
			if($signal)
			{
				$sum -= ord($char);
				$signal = false;
			}
			else
			{
				$sum += ord($char);
				$signal = true;
			}
		}

		$this->_key = abs($sum);
	}

	// Encrypt
	public function encrypt($text)
	{
		$text = str_split($text, 1);
		$final = '';

		foreach($text as $char)
		{
			$final .= sprintf("%03x", ord($char) + $this->_key);
		}

		return $final;
	}

	// Decrypt
	public function decrypt($text)
	{
		$final = '';
		$text = str_split($text, 3);

		foreach($text as $char)
		{
			$final .= chr(hexdec($char) - $this->_key);
		}

		return $final;
	}
}