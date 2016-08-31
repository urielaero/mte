<?php
class api_ventanilla_escolar extends main{
    public function api_ventanilla_escolar($config){
        $this->config = $config; 
        $this->conn = $this->dbConnect(); 
    }

    private function resJson($data) {
        header('Access-Control-Allow-Origin: *'); 
        header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept'); 
        echo json_encode($data);
    }

    public function notifies_available() {
        $email = $this->request('email');
        $entity = $this->request('entity');
        $cct = $this->request('cct');
        $notify = new ventanilla_pendientes(NULL, $this->conn);   
        $notify->create('email, entidad, cct', array($email, $entity, $cct));
        $this->resJson(array("success" => true));
    }

    public function supervisor() {
        //for cct_zona, search school = 21EES0317Z;
    	$cct = $this->request('cct');
        $escuela = new escuelas_2013($cct, $this->conn); 
        $escuela->read("clavecct,cct_zona,entidad,nivel,zonaescola");
        $supervisor = new supervisor(NULL, $this->conn);
        $supervisor->search_clause = '';
        $res = array("supervisor" => false);
        if (isset($escuela->cct_zona) && $escuela->cct_zona != NULL ) {
            $supervisor->search_clause = "cct='{$escuela->cct_zona}' OR";
            $res["cct_zona"] = $escuela->cct_zona;
        }
        if ($escuela->zonaescola != NULL ) {
            $zona = intval($escuela->zonaescola);
            $supervisor->search_clause .= " (entidad={$escuela->entidad} AND nivel={$escuela->nivel} AND zona={$zona})";
        }
        if ($supervisor->search_clause == '') {
            return $this->resJson($res);
        }
        $supervisor->limit = 1; 
        $find = $supervisor->read('cct,nombrect,domicilio,colonia,localidad,municipio,codigo_postal,telefono,nombre');
        if ($find && count($find)) {
            $res["supervisor"] = true;
            $superv = $find[0];
            $res["cct"] = $superv->cct;
            $res["nombrect"] = $superv->nombrect;
            $res["nombre"] = $superv->nombre;
            $res["domicilio"] = $superv->domicilio;
            $res["colonia"] = $superv->colonia;
            $res["localidad"] = $superv->localidad;
            $res["municipio"] = $superv->municipio;
            $res["codigo_postal"] = $superv->codigo_postal;
            $res["telefono"] = $superv->telefono;
        }
        $this->resJson($res);
    }

    public function dif() {
        //21EBH0386S;
    	$cct = $this->request('cct');
        $escuela = new escuelas_2013($cct, $this->conn); 
        $escuela->read("clavecct,municipio,entidad");
        $dif = new dif_municipio(NULL, $this->conn);
        $dif->search_clause = "clave_municipio={$escuela->municipio} AND entidad={$escuela->entidad}";
        $dif->limit = 1;
        $find = $dif->read('municipio_nombre,domicilio,telefono,horario,email,encargado'); 
        $res = array('dif' => false);
        if ($find && count($find)) { 
            $d = $find[0];
            $res['dif'] = true;
            $res['municipio_nombre'] = $d->municipio_nombre;
            $res['domicilio'] = $d->domicilio;
            $res['telefono'] = $d->telefono;
            $res['horario'] = $d->horario;
            $res['email'] = $d->email;
            $res['encargado'] = $d->encargado;
        }
        $this->resJson($res);
    }

    public function contraloria_sep() {
     	$estado = $this->request('entidad') ? intval($this->request('entidad')) : 0;
        $contraloria = new contraloria_sep($estado, $this->conn);
        $contraloria->read('secretaria,nombre,domicilio,telefono,responsable,cargo,email');
        $res = array(
            'secretaria' => $contraloria->secretaria,
            'nombre' => $contraloria->nombre,
            'domicilio' => $contraloria->domicilio,
            'telefono' => $contraloria->telefono,
            'responsable' => $contraloria->responsable,
            'cargo' => $contraloria->cargo,
            'email' => $contraloria->email
        );

        $this->resJson($res);
    }

    public function calificacion() { 
    	$token = $this->request('token');
        $calis = $this->request('score') ? json_decode($this->request('score')): array();
        $comment = $this->request('comment') ? strip_tags($this->request('comment')) : '';
        $comment_id = $this->request('commentId');
        $tuberia = new tuberia_denuncia($this->mongo_connect());
        $denuncia = $tuberia->findByToken($token);

        if ($denuncia) {
            foreach($calis->scores as $cal) {
                $fields = 'denuncia,pregunta,calificacion,uuid';
                $data = array($denuncia['denuncia'], $cal->question, $cal->score, $cal->uuid);
                if ($cal->pid) {
                    $ven = new ventanilla_calificacion($cal->pid, $this->conn);
                    $ven->update($fields, $data);
                } else {
                    $ven = new ventanilla_calificacion(null, $this->conn);
                    $ven->create($fields, $data, 'id');
                }

            }

            if ($comment and $comment != '')  {
                $c_fields = 'denuncia,comentario';
                $c_data = array($denuncia['denuncia'], $comment);
                if ($comment_id) {
                    $com = new ventanilla_comentario($comment_id, $this->conn);
                    $com->update($c_fields, $c_data);
                } else {
                    $com = new ventanilla_comentario(null, $this->conn); 
                    $com->create($c_fields, $c_data);               
                }

            }
            
        }
        $this->resJson(array('success' => true));
    }

    public function get_calificacion() {
     	$token = $this->request('token');
        $tuberia = new tuberia_denuncia($this->mongo_connect());
        $denuncia = $tuberia->findByToken($token);
        $query = "denuncia = {$denuncia['denuncia']}";
        $cal = new ventanilla_calificacion(null, $this->conn);
        $cal->search_clause = $query;
        $cals = $cal->read('id,denuncia,pregunta,calificacion,uuid');
        $res = array();
        foreach($cals as $cal) {
            $res['preguntas'][$cal->uuid] = array(
                'denuncia' => $cal->denuncia,
                'pregunta' => $cal->pregunta,
                'pid' => $cal->id,
                'calificacion' => intval($cal->calificacion),
                'uuid' => $cal->uuid
            );
        }

        $comment = new ventanilla_comentario(null, $this->conn);
        $comment->search_clause = $query;
        $com = $comment->read('id,denuncia,comentario');
        if (count($com)) {
            $res['comentario'] = array(
                'text' => $com[0]->comentario,
                'denuncia' => $com[0]->denuncia,
                'pid' => $com[0]->id
            ); 
            
        }

        $this->resJson($res);
    }

    public function information_fixed() {
        $type = $this->request('type');
        $entity = $this->request('entity');
        $email = $this->request('email');
        $text_old = $this->request('textOld');
        $text_new = $this->request('textNew');
        $mensage = $this->request('mensage');
        $update = new ventanilla_actualizacion(null, $this->conn);
        $update->create('tipo,entidad,email,informacion_para_actualizar,information_nueva,comentario',
            array($type, $entity, $email, $text_old, $text_new, $mensage), 'id');
        if ($update->id) {
            $this->resJson(array('success' => true));
        } else {
            $this->resJson(array('failed' => 'Problema al guardar'));
        }
    }

    public function consejo_escolar() {
     	$estado = $this->request('entidad') ? intval($this->request('entidad')) : 0;

        $consejo = new consejo_escolar($estado, $this->conn);
        $consejo->read('responsables,telefono,email');
        $res = array(
            'telefono' => $consejo->telefono,
            'responsables' => $consejo->responsables,
            'email' => $consejo->email
        );

        $this->resJson($res);
    	
    }

    public function delegacion_fed_sep() {
     	$estado = $this->request('entidad') ? intval($this->request('entidad')) : 0;

        $fed = new delegacion_fed_sep($estado, $this->conn);
        $fed->read('titulo,domicilio,telefono,fax,email');
        $res = array(
            'telefono' => $fed->telefono,
            'titulo' => $fed->titulo,
            'email' => $fed->email,
            'fax' => $fed->fax,
            'domicilio' => $fed->domicilio
        );

        $this->resJson($res);
    	
    }

    public function instituto_infraestructura() {
     	$estado = $this->request('entidad') ? intval($this->request('entidad')) : 0;
        $inf = new instituto_infraestructura($estado, $this->conn);
        $inf->read('instituto,telefono,responsable,email,cargo,domicilio');
        $res = array(
            'instituto' => $inf->instituto,
            'telefono' => $inf->telefono,
            'responsable' => $inf->responsable,
            'email' => $inf->email,
            'cargo' => $inf->cargo,
            'domicilio' => $inf->domicilio
        );

        $this->resJson($res);
    
    }
}
?>
