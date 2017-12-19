<!--<meta http-equiv="refresh" content="60; url=http://localhost/plebiscito/curl.php">-->

<?php 
//header( "refresh:125; url=http://localhost/plebiscito/curl.php" ); 
/*Automatizado de la descarga de los ficheros xml*/
$url="https://descargas2016.registraduria.gov.co/c99descargas/DEPLINDEX.xml";

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, "prensa50c4:eive4Oot");
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

$output = curl_exec($ch); // datos de los xml
$info = curl_getinfo($ch); // Informacion http de la pagina
curl_close($ch); // se cierra la conexi
$oXML = new SimpleXMLElement($output); // lectura del los datos
$url_re="https://descargas2016.registraduria.gov.co/c99descargas/";

/*nombre del fichero de consolidado Nacional*/
$colm=explode('/', $oXML->URL_Fichero_COLOMBIA);
$n_nac=$url_re.$colm[2]."/".$colm[3];
$destino_nac="files/comprimidos/nac-zip/".$colm[3];
recibe_zip($n_nac,$destino_nac);
$cnt=mb_strlen($colm[3]);$file_nac=substr($colm[3], 0,$cnt-3);
descomprimir("files/comprimidos/nac-zip/".$colm[3], "files/xml/nac-xml/".$file_nac);

/*nombre del fichero de consolidado Departamental*/
$depto=explode('/', $oXML->URL_Fichero_DEPARTAMENTOS);
$n_depto=$url_re.$depto[2]."/".$depto[3];
$destino_depto="files/comprimidos/dep-zip/".$depto[3];
recibe_zip($n_depto,$destino_depto);
$cnt=mb_strlen($depto[3]);$file_depto=substr($depto[3], 0,$cnt-3);
descomprimir("files/comprimidos/dep-zip/".$depto[3],  "files/xml/dep-xml/".$file_depto);

/*nombre del fichero de consolidado Para capitales*/
$capt=explode('/', $oXML->URL_Fichero_CAPITALES);
$n_capt=$url_re.$capt[2]."/".$capt[3];
$destino_capt="files/comprimidos/cap-zip/".$capt[3];
recibe_zip($n_capt,$destino_capt);
$cnt=mb_strlen($capt[3]);$file_cap=substr($capt[3], 0,$cnt-3);
descomprimir("files/comprimidos/cap-zip/".$capt[3], "files/xml/cap-xml/".$file_cap);


/*funcion para descargar los comprimidos de consolidado*/
function recibe_zip ($url_origen,$archivo_destino){ 
	if (!file_exists($archivo_destino)) 
	{
		$ch = curl_init ();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_USERPWD, "prensa50c4:eive4Oot");
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		$fs_archivo = fopen ($archivo_destino, "wb"); 
		curl_setopt ($ch, CURLOPT_FILE, $fs_archivo); 
		curl_setopt ($ch, CURLOPT_HEADER, 0); 
		curl_setopt ($ch, CURLOPT_URL, $url_origen);
		curl_exec ($ch); 
		curl_close ($ch); 
		fclose ($fs_archivo); 
		chmod($archivo_destino, 0777); 
		print "zip de cosolidados descargado: ".$archivo_destino."<br>";

		/*Descomprimir archivo*/

	}
	else
	{
		print "Zip existente".$archivo_destino."<br>";
	}
}

/*funcion para descomprimir los consolidados*/
function descomprimir($origen, $destino) {
	if (!file_exists($destino)) 
	{
	  $string = implode("", gzfile($origen));
	  $fp = fopen($destino, "w");
	  fwrite($fp, $string, strlen($string));
	  fclose($fp);
	  chmod($destino, 0777); 
	  print $destino."<br>";
	}
	else
	{
		print "Xml existente: ".$destino."<br>";
	}


}


/*generar json de los consolidados */

/*Json para consolidados por departamentos*/
$name_file_depto="files/xml/dep-xml/".$file_depto;
require_once('ajax-plebiscito-depto.php');


/*Json para consolidados por capitales*/
$name_file_cap="files/xml/cap-xml/".$file_cap;
require_once('ajax-plebiscito-cap.php');

/*Json para consolidado nacional*/
$name_file_nac="files/xml/nac-xml/".$file_nac;
require_once('ajax-plebiscito-nac.php');










