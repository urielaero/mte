<?php
require_once("test.default.php");

class mainTest extends defaultTest{
	public function setUp(){
		parent::setUp();
		$this->controler = new main($this->config);
	}

	public function testGet_escuelas(){
		$params = new StdClass();
		$params->ccts = array("21DPR2501R");
		$params->type_test = "enlace";
		$this->controler->get_escuelas($params);
		$this->AssertEquals($this->controler->escuelas[0]->nombre,"MANUEL AVILA CAMACHO");
	}

	public function test_format_email_template() {
		$template = <<<EOT
#{name}.#{other}
#{other}
EOT;

		$keys = array("name"=>"Foo", "other"=> "bar");
		$send = $this->controler->format_email_template($template, $keys);
		$expected = <<<EOT
Foo.bar
bar
EOT;
		$this->AssertEquals($expected, $send);
	}

    public function test_check_for_notifies(){
		$date = date_create("2016-12-05");
        $dens = $this->controler->check_for_notifies($date);
        $this->controler->send_notifies($dens, false);
        $vent = new ventanilla_respuesta(null, $this->controler->conn); 
		$denunces = $vent->findForNotify($date);

        foreach($dens as $complete) {
                $vent = new ventanilla_respuesta($complete["respuesta_id"], $this->conn);
				$vent->update('notificado', array('FALSE'));
        }
        $this->AssertEmpty($denunces);
    }

    public function test_send_notifies(){
        $den = array(
            "respuesta_id" => "0",
            "email" => "aero.uriel@gmail.com",
            "label" => "Acoso escolar",
            "nombre" => "uriel",
            "token" => "68de41215a56006711cbc1a0db19a8fe",
            "date" => "2016-08-04 11:14:56.323661",
            "entidadId" => 21,
            "nivelName" => "BACHILLERATO",
            "numero" => "1"
        );
        //$this->controler->send_notifies(array($den), true);
    }


}
?>
