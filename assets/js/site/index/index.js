  
$(document).ready(function(){

    $(".btn-delete").on("click",function(){
     debugger
     let id = $(this).data("id");
 
     if(confirm("Esta seguro que desea eliminar a este estudiante?")){
 
         if(id !== null && id !== undefined && id !== "" ){
             window.location.href = "estudiantes/delete.php?id=" + id;            
         }        
 
     }
     
    });
     
    
 
 })