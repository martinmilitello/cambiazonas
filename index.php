<!doctype html>
<html lang="en">
  <head>
    <title>Separa Zonas</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap44\css\bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome515/css/all.css">
    <link rel="stylesheet" href="css/esperar.css">
<style>
    .my-custom-scrollbar {
    position: relative;
    height: 300px;
    overflow: auto;
    }
    .table-wrapper-scroll-y {
    display: block;
    }

    .btn-file {
  position: relative;
  overflow: hidden;
}
.btn-file input[type=file] {
  position: absolute;
  top: 0;
  right: 0;
  min-width: 100%;
  min-height: 100%;
  font-size: 100px;
  text-align: right;
  filter: alpha(opacity=0);
  opacity: 0;
  outline: none;
  background: white;
  cursor: inherit;
  display: block;
}
</style>


  </head>
  <body class="bg-primary">



  <div class="container">

        <div class="container p-3 my-4 shadow bg-primary text-white rounded">
                   
            <div class="row h-100 justify-content-center">
            
                <div class="col-md-1">
                    <div class="container shadow bg-primary rounded">
                        
                        <span> <i class="fas fa-toolbox fa-3x" style="color:red" > </i></span>
                    </div>
                </div>
               
                    <div class="col-md-10">
                       
                            <h3>Divide Zonas (221/223, 022/023, 703/704) En archivos TXT o CSV</h3>
                       
                    </div>
              
            
                <div class="col-md-1">
                    <div class="container shadow bg-primary rounded">
                        <div class="top-bg"></div>
                        
                    </div>
                    
                </div>
            </div>
        </div>

      <div class="row">
           

            <div class="col-md-6">
                <div class="container p-3 shadow bg-primary text-white rounded">
                <div class="d-flex justify-content-center">
                    <h4>Procesos de Python</h4>
                </div>
                    <div id = "contenedor_carga">
                        <div id="carga"></div>
                    </div>
                    <form>
                        <div class="form-group ">
                        <label for="fecha">Ingrese la fecha:</label>
                        <input type="text" class="form-control" id="fecha" placeholder="20210508"aria-describedby="FechaHelp" >
                        </div>
                    
                        <div class="form-group">
                            <label for="hora">Ingrese la Hora:</label>
                            <input type="text" class="form-control" id="hora" placeholder="030512"aria-describedby="HoraHelp">
                        </div>
                    
                        <div class="form-group">
                            <label for="zona">Zona (Solo para CSV):</label>
                            <input type="text" class="form-control" id="zona" value="703" aria-describedby="rutaHelp">
                            <small id="passHelp" class="form-text text-muted"></small>
                        </div>

                        <div class="form-group">
                            <label for="rutaped">Ruta o Path Cabecera y Detalle:</label>
                            <input type="text" class="form-control" id="rutaped" value ="/SUBIDAS/"aria-describedby="rutaHelp" readonly>
                            <small id="passHelp" class="form-text text-muted"></small>
                        </div>
                            <div class="d-flex justify-content-around">
                                <button id="btnejecutar" type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Los archivos son dejados en INTPEDIDOS">Ejecutar proceso TXT</button>
                                <button id="btnejecsv" type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Deben subirse los 3 archivos CSV a la Carpeta SUBIDAS, Los archivos procesados quedarán en esta misma carpeta ">Ejecutar Proceso CSV</button>
                            </div>
                           
                        
                        <div>
                            <h5><p id = "pyshow"></p></h5>
                            <h5><p id = "pyalert"></p></h5>
                        </div>
                    
                    </form>
                </div>
              </div>

              <div class="col-md-6">

                <div class="container shadow p-3 bg-primary text-white rounded">
                        <div class="d-flex justify-content-start">
                            <h4>Cargar Archivos</h4>
                        </div>
        
                                <div class="d-flex justify-content-center">
                                    <form method="POST" action="#" enctype="multipart/form-data">
                                        
                                            <label class="btn btn-warning"><i class="fa fa-upload"></i>
                                            </label>
                                                <label class="btn btn-dark btn-file"> 
                                                    Seleccione un archivo para subir a la carpeta /subidas/:
                                                    
                                                    <input  type="file" class="form-control-file" name="file1"  id="file1" onchange="ver();">
                                                    <h4><p id = "muestraarchivo"></p></h4>
                                                </label>
                                                <label class="btn btn-warning"><i class="fa fa-upload"></i>
                                            </label>
                                    
                                
                                        <div class="d-flex justify-content-center">
                                            <button class="btn btn-success" id = "btn_subir" type="submit" data-toggle="tooltip" data-placement="top" title="Sube a la carpeta SUBIDAS, Archivos: demapas.txt, demapas.csv, qzobuscar, cliente.csv, cabecera.csv, detalle.csv">Subir Archivo</button>
                                        </div>
                                    </form>
                                </div>
                    </div> <!-- container shadow  -->

                   
                    <div class="container shadow p-3 bg-primary text-white rounded">
                            <h4>Descargas Disponibles</h4>
                            <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                <table class="table table-success table-bordered" style='color: black'>
                                    <thead>
                                        <tr>
                                        <th width="7%">#</th>
                                        <th width="70%">Nombre del Archivo</th>
                                        <th width="13%">Descargar</th>
                                        <th width="10%">Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $archivos = scandir("subidas");
                                        $num=0;
                                        for ($i=2; $i<count($archivos); $i++)
                                        {$num++;
                                        ?>
                                        <p>     </p>
                                
                                        <tr class="table-primary" style='color:black'>
                                            <th scope="row"><?php echo $num;?></th>
                                            <td><?php echo $archivos[$i]; ?></td>
                                            <td><a title="Descargar Archivo" href="subidas/<?php echo $archivos[$i]; ?>" download="<?php echo $archivos[$i]; ?>" style="color: blue; font-size:18px;"> <span class="fas fa-download" aria-hidden="true"></span> </a></td>
                                            <td><a title="Eliminar Archivo" href="Eliminar.php?name=subidas/<?php echo $archivos[$i]; ?>" style="color: red; font-size:18px;" onclick="return confirm('Esta seguro de eliminar el archivo?');"> <span class="fas fa-trash-alt" aria-hidden="true"></span> </a></td>
                                        </tr>

                                        <?php }?> 

                                    </tbody>
                                </table>
                            </div> <!-- table-wrapper-scroll  -->


                    </div> <!-- container shadow  -->
    
              </div>
                  
        </div>
 
</div>
 
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="bootstrap44\js\jquery36.js"></script>
    <script src="bootstrap44\js\popper.js"></script>
    <script src="bootstrap44\js\bootstrap.min.js"></script>
    

    <script>
        $(document).ready(function($){
            var e=this;

            $('[data-toggle="tooltip"]').tooltip();
           
            $('#contenedor_carga').hide();

            $('#btnejecutar').on('click', function(){
                   
                var fecha = $("#fecha").val();
                var hora = $("#hora").val();
                var rutacli = $("#rutacli").val();
                var rutaped = $("#rutaped").val();

                $('#contenedor_carga').show();
                // alert('Boton Ejecutar: '+fecha+';'+hora+';'+rutacli+';'+rutaped);

                  $.ajax
                      ({
                          type:'POST',
                          data:{fecha:fecha,hora:hora} , 
                          url:"eje_python.php", 
                          success: function(result){

                            $('#pyalert').show();
                            
                            $('#pyshow').html(result);
                          
                          }
                     
                  });

                  $('#pyshow').bind('DOMSubtreeModified', function(){
                             $('#contenedor_carga').hide();
                  });
                  $('#pyalert').bind('DOMSubtreeModified', function(){
                             $('#contenedor_carga').hide();
                  });
                              

              });

              $('#btnejecsv').on('click', function(e){
                    e.preventDefault();
                    var fecha = $("#fecha").val();
                    var hora = $("#hora").val();
                    var zona = $("#zona").val();
                    var rutaped = $("#rutaped").val();

                    $.ajax
                      ({
                          type:'POST',
                          data:{fecha:fecha,hora:hora,zona:zona} , 
                          url:"eje_pythoncsv.php", 
                          success: function(result){

                            $('#pyalert').show();
                            
                            $('#pyshow').html(result);

                            location.reload();
                          
                          }
                     
                  });

              });

              $('#btn_subir').on('click', function(e){
                e.preventDefault();
                var formData = new FormData();
                var file_data  = $("#file1").prop("files")[0];
                formData.append('file',file_data );
                // alert(formData);
                $.ajax({
                    url: 'cargararchivos.php',
                    type: 'post',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response != 0) {
                            $('#pyalert').show();
                            
                            $('#pyshow').html(result);

                            alert('Archivo subido con éxito!!!')

                            location.reload();
                        } else {
                            alert('Formato incorrecto');
                        }
                    }
                });
                return false;
                
              });

        })

        function ver(){
           
            result = document.getElementById('file1').value;
            nombrearchivo = result.substr(12,50);
            alert(nombrearchivo);
            $('#muestraarchivo').html(nombrearchivo);
        }


    </script>
  </body>
</html>