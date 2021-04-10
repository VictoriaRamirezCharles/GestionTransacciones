<?php
require_once './services/IServiceBase.php';
require_once './layout/layout.php';
require_once './helpers/utilities.php';
require_once './transacciones/transaccion.php';
require_once './helpers/FileHandler/IFileHandler.php';
require_once './helpers/FileHandler/JsonFileHandler.php';
require_once './helpers/FileHandler/SerializationFileHandler.php';
require_once './helpers/FileHandler/CSVFileHandler.php';
require_once './transacciones/TransaccionServiceFile.php';
require_once './transacciones/log.php';

$utilities = new Utilities();
$layout = new Layout(false);
$service = new TransaccionServiceFile('./transacciones/data');


$transacciones = $service->GetList();

?>

<?php $layout->printHeader();?>

<div class="container">
    
    <div class="text-right margin-arriba-3">
        <a href="transacciones/add.php" class="btn btn-success">Nueva Transacción</a>
        <a href="transacciones/import.php" class="btn btn-warning">Importar transacciones</a>
        <!-- <a href="transacciones/export.php" class="btn btn-dark">Exportar CSV</a> -->
    </div>
    <hr>
    <div class="table-container">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Id</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Monto</th>
                    <th>Descripcion</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>

                <?php if(empty($transacciones)):?>
                <tr>
                    <td colspan="3">
                        <h3>No existen transacciones registradas</h3>
                    </td>
                </tr>
                <?php else: ?>

                <?php foreach ($transacciones as $transaccion):?>
                <tr>
                    <th><?php echo $transaccion->id; ?></th>
                    <td><?php echo $transaccion->date; ?></td>
                    <td><?php echo $transaccion->time; ?></td>
                    <td><?php echo $transaccion->monto; ?></td>
                    <td><?php echo $transaccion->description; ?></td>
                    <td>
                       
                        <a href="transacciones/edit.php?id=<?php echo $transaccion->id; ?>"class="btn btn-info btn-sm">Editar</a>

                        <a data-id="<?= $transaccion->id ?>" href="transacciones/delete.php?id=<?php echo $transaccion->id; ?>"class="btn btn-danger btn-sm btn-delete">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach?>

                <?php endif ?>
            </tbody>
        </table>
    </div>
</div>


<?php $layout->printFooter()?>

<script>
$(document).ready(function(){

$(".btn-delete").on("click",function(){
 
 let id = $(this).data("id");

 if(confirm("Esta seguro que desea eliminar esta transaccion?")){

     if(id !== null && id !== undefined && id !== "" ){
         window.location.href = "transaciones/delete.php?id=" + id;            
     }        

 }
 
});
 


});
</script>