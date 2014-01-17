<?php
class luis_config extends default_config{
	public function luis_config(){
		parent::__construct();
		//error_reporting(0);
		//Site
		$this->http_address = 'http://mte.local/';
		$this->mxnphp_dir = "c:/wamp/www/framework/";

		//$this->blog_address = 'http://blog.mejoratuescuela.org/';
		$this->blog_address = 'http://comparatuescuelablog.projects.spaceshiplabs.com/';
		
		//Database
		/*
		$this->db_host = '***REMOVED***';
		$this->db_name = 'mejoratuescuela';//enlace
		$this->db_user = 'root';
		$this->db_pass = '';*/


		$this->db_host = '***REMOVED***';
		$this->db_name = 'cte_optimizada';
		$this->db_user = 'root';
		$this->db_pass = '***REMOVED***';

		//MXNPHP
		$this->dev_mode = true;
		
	}
}
?>