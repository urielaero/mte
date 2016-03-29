<?php
$config_name = "uriel_config";
require_once "config/config.default_config.php"; 
require_once "config/config.$config_name.php";
$config = new $config_name();
require_once $config->mxnphp_dir."/scripts/autoload.php";

class AllModels extends table {

    public function AllModels($table_name, $conn = null) {
        if ($table_name != null) {
            $this->table_name = $table_name;
        }
        parent::__construct(null, $conn);
    }

    function info() {
    }
}

class Update_ccts extends controler{

    public function Update_ccts($config) {
        $this->config = $config;
        $this->conn = $this->dbConnect();
    }

    public function sql_update_ccts($file) {
        $queryActive = "";
        if (($gestor = fopen($file, "r")) !== FALSE) {
            while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
                $cct = $datos[0];
                $nombre = $datos[1];
                if ($cct != "clavecct") {
                    $name = pg_escape_string($nombre);
                    $queryActive .= "UPDATE escuelas SET status = 1, nombre = '$name'  WHERE cct = '$cct';\n";
                }
            }
            fclose($gestor);
        }

        $noActive = " UPDATE escuelas SET status = 0 WHERE status = 1;";
        #$queryActive = "UPDATE escuelas SET status = 1 WHERE cct in (".$cctsStr.");";
        echo $noActive;
        echo "\n";
        echo $queryActive;
        echo "\n";
        echo "UPDATE statuses SET cct_count=(SELECT count(*) from escuelas WHERE status=0) where id=0;";
        echo "\n";
        echo "UPDATE statuses SET cct_count=(SELECT count(*) from escuelas WHERE status=1) where id=1;";

    }

    public function sql_update_or_insert($from_file, $table, $values, $root_field, $rels =array(), $alias_cases=array(), $only_insert=false) {
        $relations = $this->get_dict_from_rels($rels);
        $relations_ids = $relations["ids"];
        $relations_names = $relations["names"];
        $sql = "";
        if (($gestor = fopen($from_file, "r")) !== FALSE) {
            while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
                $data = $this->format_data($datos, $values, $alias_cases);
                if ($data) {
                    if ($only_insert) {
                        $action = "insert";
                    } else {
                        $action = $this->update_insert($root_field, $data, $table, $values, $relations_ids);
                    }
                    $sql .= $this->generate_sql($action, $root_field, $data, $table, $relations_names, $alias_cases);
                }
            }
            fclose($gestor);
        }
        return $sql;
        
    }

    private function logger($log) {
        if (!isset($this->logger)) {
            $this->logger = array();
        }

        if (!isset($this->logger[$log])) {
            $this->logger[$log] = true;
            echo $log;
        }
    }

    private function generate_sql($action, $root_field, $data, $table, $relations, $alias_cases) {
        foreach($data as $key => $val) {
            if (isset($relations[$key])) {
                if (isset($relations[$key][$val])) {
                    $data[$key] = $relations[$key][$val];
                } else {
                    $this->logger("NO ID EXIST FOR '".$val."' in $key \n");
                    //exit();
                }
            }
        }

        $update = "";
        $insert_into = "";
        $insert_values = "";

        if (isset($alias_cases["default"])) { //only for inserts
            $insert_into = $alias_cases["default"]["into"].",";
            $insert_values = $alias_cases["default"]["values"].",";
        }

        foreach($data as $key => $val) {
            $update .= " $key = '$val',";
            $insert_into .= "$key,";
            $insert_values .= "'$val',";
        }
        $update = substr($update, 0, strlen($update)-1);
        $insert_into = substr($insert_into, 0, strlen($insert_into)-1);
        $insert_values =  substr($insert_values, 0, strlen($insert_values)-1);

        $query = "";
        if ($action == "update") {
            $query = "UPDATE $table SET $update WHERE $root_field = '{$data[$root_field]}';\n";
        } else if ($action == "insert"){
            $query = "INSERT INTO $table ($insert_into) VALUES ($insert_values);\n";
        }
        return $query; 
    }
    
    private function update_insert($root_field, $data, $table, $values, $relations) {
        $values_string = $this->values_to_string($values);
		$q = new AllModels($table, $this->conn);
		$q->search_clause = "{$root_field}='{$data[$root_field]}'";
        $f = $q->read($values_string);
        if (count($f) == 1) {
            $f = $f[0];
            $change = false;
            foreach($data as $key => $val) {
                if (isset($relations[$key])) {
                    $f_id = isset($relations[$key][$f->$key]) ? $relations[$key][$f->$key] : false;
                    if ($f_id != $val) {
                        $change = true;
                    }
                }else if ($f->$key != $val) {
                    $change = true;
                }
            }
            if ($change) {
                return "update";
            } else {
                return "equal";
            }
        }
        return "insert";
    }

    private function format_data($csv, $values, $alias_cases) {
        $d = array();
        $i = 0;
        $cases = isset($alias_cases["cases"]) ? $alias_cases["cases"] : array();
        $alias = isset($alias_cases["alias"]) ? $alias_cases["alias"] : array();
        foreach($values as $key => $v) {
            if ($csv[$i] == $key) {
                return false;
            }
            if ($v != null) {
                $d[$v] = $csv[$i];
                if (isset($cases[$v])) {
                    $d[$v] = $cases[$v]($d[$v]);
                }
                
                if (isset($alias[$v]) && isset($alias[$v][$d[$v]])) {
                    $d[$v] = $alias[$v][$d[$v]];
                }
                $d[$v] = pg_escape_string(trim($d[$v]));
            }

            $i++;
        }
        return $d;
    }
    
    private function values_to_string($values) {
        $s = "";
        foreach($values as $key => $v) {
            if ($v != null) {
                $s .= "{$v},";
            }
        }
        $s = substr($s, 0, strlen($s)-1);
        return $s;
    }

    public function get_dict_from_rels($rels) {

        $res = array();
        $res_names = array();
        foreach($rels as $k => $table) {
            $q = new AllModels($table, $this->conn);
            $q->search_clause .= ' TRUE ';
            $all = $q->read("id,nombre");
            $single = array();
            $single_name = array();
            foreach($all as $field) {
                $id = $field->id;
                $single[$id] = $field->nombre;
                $name = $field->nombre;
                $single_name[$name] = $id;
            }
            $res[$k] = $single;
            $res_names[$k] = $single_name;
        }
        return array("ids" => $res, "names" => $res_names);
    }
}

function estini2_escuelas_2013($config) {
    $update = new Update_ccts($config);
    $estini_values = array(
        "ENTIDAD" => "entidad",
        "CLAVECCT" => "clavecct",
        "NIVEL" => "nivel",
        "SUBNIVEL" => "subnivel",
        "CONTROL" => "control",
        "CCT_ZONA" => "cct_zona",
        "ZONAESCOLA" => "zonaescola",
    );
    $rels = array("nivel" => "niveles", "subnivel" => "subniveles", "control" => "controles");

    // como esta en archivo => como esta en db
    $alias_subnivel = array(
        "U.S.A.E.R." => "UNIDAD DE SERVICIOS DE APOYO A LA EDUCACION REGULAR (USAER)", 
        "C.A.M." => "CENTRO DE ATENCION MULTIPLE (CAM)",
        "PREESCOLAR CENDI" => "CENDI",
        "SECUNDARIA TRABAJADORES" => "SECUNDARIA PARA TRABAJADORES"
    );
    $alias_control = array("PUBLICO" => "PÚBLICA", "PRIVADO" => "PRIVADA");
    $alias_cases = array(
                    "cases" => array("entidad" => "intval"),
                    "alias" => array("subnivel" => $alias_subnivel, "control" => $alias_control),
                    "default" => array("into" => "idmunicipio, idlocalidad, idcolonia", "values" => "0, 0, 0")
                   );
    //echo "INSERT INTO subniveles VALUES(41, 'INICIAL INDIGENA', 0); \n";
    //echo "INSERT INTO niveles VALUES(14, 'SECUNDARIA TECNICA', 0); \n";
    //echo "INSERT INTO niveles VALUES(15, 'TELESECUNDARIA', 0); \n";
    $update->sql_update_or_insert("estini_supervisores/ESTINI_2.csv", "escuelas_2013", $estini_values, "clavecct", $rels, $alias_cases);
    echo "............";
    exit();
}

function estini2_censo_completo_2013($config) {
    $update = new Update_ccts($config);
    
    //csv => db
    echo "CENSO_COMPLETO_2013";
    $estini_values = array(
        "ENTIDAD" => null,
        "CLAVECCT" => "cct",
        "NIVEL" => null,
        "SUBNIVEL" => null,
        "CONTROL" => null,
        "CCT_ZONA" => null,
        "ZONAESCOLA" => null,
        "INSC_T" => "num_alumnos",
        "TOT_DOC_P" => "num_personal"
    );

    $alias_cases = array(
                        "default" => array("into" => "id_turno", "values" => "0")
                    );

    $update->sql_update_or_insert("estini_supervisores/ESTINI_2.csv", "censo_completo_2013", $estini_values, "cct", array(), $alias_cases);
    echo "-----------";
}

function supervisores($config) {
    $update = new Update_ccts($config);
    echo "SUPERVISORES";

    $supervisores_values = array(
        "ENTIDAD" => "entidad",
        "ZONA" => "zona",
        "CLAVECCT" => "cct",
        "NOMBRECT" => "nombrect",
        "DOMICILIO" => "domicilio",
        "COLONIA" => "colonia",
        "LOCALIDAD" => "localidad",
        "MUNICIPIO" => "municipio",
        "CODIGO_POSTAL" => "codigo_postal",
        "NIVEL" => "nivel",
        "TELEFONO" => "telefono",
        "NOMBRE" => "nombre"
    );
    $rels = array("colonia" => "colonias", "localidad" => "localidades", "municipio" => "municipios", "nivel" => "niveles");
    $alias_cases = array(
                    "cases" => array("nombre" => "trim"));
    $sql = $update->sql_update_or_insert("estini_supervisores/Supervisores.csv", "supervisores", $supervisores_values, "cct", $rels, $alias_cases, true);
    //echo $sql;
    echo "-----------";
}

//estini2_escuelas_2013($config);

estini2_censo_completo_2013($config); //pendiente en produccion
//supervisores($config);
exit();
?>
