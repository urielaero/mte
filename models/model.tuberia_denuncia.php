<?php

class tuberia_denuncia{
    public function tuberia_denuncia($mongoClient){
        $this->mongo = $mongoClient;
    }

    public function update($data){
        $db = $this->mongo->selectDB("mte_tuberia");
        $coll = $db->selectCollection("denuncias");
        $token = $data["token"];
        $denuncia = $coll->findOne(array("token" => $token));
        if(!$denuncia)
            return false;
        $default = array_merge($denuncia, $data);
        $update = $coll->update(array("token"=> $data["token"]), $default);
        if($update["updatedExisting"]){
            $default["id"] = $default["_id"]->{'$id'};
            unset($default["_id"]);
            return $default;
        }
        return false;
    }

    public function save($data){
        $db = $this->mongo->selectDB("mte_tuberia");
        $coll = $db->selectCollection("denuncias");
        $data["_id"] = new MongoId();
        $id = $data["_id"]->{'$id'};
        $token = "{$id}{$data["email"]}";
        $data["token"] = md5($token);
        $res = $coll->insert($data);
        if(isset($res["ok"])){
            $data["id"] = $id;
            unset($data["_id"]);
            return $data;
        }
        return false;
    }

    public function findByToken($token){
        $db = $this->mongo->selectDB("mte_tuberia");
        $coll = $db->selectCollection("denuncias");
        $denuncia = $coll->findOne(array("token" => $token));    
        if(isset($denuncia["_id"])){
            $denuncia["id"] = $denuncia["_id"]->{'$id'};
            unset($denuncia["_id"]);
            return $denuncia; 
        }
        return false;
    }

    public function findByEmail($email){
        $db = $this->mongo->selectDB("mte_tuberia");
        $coll = $db->selectCollection("denuncias");
        $cursor = $coll->find(array("email" => $email));
        $denuncias = array();
        foreach($cursor as $doc){
            $doc["id"] = $doc["_id"]->{'$id'};
            unset($doc["_id"]);
            $denuncias[] = $doc;
        }
        return $denuncias;
    }

    public function findByDenuncia($id) {
        $db = $this->mongo->selectDB("mte_tuberia");
        $coll = $db->selectCollection("denuncias");
        return $coll->findOne(array("denuncia" => $id));
    }

    public function getNotifyData($v_resp) {
        $denunce = $this->findByDenuncia($v_resp["denuncia"]);
        return array(
            "email" => $denunce["email"],
            "label" => $denunce["label"],
            "nombre" => $denunce["userName"],
            "token" => $denunce["token"],
            "date" => $v_resp["date"],
            "entidadId" => $denunce["entidadId"],
            "nivelName" => $denunce["nivelName"],
            "numero" => $v_resp["numero"],
            "respuesta_id" => $v_resp["id"]
        );
    }

    public function findDaysForNotify($den) {
        $db = $this->mongo->selectDB("mte_tuberia");
        $coll = $db->selectCollection("notificaciones");
        $or1 = array(
            array("estado" => $den["entidadId"]),
            array("estado" => "*")
        );
        $or2 = array(
            array("nivel" => $den["nivelName"]),
            array("nivel" => "*")
        );
        $num = intval($den["numero"]);
        $in = array(
            '$in' => [$num, $num+.1, $num+.2, $num+.3, $num+.4]
        );
        $find = array(
            "paso" => $in,
            "label" => $den["label"],
            '$and' => array(
                array('$or' => $or1),
                array('$or' => $or2)
            )
        );
        
        $sort = array(
            "estado" => 1,
            "nivel" => -1
        );
        $res = $coll->find($find)->sort($sort)->limit(1)->getNext();
        if ($res) {
            return $res["dias"];
        }
        return 15;
    }

    public function notificationAvailable($denunce_date, $days_rule, $current_date) {
        $denunce = date_create($denunce_date);
        $denunce->setTime(0, 0, 0);
        $diff = $denunce->diff($current_date);
        return $diff->days >= $days_rule;
    } 
}
?>
