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


if (isset($_FILES['transaccionFile']) && $_FILES["transaccionFile"]["error"] == 0) {

    

    $file = $_FILES['transaccionFile'];
    $transaccionesImported = array();
    $transaccionesImported = $service->Import($file);

    
    if(!empty($transaccionesImported)){

        foreach ($transaccionesImported as $transaccionImported) {

            $service->Add($transaccionImported);

        }

    }

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
               Importar
            </div>
            <div class="card-body">
                <form  method="POST" action="import.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                    <input class="file-input" type="file" name="transaccionFile"
                            accept="application/json, text/plain, application/vnd.ms-excel,.csv" id="import">
                    </div>
                
                   

                    <div class="text-right">
                        <button class="btn btn-success" type="submit">Importar</button>
                    </div>
                </form>                              
            </div>
        </div>
    </div>
</div>
</main>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function (e) {

        $inputFile = document.getElementById('import');
        $fileName = document.querySelector('.file-name');

        $inputFile.addEventListener('change', function () {

            var fileName = this.value.split('\\').pop();
            $fileName.innerText = fileName;

        })

    })
</script>
<?php $layout->printFooter()?>