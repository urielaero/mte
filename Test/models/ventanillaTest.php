<?php
require_once(__DIR__."/../test.default.php");
class ventanillaRespuestasTest extends defaultTest{
	public function setUp(){
		parent::setUp();
		$this->controler = new main($this->config);
		$this->conn = $this->controler->dbConnect();
		$this->model = new ventanilla_respuesta(null, $this->conn);
	}

	public function testFormatQueryForLatest() {
		// ALTER TABLE ventanilla_respuestas add notificado boolean DEFAULT FALSE;
		$expected = "SELECT id,denuncia,numero,timestamp from ventanilla_respuestas where id IN (select DISTINCT ON (\"denuncia\") id from ventanilla_respuestas WHERE timestamp <= '2016-08-05 00:00:00'  ORDER BY \"denuncia\", \"timestamp\" DESC NULLS LAST) AND notificado<>TRUE;"; 
		$date = date_create("2016-08-05");
		$sql = $this->model->formatQueryForLatest($date);
		$this->AssertEquals($expected, $sql);
	}

	public function testFindForNotify() {
		$date = date_create("2016-08-05");
		$denunces = $this->model->findForNotify($date);
		$this->AssertNotEmpty($denunces);
		$this->AssertEquals(count($denunces), 11);
		$modify = $denunces[0];
		$vent = new ventanilla_respuesta($modify["id"], $this->conn);
		$vent->update('notificado', array('TRUE'));
		$denunces2 = $this->model->findForNotify($date);
		$this->AssertNotEquals($denunces, $denunces2);
		$this->AssertNotEquals($denunces[0], $denunces2[0]);
		$this->AssertEquals(count($denunces2), 10);
		$vent->update('notificado', array('FALSE'));
	}
}
?>
