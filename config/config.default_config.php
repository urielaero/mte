<?php
class default_config{
        public function __construct(){
                //system configuration
                $this->site_name =  'comparatuescuela.org';
                $this->theme = 'mtev2';
                $this->jsonMode = true; //Este es requerido para el tema de segunda version guarda los arreglos de objetos en arreglos de json
                $this->default_controler = 'home';
                $this->default_action = 'index';
                $this->blog_address = 'http://blog.mejoratuescuela.org/';
                $this->controler404 = 'home';
                $this->action404 = 'e404';
                //Security
                $this->secured = false;

		//mocha test
		$this->front_test = false;


                //Sofware
                $this->document_root = $_SERVER['DOCUMENT_ROOT']."/";
                $this->lang = "en";
                $this->dev_mode = true;
                $this->search_location = false;
                $this->contact_email = 'contacto@mejoratuescuela.org';
                $this->image_email = 'sonny@spaceshiplabs.com';
                $this->image_email = 'ariadna.camargo@imco.org.mx';
                $this->tynt = false;

                //Image Sizes
                $this->icon_sizes = json_decode('[
                        {"width":"50","height":"50","slug":"tiny"},
                        {"width":"156","height":"112","slug":"signs" ,"resize_type":"best fit"}
                ]');
                
                //MTE
                $this->semaforos = array('Reprobado','De panzazo','Bien','Excelente','No toma la <br /> prueba <br />ENLACE','Poco confiable','Esta escuela no toma la prueba ENLACE para todos los años','La prueba ENLACE no esta disponible para este nivel escolar','No aplica',);
                $this->semaforos2 = json_decode('[
                    {
                        "label" : "Reprobado",
                        "icon" : "icon-tache-01",
                        "class" : "rank1"
                    },
                    {
                        "label" : "De panzazo",
                        "icon" : "icon-tache-01",
                        "class" : "rank2"
                    },
                    {
                        "label" : "Bien",
                        "icon" : "icon-check-01",
                        "class" : "rank3"
                    },
                    {
                        "label" : "Excelente",
                        "icon" : "icon-check-01",
                        "class" : "rank4"
                    },
                    {
                        "label" : "No toma la prueba ENLACE",
                        "icon" : "icon-notomaenlace",
                        "class" : "rank5"
                    },
                    {
                        "label" : "Poco confiable",
                        "icon" : "icon-pococonfiable",
                        "class" : "rank6"
                    },
                    {
                        "label" : "Esta escuela no toma la prueba ENLACE para todos los años",
                        "icon" : "icon-notodoslosanos",
                        "class" : "rank7"
                    },
                    {
                        "label" : "Prueba ENLACE no disponible para este nivel escolar",
                        "icon" : "icon-notomaenlace",
                        "class" : "rank8"
                    },
                    {
                        "label" : "Prueba ENLACE no disponible para este nivel escolar",
                        "icon" : "icon-notomaenlace",
                        "class" : "rank9"
                    }
                ]');


		$this->email_convocatoria = <<<EOT
<h1>¡Gracias por tu registro para participar en la convocatoria Papás y Mamás en EducAcción!</h1>

<p>Con este correo confirmamos que recibimos tus datos.</p>

<h2>¿Qué sigue?</h2>
<p>
Entre el 1ero de enero y el 31 de marzo del 2016 tendrás que enviar información y documentación sobre la implementación de tu proyecto.  Lo que lograron y los cambios a partir de su participación en la escuela.
<br>
<br>
Después de eso se hará una primera selección de escuelas para participar en una votación pública para seleccionar a las escuelas ganadoras.
<br>
<br>
Las escuelas ganadoras recibirán apoyos complementarios de Fundación Televisa y su historia será compartida con el país al inicio del ciclo escolar 2016 en el programa Primero Noticias.
<br>
<br>
Si tienes preguntas favor de responder a este correo (mamasypapaseneducaccion@fundaciontelevisa.org) O llamar al: (55) 5261-3277 con Yolanda Gudiño.
</p>
EOT;

		$this->blackListInfoCct = array("20PJN0160M", "05EJN0168G");




        }               
}
?>
