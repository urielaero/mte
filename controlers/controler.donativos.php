<?php
	
class donativos extends main{

    public function index(){
        $this->header_folder ='donativos';
        $this->breadcrumb = array('#'=>'Donativos');
        $this->include_theme('index','index');
    }

}
?>
