<?php
require_once('./models/model.kaluz.php'); // WTF!
class api_kaluz extends main{
    public function api_kaluz($config){
        $this->config = $config;
        $this->conn = $this->dbConnect();
    }

    function index() {
        $id = $this->request('id');
        $res = $this->get($id);
        $this->res_json($res);
    }

    function find() {
        $where = $this->request_params(array("entidad"));
        $params = array("per_pages" => 200, "where" => $where);
        $data = $this->schools($params);
        $data["meta"] = $params;
        $this->res_json($data);
    }

    function group() {
        $data = $this->counter();
        $this->res_json($data);
    }

    function get($id) {
        $school = new kaluz_escuela($id, $this->conn);
        $school->read("cct,nombre,km_escuela_cercana,total_alumnos,total_personal,longitud,latitud,altitud,
        turno=>nombre,
        entidad=>nombre,entidad=>id,kaluz_tipo_dano=>id,kaluz_tipo_dano=>nombre,
        kaluz_estatus_reconstruccion=>nombre,estatus_reconstruccion=>id,
        kaluz_escuela_organizacion=>kaluz_organizacion");
        $sc = $this->normalize_obj($school);
        $sc["organizaciones"] = $this->check_orgs($school);

        return array("data" => $sc);
    }

    function schools($params = array()) {
        $per_pages = $this->get_array($params, "per_pages", 10);
        $where = $this->get_array($params, "where", array());
        $q = new kaluz_escuela(null, $this->conn);
		$q->search_clause = $this->formate_search($where);
        $pagination = new pagination('kaluz_escuela', $per_pages, $q->search_clause, "p", $this->conn);
        $q->limit = $pagination->limit;
        $ls = $q->read("id,cct,latitud,longitud,altitud");
        $objs = array();
        foreach($ls as $sc) {
            $objs[] = $this->normalize_obj($sc);
        }
        $p = $this->normalize_obj($pagination);
        return array("data" => $objs, "pagination" => $p);
    }

    function counter($params=array()) {
        $where = $this->get_array($params, "where", array());
        $school = new kaluz_escuela(null, $this->conn);
        $ents = $school->get_entidades();
        $res = array();
        foreach($ents as $ent) {
            $w = array("where" => array("entidad" => $ent));
            $sc = $this->schools($w);
            $res[] = array("id" => $ent, "total" => $sc["pagination"]->count);
        }
        return $res;
    }

    private function check_orgs($sc) {
        $orgs = array();
        if (isset($sc->kaluz_escuela_organizacion)) {
            foreach($sc->kaluz_escuela_organizacion as $org) {
                $orgs[] = $org->organizacion($this->conn);
            }
        }
        return $orgs;
    }

    private function normalize_obj($obj) {
        $res = array();
        if (isset($obj->fields)) {
            foreach($obj->fields as $k => $field) {
                if ($k == "conn") continue;
                $pos = strpos($k, "=>");
                if ($pos > 0) {
                    $sub_k = substr($k, 0, $pos);
                    $res[$sub_k] = $this->get_array($res, $sub_k, array());
                    $sub_k_field = substr($k, $pos+2);
                    $res[$sub_k][$sub_k_field] = $field;
                } else {
                    $res[$k] = $field;
                }
            }
            return $res;
        }

        if (isset($obj->conn)) {
            $obj->conn = null;
            return $obj;
        }
    }

    private function get_array($array, $key, $default = null) {
        return isset($array[$key]) ? $array[$key]:$default;
    }

    private function formate_search($where) {
        $search = "1 = 1 ";
        foreach($where as $k => $f) {
            $search .= "AND $k = '$f'";
        }

        return $search;
    }

    private function res_json($data) {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
        echo json_encode($data);
    }

    private function request_params($params) {
        $res = array();
        foreach($params as $p) {
            $req = $this->request($p);
            if ($req != null) {
                $res[$p] = $req;
            }
        }
        return $res;
    }
}
?>
