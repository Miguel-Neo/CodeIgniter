<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Lang extends MX_Lang{
	public function __construct(){
		parent:: __construct();
	}
	public function line($line, $log_errors = TRUE){
		$value = parent::line($line);
		if($value === FALSE){
			return '['.$line.']';
		}
		return $value;
	}
}

/* End of file MY_Lang.php */
/* Location: ./application/core/MY_Lang.php */