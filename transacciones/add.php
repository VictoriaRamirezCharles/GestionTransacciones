<?php

require_once '../layout/layout.php';
require_once '../helpers/utilities.php';
require_once './transaccion.php';
require_once '../services/IServiceBase.php';
require_once '../helpers/FileHandler/IFileHandler.php';
require_once '../helpers/FileHandler/JsonFileHandler.php';
require_once '../helpers/FileHandler/SerializationFileHandler.php';
require_once '../helpers/FileHandler/CSVFileHandler.php';
require_once './TransaccionServiceFile.php';
require_once './log.php';

$layout = new Layout(true);

$service = new TransaccionServiceFile();
$utilities = new Utilities();



if (isset($_POST['monto']) && isset($_POST['description'])) {

    $date = $utilities->getCurrentDateTime('Y-m-d');
    $time = $utilities->getCurrentDateTime('H:i:s'); 


    $transaccion = new Transaccion();
    $transaccion->InitializeData(0, $_POST['monto'], $_POST['description'], $date, $time );

    $service->Add($transaccion);

    header('Location: ../index.php'); 
    exit();
}

?>

<?php $layout->printHeader();?>

<main role="main">
<div class="row margin-arriba-3 " id="formulario">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-dark text-light">
                Nueva Transaccion
            </div>
            <div class="card-body">
                <form  action="add.php" method="POST">
                    <div class="form-group">
                        <label for="monto">Monto: </label>
                        <input type="text" class="form-control" id="monto" name="monto" >
                    </div>
                
                    <div class="form-group">
                        <label for="apellido">Descripcion: </label>
                        
                        <textarea class="form-control"  rows="3" name="description"></textarea>
                    </div>

                    <div class="text-right">
                        <button class="btn btn-success" type="submit">Guardar</button>
                    </div>
                </form>                              
            </div>
        </div>
    </div>
</div>
</main>
<?php $layout->printFooter()?>