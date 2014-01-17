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


		//sweetcaptcha
		$this->SWEETCAPTCHA_APP_ID = 40382; // your application id (change me)
		$this->SWEETCAPTCHA_KEY = '6db20e6903f3add7fbd64e2f9341d0c7'; // your application key (change me)
		$this->SWEETCAPTCHA_SECRET = '1de81134590566f83cb616481120221c'; // your application secret (change me)
		$this->SWEETCAPTCHA_PUBLIC_URL ='sweetcaptcha.php'; // public http url to this file

		//MXNPHP
		$this->dev_mode = true;
		
	}
}
?>