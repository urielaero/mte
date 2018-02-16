<?php
require_once("test.default.php");

class apiKaluzTest extends defaultTest{
    public function setUp(){
        parent::setUp();
        $this->controler = new api_kaluz($this->config);
    }

	public function some(){
        $this->AssertEquals($this->controler->some(), "some");
    }

    public function test_list_schools_without_params() {
        $res = $this->controler->schools();
        $this->assertCount(10, $res["data"]);
        $this->assertArrayHasKey("id", $res["data"][0]);
        $this->assertArrayHasKey("cct", $res["data"][0]);
        $this->assertArrayHasKey("cct", $res["data"][0]);
    }

    public function test_list_schools_filters() {
        $cct = "29KTV0029P";
        $res = $this->controler->schools(array("where" => array("cct" => $cct, "entidad" => "29")));
        $this->assertCount(1, $res["data"]);
        $sc = $res["data"][0];
        $this->assertEquals($cct, $sc["cct"]);
    }

    public function test_get() {
        $res = $this->controler->get("8161");
        $sc = $res["data"];
        $this->assertEquals($sc["cct"], "29KTV0029P");
        $this->assertEquals($sc["km_escuela_cercana"], 39.8);
        $this->assertEquals($sc["total_alumnos"], 16);
        $this->assertEquals($sc["total_personal"], 2);
        $this->assertEquals($sc["latitud"], "19.5781");
        $this->assertEquals($sc["longitud"], "-98.241681");
        $this->assertEquals($sc["altitud"], "1678");
        $this->assertEquals($sc["turno"]["nombre"], "MATUTINO");
        $this->assertEquals($sc["entidad"]["nombre"], "TLAXCALA");
        $this->assertEquals($sc["kaluz_estatus_reconstruccion"]["nombre"], "En curso");
        $this->assertEquals($sc["kaluz_tipo_dano"]["nombre"], "Menor");

    }

    function test_escuela_organizacion() {
        $res = $this->controler->get("16304");
        $sc = $res["data"];
        $this->assertCount(2, $sc["organizaciones"]);
    }
}

?>
