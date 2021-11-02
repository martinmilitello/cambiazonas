<!doctype html>
<html lang="en">
  <head>
    <title>DivideZonas</title>
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
</style>


  </head>
  <body class="bg-primary">



  <div class="container">

        <div class="container p-5 my-4 bg-primary text-white rounded">
                   
            <div class="row h-100 justify-content-center">
            
                <div class="col-md-1">
                    <div class="top-bg"></div>
                    <span class="fas fa-toolbox fa-3x"></span>
                </div>
            
                <div class="col-md-10">
                    <h1>Divide Zonas (221/223, 022/023, 703/704)</h1>
                </div>
            
                <div class="col-md-1">
                    <div class="top-bg"></div>
                </div>
            </div>
        </div>

      <div class="row">
           

            <div class="col-md-6">
                <div class="container p-3 shadow bg-primary text-white rounded">
                    
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
                            <label for="rutacli">Ruta o Path Cliente:</label>
                            <input type="text" class="form-control" id="rutacli" value="//dc10004/InterfacesSAP/VENTASCLI/BACKUP/" aria-describedby="rutaHelp" readonly>
                            <small id="passHelp" class="form-text text-muted"></small>
                        </div>

                        <div class="form-group">
                            <label for="rutaped">Ruta o Path Cabecera y Detalle:</label>
                            <input type="text" class="form-control" id="rutaped" value ="//dc10004/InterfacesSAP/INTPEDIDOS/BACKUP/"aria-describedby="rutaHelp" readonly>
                            <small id="passHelp" class="form-text text-muted"></small>
                        </div>
                            <div class="d-flex justify-content-center">
                                <button id="btnejecutar" type="button" class="btn btn-success">Ejecutar proceso</button>
                            </div>
                        
                        <div>
                            <h5><p id = "pyshow"></p></h5>
                            <h5><p id = "pyalert"></p></h5>
                        </div>
                    
                    </form>
                </div>
              </div>
              <div class="col-md-6">

                    <div class="container shadow p-5 bg-primary text-white rounded">
                        <h6>Subir archivo de revendedoras proporcionado por Mapas </h6>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-info" id="inputGroupFileAddon01"><i class="fa fa-upload"></i></span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="nombrearchivo"
                                aria-describedby="inputGroupFileAddon01">
                                <label class="custom-file-label" for="customFile" id= "archivoselec">Seleccione un archivo</label>
                            </div>
                        </div>
                    </div>

                    <div class="container shadow p-3  bg-primary text-white rounded">
                    
                        <div class="d-flex justify-content-center">
                        
                            <button type="submit" class="btn btn-success" id= "btnsuberev" style="border: 1px solid #00ff00;">Subir archivo</button>
                        
                        </div>
                        <div>
                            <p id = "show1"></p>
                            <p id = "alert1"></p>
                        </div>
                    </div>
                    
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

              $('#nombrearchivo').change(function() {

                  var filename = $('#nombrearchivo').val();
                  filename = filename.substring(filename.lastIndexOf("\\") + 1, filename.length);
                  $('#archivoselec').text(filename);
                   alert(filename);
              });

              $('#btnsuberev').on('click', function(e){
                    e.preventDefault();
                    var inputfiletxt = document.getElementById("nombrearchivo");
                    var file = inputfiletxt.files[0];
                    var data = new FormData();
                    var nombretabla = '';

                    data.append('nombrearchivo',file);
                    console.log(data);
                    var request = $.ajax({
                            url: 'subirarchivo.php',
                            method: 'post',
                            data: data,
                            contentType: false,       
                            cache: false,            
                            processData:false        
                        });
                        request.done(function(response){
                            $('#show1').show();
                            $('#show1').html(response);

                        });


              });

        })



    </script>
  </body>
</html>