<?php
$host = '***REMOVED***';
$user = 'root';
$pwd = ''; /* Put your password here */
$db = 'comparatuescuela';

$conn = new mysqli($host,$user,$pwd,$db);

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

/*This will rank the schools at the entidad level */

$entidades = range(1,32);
//$niveles = array(12,13,22);

//foreach($niveles as $nivel){

	foreach($entidades as $entidad){
		/*Using bound variables for efficiency
		$stmt = $conn->stmt_init();
		$stmt->prepare($query);
		$stmt->bind_param('ii', $nivel, $municipio);
		$stmt->execute();*/
		$sql = "SET @rownum = 0, @rank = 0, @prev_val = NULL; ";
		$conn->query($sql);
		$sql = "UPDATE escuelas t1
				JOIN (
				SELECT @rownum := @rownum + 1 AS row,
				@rank := IF(@prev_val!=promedio_general,@rownum,@rank) AS rank,
				@prev_val := promedio_general AS promedio_general,
				cct
				FROM escuelas
				WHERE nivel = 12 AND entidad LIKE '$entidad' AND `promedio_general` IS NOT NULL AND total_evaluados > 4 and poco_confiables<=.1*total_evaluados
				ORDER BY promedio_general DESC) t2
				ON t1.cct=t2.cct
				SET t1.rank_entidad=t2.rank;";
		if(!$conn->query($sql)){
			echo "Table creation failed: (" . $conn->errno . ") " . $conn->error;
		}
	}
}

$conn->close();

?>