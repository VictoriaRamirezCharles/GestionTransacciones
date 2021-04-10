<?php
require_once '../helpers/utilities.php';
require_once './transaccion.php';
require_once '../services/IServiceBase.php';
require_once '../helpers/FileHandler/IFileHandler.php';
require_once '../helpers/FileHandler/JsonFileHandler.php';
require_once '../helpers/FileHandler/SerializationFileHandler.php';
require_once '../helpers/FileHandler/CSVFileHandler.php';
require_once './TransaccionServiceFile.php';
require_once './log.php';

$service = new TransaccionServiceFile();

$array = $service->getDirtyList();
array_unshift($array,array_keys((array) $array[0]));
if (!file_exists("../Descargas")) 
{
    mkdir("../Descargas",0777, true);
}
$file = fopen("../Descargas/transacciones.csv","w");
foreach ($array as $element)
 {
    fputcsv($file,(array) $element);
}
fclose($file);


header('Content-type: text/json');


header('Content-Disposition: attachment; filename="transacciones.csv"');

readfile('../Descargas/transacciones.csv');

?>