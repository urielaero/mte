<?php
require_once(__DIR__."/../test.default.php");
class tuberiaTest extends defaultTest{
    public function setUp(){
        parent::setUp();
        $this->controler = new main($this->config);
        $mg_connect = $this->controler->mongo_connect();
        $this->model = new tuberia_denuncia($mg_connect);
        
        $this->v_resp = array(
            "id" => "22",
            "denuncia" => "23",
            "numero" => "1",
            "date" => "2016-08-04 11:14:56.323661"
        );
	}

    public function testGetNotifyData() {
        $resp = $this->v_resp;
        $send = $this->model->getNotifyData($resp);
        $expected = array(
            "respuesta_id" => "22",
            "email" => "aero.uriel@gmail.com",
            "label" => "Acoso escolar",
            "nombre" => "uriel",
            "token" => "68de41215a56006711cbc1a0db19a8fe",
            "date" => "2016-08-04 11:14:56.323661",
            "entidadId" => 21,
            "nivelName" => "BACHILLERATO",
            "numero" => "1"
        );
        $this->AssertEquals($expected, $send);
    }



    public function testFindDaysForNotifyType1() {
        $den = array(
            "label" => "Acoso escolar",
            "nivelName" => "BACHILLERATO",
            "numero" => "1",
            "entidadId" => 21
        );
        $rs = $this->model->findDaysForNotify($den);
        $this->AssertEquals(10, $rs);
        
        $den["entidadId"] = 9;
        $den["numero"] = "3";
        $rs = $this->model->findDaysForNotify($den);
        $this->AssertEquals(10, $rs);

        $den["entidadId"] = 14;
        $den["numero"] = "7";
        $rs = $this->model->findDaysForNotify($den);
        $this->AssertEquals(20, $rs);
    }

    public function testFindDaysForNotifyType2() {
        $den = array(
            "label" => "Inasistencia de profesores",
            "nivelName" => "BACHILLERATO",
            "numero" => "1",
            "entidadId" => 21
        );


        $den["entidadId"] = 9;
        $den["numero"] = "2";
        $rs = $this->model->findDaysForNotify($den);
        $this->AssertEquals(20, $rs);

        $den["entidadId"] = 14;
        $den["numero"] = "6";
        $rs = $this->model->findDaysForNotify($den);
        $this->AssertEquals(10, $rs);
    }

    public function testFindDaysForNotifyType3() {
        $den = array(
            "label" => "Cobro de cuotas",
            "nivelName" => "BACHILLERATO",
            "numero" => "6",
            "entidadId" => 9
        );

        $rs = $this->model->findDaysForNotify($den);
        $this->AssertEquals(10, $rs);

        $den["nivelName"] = "Other";
        $rs = $this->model->findDaysForNotify($den);
        $this->AssertEquals(20, $rs);

        $den["entidadId"] = "14";
        $rs = $this->model->findDaysForNotify($den);
        $this->AssertEquals(10, $rs);

        $den["entidadId"] = "14";
        $den["nivelName"] = "BACHILLERATO";
        $den["numero"] = 3;
        $rs = $this->model->findDaysForNotify($den);
        $this->AssertEquals(20, $rs);
    }

    public function testFindDaysForNotifyType4() {
        $den = array(
            "label" => "Infraestructura",
            "nivelName" => "BACHILLERATO",
            "numero" => "3",
            "entidadId" => 9
        );

        $rs = $this->model->findDaysForNotify($den);
        $this->AssertEquals(20, $rs);

        $den["nivelName"] = "Other";
        $den["numero"] = "6";
        $rs = $this->model->findDaysForNotify($den);
        $this->AssertEquals(20, $rs);
    }

    public function testFindDaysForNotifyNotExistsRule(){
        $den = array(
            "label" => "Infraestructura",
            "nivelName" => "BACHILLERATO",
            "numero" => "15",
            "entidadId" => 9
        );

        $rs = $this->model->findDaysForNotify($den);
        $this->AssertEquals(15, $rs);
    }

    public function testNotificationAvailable() {
        $denunce_date = "2016-08-04 11:14:56.323661";
        $days_rule = 10;
        $current_date = date_create("2016-08-14");
        $notify = $this->model->notificationAvailable($denunce_date, $days_rule, $current_date);
        $this->AssertEquals(true, $notify);

        $notify = $this->model->notificationAvailable($denunce_date, 11, $current_date);

        $this->AssertEquals(false, $notify);

        $notify = $this->model->notificationAvailable($denunce_date, 9, $current_date);

        $this->AssertEquals(true, $notify);
    }

}
?>
