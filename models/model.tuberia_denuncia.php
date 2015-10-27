<?php

class tuberia_denuncia{

	public function tuberia_denuncia($mongoClient){
        $this->mongo = $mongoClient;
    }

    public function update($data){
        $db = $this->mongo->selectDB("mte_tuberia");
        $coll = $db->selectCollection("denuncias");
        $update = $coll->update(array("token"=> $data["token"]), $data);
        if($update["updatedExisting"]){
            return $data;
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
