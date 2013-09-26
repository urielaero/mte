<?php
$host = '***REMOVED***';
$user = '***REMOVED***';
$pwd = '***REMOVED***'; 
$db = '***REMOVED***';
$conn = new mysqli($host,$user,$pwd,$db);
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

/*This will rank the schools at the entidad level */

$niveles = array(12,13,22);
$grados = array(4,3,0);
$conn->query('UPDATE escuelas SET rank_nacional = NULL WHERE 1');
foreach($niveles as $i => $nivel){
	$grado = $grados[$i];
	$sql = "SET @rownum = 0, @rank = 0, @prev_val = NULL; ";
	$conn->query($sql);
	echo $sql.'<br/>';
	$sql = "UPDATE escuelas t1
			JOIN (
			SELECT @rownum := @rownum + 1 AS row,
			@rank := IF(@prev_val!=promedio_general,@rownum,@rank) AS rank,
			@prev_val := promedio_general AS promedio_general,
			cct
			FROM escuelas
			WHERE nivel = '$nivel' AND `promedio_general` IS NOT NULL AND total_evaluados >= 0 AND poco_confiables<.1*total_evaluados AND grados >= $grado
			ORDER BY promedio_general DESC) t2
			ON t1.cct=t2.cct
			SET t1.rank_nacional=t2.rank;";
	if(!$conn->query($sql)){
		echo "Table creation failed: (" . $conn->errno . ") " . $conn->error;
	}
	echo $sql.'<br/>';
}

$conn->close();

?>