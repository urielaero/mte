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
                //Security
                $this->secured = false;

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
                $this->semaforos = array('Reprobado','De panzazo','Bien','Excelente','No toma la <br /> prueba <br />ENLACE','Poco confiable','Esta escuela no toma la prueba ENLACE para todos los años','La prueba ENLACE no esta disponible para este nivel escolar','No aplica');
                $this->semaforos2 = '[
                    {
                        "label" : "Reprobado",
                        "icon" : "icon-check-01",
                        "class" : "rank1",
                    },
                    {
                        "label" : "De panzazo",
                        "icon" : "icon-check-01",
                        "class" : "rank2",
                    },
                    {
                        "label" : "Bien",
                        "icon" : "icon-check-01",
                        "class" : "rank3",
                    },
                    {
                        "label" : "Excelente",
                        "icon" : "icon-check-01",
                        "class" : "rank4",
                    },
                    {
                        "label" : "No toma la <br /> prueba <br />ENLACE",
                        "icon" : "icon-check-01",
                        "class" : "rank5",
                    },
                    {
                        "label" : "Poco confiable",
                        "icon" : "icon-check-01",
                        "class" : "rank6",
                    },
                    {
                        "label" : "Esta escuela no toma la prueba ENLACE para todos los años",
                        "icon" : "icon-check-01",
                        "class" : "rank7",
                    },
                    {
                        "label" : "La prueba ENLACE no esta disponible para este nivel escolar",
                        "icon" : "icon-check-01",
                        "class" : "rank8",
                    },
                    {
                        "label" : "No aplica",
                        "icon" : "icon-check-01",
                        "class" : "rank9",
                    }
                ]';
        }

                
               
}
?>
