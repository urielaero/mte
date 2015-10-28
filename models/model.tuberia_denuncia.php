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
}

?>
