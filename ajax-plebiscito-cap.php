<?php
//$fichero="files/AVA_PLE_CA_0010_2994.xml";
$xml2= new SimpleXMLElement($name_file_cap, null, true);
$key=0;
$a=0;

/*array con los nombres claves de los departamentos para el jvector*/
$depto=array();


echo $xml2->count()." Capital";
/*Ciclo para recorrer el XML*/
foreach ($xml2 as $val) {
/*Numero del boletin*/
echo $n_boletin=$xml2->Avance[$key]->Boletin["V"]; echo"<br>";
/*Nombre Departamento*/	
echo $n_depto=$xml2->Avance[$key]->Desc_Departamento["V"]; echo"<br>";
$temp=array();
$temp[$key]=(string)$n_depto;
array_push($depto,$temp[$key]);
/*Nombre de la Capital*/
echo $n_capital=$xml2->Avance[$key]->Desc_Municipio["V"]; echo"<br>";
/*Hora del boletin*/
echo $n_hora=$xml2->Avance[$key]->Hora["V"].":".$xml2->Avance[$key]->Minuto["V"].":".$xml2->Avance[$key]->Seg["V"]; echo"<br>";
/*Fecha Boletin*/
echo $n_fecha=$xml2->Avance[$key]->Dia["V"]."-".$xml2->Avance[$key]->Mes["V"]."-".$xml2->Avance[$key]->Anio["V"]; echo"<br>";
/*Mesas informadas de las instaladas*/
echo $n_mesas=$xml2->Avance[$key]->Mesas_Informadas["V"]." de ".$xml2->Avance[$key]->Mesas_Instaladas["V"]; echo"<br>";
/*Votos contados del potencial de sufragantes*/
echo $n_votos=$xml2->Avance[$key]->Total_Sufragantes["V"]." de ".$xml2->Avance[$key]->Potencial_Sufragantes["V"]; echo"<br>";
/*Votos nulos*/
echo $n_votonulos=$xml2->Avance[$key]->Votos_Nulos["V"]; echo"<br>";
/*Votos no marcados*/
echo $n_nomarcados=$xml2->Avance[$key]->Votos_No_Marcados["V"]; echo"<br>";

/*votos*/
/*SI*/
echo "SI: ".$si=$xml2->Avance[$key]->Detalle_Circunscripcion->lin->Detalle_Partido->lin[0]->Votos["V"]; echo"<br>";
/*NO*/
echo "NO: ".$no=$xml2->Avance[$key]->Detalle_Circunscripcion->lin->Detalle_Partido->lin[1]->Votos["V"]; echo"<br>";

/*ciclo para generar el array con la informacion a mostrar*/

	$nombre=$depto[$key];
	$data_depto[$nombre]=array();
	$data_depto[$nombre]['si']=$si; // Votos por el SI
	$data_depto[$nombre]['no']=$no; // Votos por el No
	$data_depto[$nombre]['data'][0]=$n_capital;// nombre departamento 
	$data_depto[$nombre]['data'][1]=$n_boletin;// numero de boletin
	$data_depto[$nombre]['data'][2]=$n_hora;// Hora de actualizacion
	$data_depto[$nombre]['data'][3]=$n_fecha;// Fecha de actualizacion
	$data_depto[$nombre]['data'][4]=$n_mesas;// Mesas informadas de las Instalas
	$data_depto[$nombre]['data'][5]=$n_votos;// Votos contados del potencial de sufragantes
	$data_depto[$nombre]['data'][6]=$n_votonulos;// Votos nulos
	$data_depto[$nombre]['data'][7]=$n_nomarcados;// Votos no marcados*/

/*Fin ciclo*/
if (++$a==33) break; // no se tiene encuenta el ultimo ya que es un consulado

echo "-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*<br>";
$key++;
}
/*Fin ciclo XML*/


$json_string=json_encode($data_depto);
$file = 'js-vector/data-cap.json';
file_put_contents($file, $json_string);
echo "<pre>";
//print_r($depto);
print_r($json_string);
echo "</pre>";
