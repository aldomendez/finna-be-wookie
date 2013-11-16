<?php 
include "../inc/database.php";
// Arrego con los nombres de las bases de datos que se usaran para contruir
// las llamadas 
$databases = array(
	"MxOptix"	=> 'MxOptix',
	"Prod_Mx"	=> 'Prod',
	"MxApps"	=> 'MxApps',
	"prod.world"=> 'Prod_ilm',
	"SAP"=> 'SAP'
);

if (isset($_POST['action']) && $_POST['action'] !== '') {
	if (function_exists($_POST['action'])) {
		try {
			$_POST['action']();
		} catch (Exception $e) {
			echo '{"error":true,"desc":"Exception in:Post: [' . $_POST['action'] . '] with message: ' . $e->getMessage() . '"}';
		}
	} else {
		echo "Funcion No existe";
	}
}
if (isset($_GET['action']) && $_GET['action'] !== '') {
	if (function_exists($_GET['action'])) {
		try {
			$_GET['action']();
		} catch (Exception $e) {
			echo '{"error":true,"desc":"Exception in: Get:[' . $_GET['action'] . '] with message: ' . $e->getMessage() . '"}';
		}
	} else {
		echo "Funcion No existe";
	}
}


function query()
{
	global $databases;
	$query = $_POST['data'];
	$DB = new $databases[$_POST['database']]();
	$DB->query($query);
	echo $DB->tabla();
}

function save()
{
	if (!isset($_POST['name'])) {throw new Exception("No [name] parameter in POST request", 1);}
	if (!isset($_POST['dbName'])) {throw new Exception("No [dbName] parameter in POST request", 1);}
	if (!isset($_POST['query'])) {throw new Exception("No [query] parameter in POST request", 1);}
	if (!isset($_POST['storeDate'])) {throw new Exception("No [storeDate] parameter in POST request", 1);}
	if (!isset($_POST['queryName'])) {throw new Exception("No [queryName] parameter in POST request", 1);}

	$name = "./saved/" . $_POST['id'] . '.json';
	if (file_exists($name)) {
		throw new Exception("File Already Exist.", 1);
	}
	$datos = array(
		'database' => $_POST['dbName'], 
		'query' => $_POST['query'],
		'id' => $_POST['id'],
		'storeDate' => $_POST['storeDate'],
		'queryName' => $_POST['queryName']
		);
	file_put_contents($name, json_encode($datos));
	echo file_get_contents($name);
}

function delete()
{
	if (!isset($_GET['query_id'])) {throw new Exception("No parameter [query_id] in GET request", 1);}
	$name = "./saved/" . $_GET['query_id'] .'.json';
	$id = $_GET['query_id'];
	if (is_readable($name)) {
		if (unlink($name)) {
			$response = array('error' => 'false','desc'=>"Archivo [$id] borrado" );
		} else {
			$response = array('error' => 'true','desc'=>"Archivo [$id] no fue borrado" );
		}
	} else {
		$response = array('error' => 'true','desc'=>"Archivo [$id] no es accesible" );
	}
	echo json_encode($response)	;
}

function verify($data, $rule)
{
	// Evalua el valor dado con la funcion de evaluacion
	// Paramatros
	// @data [string, array] 	valor a evaluar
	// @rule [array] 			nombre de la funcion de evaluacion
	// 
	// @returns true or false
	$rules = array('isset' => '__isset');

	// Verifica que $data sea array
	// Verifica que $data sea string
	// Verifica que $rule sea array
	// Realiza la verificacion y retorna true o false

	// Me gustaria que hiciera un MAP,REDUCE,
	// pero no tengo idea de como implementarlo aun
}

function __isset($data)
{

}

function getFiles()
{
	$dir = './saved/';
	$output = array();
	if (is_dir($dir)) {
		if ($dh = opendir($dir)) {
			while (($file = readdir($dh)) !== false) {
				if ($file != '.' && $file != '..' && strpos($file, '.json') != false) {
					$name = __getQueryName($file);
					array_push($output, array('name'=>$name,'id'=>$file));	
					// array_push($output, $file);
				}
			}
			closedir($dh);
			echo json_encode($output);
		} else {
			throw new Exception("No se puede abrir el directorio: $dir", 1);
			
		}
	} else {
		throw new Exception("No existe el directorio; $dir", 1);
	}
}

function getQuery(){
	echo json_encode(__getQuery());
}

function __getQuery($file='')
{
	// echo($file);
	$BaseDir = './saved/';

	if ($file == '') {
		if (isset($_POST['file']) && $_POST['file'] != '') {
			$file = $_POST['file'];
		} else {
			throw new Exception("[__getQuery]: No [name] parameter in POST request", 1);
		}
	}
	
	if (!strpos($file, '.json')) { // Si no tiene extension JSON hay que ponersela
		$file = $file . '.json';
	}
	if (file_exists($BaseDir . $file)) {
		return json_decode(file_get_contents($BaseDir . $file), true);
	} else {
		throw new Exception("No existe el archivo", 1);
	}
	// Si llega hasta aqui quiere decir que hay algo que no prevei,
	// y que no figura en la logica del programa
	throw new Exception("MethodEndedUnexpectedly: file='$file'", 1);
}

function __getQueryName($file)
{
	// echo($file);
	$queryData = __getQuery($file);
	return $queryData['queryName'];
}

function getQueryName($file='')
{
	$queryData = getQuery($file);
	echo $queryData['queryName'];
}

function getQueryId($file='')
{
	$queryData = getQuery($file);
	echo $queryData['queryName'];
}