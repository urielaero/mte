<?php
class sonny_config extends default_config{
    public function __construct(){
        //Sofware
        $this->document_root = $_SERVER['DOCUMENT_ROOT']."/";
        $this->mxnphp_dir = "c:/users/sonny/dev/mxnphp/";    
        $this->http_address = 'http://mte/';

        //Database Config
        $this->db_host = "***REMOVED***";
        $this->db_name = "mte";
        $this->db_user = "root";
        $this->db_pass = "";

        //Database
        $this->db_host = '***REMOVED***';
        $this->db_name = 'cte_optimizada';
        $this->db_user = 'root';
        $this->db_pass = '***REMOVED***';


        parent::__construct();
    }
               
}
?>
