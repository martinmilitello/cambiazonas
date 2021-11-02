<?php

$pathcli = "C:/python/";//"//dc10004/InterfacesSAP/VENTASCLI/BACKUP/";
$pathpos = "C:/python/";//"//dc10004/InterfacesSAP/INTPEDIDOS/BACKUP/";


if (isset($_POST['fecha'])  &&  isset($_POST['hora'])){
           $fecha = $_POST['fecha'];
           $hora = $_POST['hora'];
           $zona = $_POST['zona'];
        
           // var_dump($_POST['hora']);
          //  var_dump($_POST['fecha']);
         //  $outsolo = "python separar221.py ".$fecha." ".$hora." ".$pathpos." ".$pathcli;
           
           $output = shell_exec("python dividecsv.py ".$fecha." ".$hora." ".$zona);

           
                   
           // Display output python
           if($output == ""){
              //  echo "<pre>$output</pre>"; 
             
               echo " <div class='alert alert-success alert-dismissible' role='alert'>
                           <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                           <strong>Aviso!</strong> <p>Se ha dividido el archivo CSV correctamente!!".$output."</p>";
           }
           else {
                  echo "<div class='alert alert-danger alert-dismissible' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                        <strong>Error!</strong>".$output.":".$fecha."-".$hora.",".$zona."</p>";
           }
}
else{
           echo "No llego la variable ";
}
      
      
      

?>