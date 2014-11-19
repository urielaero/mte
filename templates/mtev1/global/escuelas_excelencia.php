<?php  if( $this->escuela->ganador_disena_el_cambio){ ?>
	<a href='' target='' class="escuelas_excelencia">
		<span class="close"></span>
		<img src="http://3903b795d5baf43f41af-5a4e2dc33f4d93e681c3d4c060607d64.r40.cf1.rackcdn.com/disenaelcambio.png">
	</a>
<?php } elseif(isset($this->escuela->programas['escuelas_de_excelencia'])){ ?>
	<a href='http://blog.mejoratuescuela.org/programa-escuelas-de-excelencia-para-abatir-el-rezago-educativo/' target='_blank' class="escuelas_excelencia">
		<span class="close"></span>
		<img src="http://3903b795d5baf43f41af-5a4e2dc33f4d93e681c3d4c060607d64.r40.cf1.rackcdn.com/mte2.png">
	</a>
<?php } ?>