<?php
ob_start();
session_start();


require_once('../vistas/pagina_inicio_vista.php');
require_once('../clases/funcion_bitacora.php');
require_once('../clases/funcion_visualizar.php');
require_once('../clases/funcion_permisos.php');
require_once('../clases/conexion_mantenimientos.php');
//$registro = controlador_registro_docente::ctrRegistro();
$Id_objeto = 50;








$visualizacion = permiso_ver($Id_objeto);


if ($visualizacion == 0) {
  echo '<script type="text/javascript">
                              swal({
                                   title:"",
                                   text:"Lo sentimos no tiene permiso de visualizar la pantalla",
                                   type: "error",
                                   showConfirmButton: false,
                                   timer: 3000
                                });
                           window.location = "../vistas/menu_docentes_vista.php";

                            </script>';
} else {

  bitacora::evento_bitacora($Id_objeto, $_SESSION['id_usuario'], 'INGRESO', 'A REGISTRAR DOCENTE.');


  // if (permisos::permiso_insertar($Id_objeto) == '1') {
  //   $_SESSION['btn_guardar_registro_docentes'] = "";
  // } else {
  //   $_SESSION['btn_guardar_registro_docentes'] = "disabled";
  // }
}

ob_end_flush();


?>


<!DOCTYPE html>
<html>

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

  <title></title>


</head>

<body>
  <form action="" method="POST" id="Formulario" class="FormularioAjax" name="miFormulario" autocomplete="off" role="form" enctype="multipart/form-data">

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">

        <div class="container-fluid">

          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Registro Docentes</h1>
            </div>



            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="../vistas/pagina_principal_vista.php">Inicio</a></li>
                <li class="breadcrumb-item"><a href="../vistas/gestion_docentes_vista.php">Gestión Docente</a></li>

              </ol>
            </div>



          </div>
        </div><!-- /.container-fluid -->
      </section>

      <section>

        <input type="text" name="mayoria_edad" id="mayoria_edad" readonly onload="mayoria_edad()">

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <!-- pantalla  -->

            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">DATOS PERSONALES </h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>

                </div>

              </div>
              <!-- /.card-header -->
              <!--empieza -->

              <!-- /.card-body -->
              <div class="card-body" style="display: block;">
                <div class="row">

                  <div class="col-sm-12" style="text-align: center">
                    <div class="col-sm-2" style="left: 560px;">


                      <!--FOTOGRAFIA -->
                      <!-- <label>Foto</label> -->
                      <img src="../Imagenes_Perfil_Docente/default-avatar.png" class="brand-image img-circle elevation-3" id="mostrarimagen" height="175" width="175">
                      <input class="form-control-file" type="file" accept="image/x-png,image/gif,image/jpeg" id="seleccionararchivo" name="seleccionararchivo" required><br><br>


                    </div>
                  </div>
                  <!--  <div class="col-sm-12">


                  <hr >

                </div> -->



                  <div class="col-sm-3">
                    <div class="form-group">
                      <!-- NOMBRES -->

                      <label>Nombres </label>

                      <input class="form-control" type="text" id="txt_nombres" name="txt_nombres" maxlength="25" value="" style="text-transform: uppercase" onkeyup="DobleEspacio(this, event); MismaLetra('txt_nombres');" onkeypress="return sololetras(event)" required>


                    </div>
                  </div>


                  <div class="col-sm-3">
                    <div class="form-group">
                      <!-- APELLIDOS -->
                      <label>Apellidos </label>

                      <input class="form-control" type="text" id="txt_apellidos" name="txt_apellidos" maxlength="25" value="" required style="text-transform: uppercase" onkeyup="DobleEspacio(this, event); MismaLetra('txt_apellidos');" onkeypress="return sololetras(event)" ;>


                    </div>
                  </div>

                  <div class="col-sm-3">
                    <label for="">Nº Identidad:</label>

                    <div class="form-group">
                      <div class="input-group-prepend">

                        <input name="" type="text" data-inputmask="'mask': '9999-9999-99999'" data-mask class="form-control" id="identidad" required onkeyup="ValidarIdentidad($('#identidad').val());" onblur="ExisteIdentidad();">



                      </div>
                    </div>
                    <p hidden id="TextoIdentidad" style="color:red;">¡Ya existe un registro con esta identidad! </p>

                  </div>


                  <div class="col-sm-3">
                    <div class="form-group">
                      <!-- FECHA DE NACIMIENTO  -->
                      <label>Fecha Nacimiento</label>
                      <input class="form-control" type="date" id="txt_fecha_nacimiento" onblur="valida_mayoria()" name="txt_fecha_nacimiento" required onkeydown="return false">

                    </div>
                    <p hidden id="Textofecha" style="color:red;">¡El docente debe ser mayor de edad! </p>
                  </div>

                  <div class="col-sm-3">
                    <div class="form-group">
                      <!-- NACIONALIDAD -->
                      <label>Nacionalidad</label>
                      <select class="form-control" name="cb_nacionalidad" id="cb_nacionalidad" style="text-transform: uppercase" required>

                      </select>
                    </div>
                  </div>


                  <div class="col-sm-3">
                    <div class="form-group">
                      <!-- ESTADO CIVIL -->
                      <label>Estado civil</label>
                      <select class="form-control" name="cb_ecivil" id="cb_ecivil" style="text-transform: uppercase" required>

                      </select>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <!-- GENERO -->
                      <label>Género</label>
                      <select class="form-control" name="cb_genero" id="cb_genero" style="text-transform: uppercase" required>

                      </select>
                    </div>
                  </div>

                  <div class="col-sm-3">
                    <div class="form-group">
                      <!-- CURRICULUM -->
                      <label>Curriculum</label>
                      <input class="form-control" type="file" accept=".doc, .docx, .pdf" id="curriculum" name="curriculum" value="" required>

                    </div>
                  </div>




                  <!-- /.form-group -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.card-body -->

            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">CONTACTOS Y FORMACIÓN ACADÉMICA</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>

                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <div class="container">
                        <button class="btn btn-primary btn-sm" name="add" id="gcorreotel" data-toggle="modal" data-target="#ModalTask1">Agregar</button>


                        <label for="">Teléfonos</label>

                        <table class="table table-bordered table-striped m-0">
                          <thead>
                            <tr>
                              <th>Teléfono's</th>
                            </tr>
                          </thead>
                          <tbody id="tbData2"></tbody>
                        </table>
                      </div>
                    </div>
                  </div>

                  <div class="modal fade" tabindex="-1" role="dialog" id="ModalTask1">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Datos</h5>
                          <button class="close" data-dismiss="modal">
                            &times;
                          </button>
                        </div>

                        <div class="modal-body">
                          <div class="container">
                            <div class="form-group">
                              <label for="">Teléfono</label>
                              <input type="text" name="tel" id="tel" class="form-control name_list" data-inputmask="'mask': '9999-9999'" data-mask required>

                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button class="btn btn-success" onclick="addTask()">Agregar</button>
                          <button class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        </div>
                      </div>
                    </div>
                  </div>



                  <div class="col-sm-4">
                    <div class="form-group">

                      <!-- TABLA Correos -->
                      <div class="container">
                        <button class="btn btn-primary btn-sm" data-toggle="modal" id="gcorreo" data-target="#ModalTask5">Agregar</button>

                        <label for="">Correos Electrónicos </label>
                        <table class="table table-bordered table-striped m-0">
                          <thead>
                            <tr>
                              <th>Correo</th>
                            </tr>
                          </thead>
                          <tbody id="tbData5"></tbody>
                        </table>
                      </div>
                    </div>
                  </div>

                  <div class="modal fade" tabindex="-1" role="dialog" id="ModalTask5">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Datos</h5>
                          <button class="close" data-dismiss="modal">
                            &times;
                          </button>
                        </div>

                        <div class="modal-body">
                          <div class="container">
                            <div class="form-group">
                              <label for="">Correo Electrónico</label>
                              <input type="email" class="form-control" id="email" name="email" maxlength="30">


                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button class="btn btn-success" id="gcorreo1" onclick="addTask5()">Agregar</button>
                          <button class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-4">
                    <div class="form-group">
                      <!-- TABLA GRADOS ACADEMICOS -->
                      <div class="container">
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalTask">Agregar</button>

                        <label for="">Formación Académica</label>

                        <table class="table table-bordered table-striped m-0">
                          <thead>
                            <tr>
                              <th hidden>#</th>
                              <th>Grado Académico</th>
                              <th>Especialidad</th>
                            </tr>
                          </thead>
                          <tbody id="tbData"></tbody>
                        </table>
                      </div>
                    </div>
                  </div>

                  <div class="modal fade" tabindex="-1" role="dialog" id="ModalTask">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Datos</h5>
                          <button class="close" data-dismiss="modal">
                            &times;
                          </button>
                        </div>

                        <div class="modal-body">
                          <div class="container">
                            <div class="form-group">
                              <label for="">Grado Académico</label>
                              <select class="form-control" name="gacademico" id="gacademico" value="" required style="text-transform: uppercase"></select>
                              <label for="">Especialidad</label>
                              <input class="form-control" type="text" id="especialidad" name="especialidad" maxlength="60" value="" required style="text-transform: uppercase" onkeyup="DobleEspacio(this, event); MismaLetra('especialidad');" onkeypress="return sololetras(event)" ; required>

                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button class="btn btn-success" onclick="addTask2()">Agregar</button>
                          <button class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        </div>
                      </div>
                    </div>
                  </div>



                  <!-- /.form-group -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.card-body -->



            <!--CONTACTOS-->


            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">INFORMACIÓN DOCENTE</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>

                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-3">
                    <div class="form-group">
                      <!-- NUMERO DE EMPLEADO -->
                      <label>Número Empleado</label>
                      <input class="form-control" type="text" id="txt_n_empleado" name="txt_n_empleado" maxlength="6" value="" onkeypress="return solonumeros(event)" onKeyUp="pierdeFoco(this)" required>
                    </div>
                  </div>

                  <div class="col-sm-3">
                    <div class="form-group">
                      <!-- FECHA DE INGRESO txt_fecha_ingreso -->
                      <label>Fecha Ingreso</label>
                      <input class="form-control" type="date" id="txt_fecha_ingreso" name="txt_fecha_ingreso" required onkeydown="return false" required>

                    </div>
                  </div>

                  <div class="col-sm-3">
                    <div class="form-group">
                      <!-- CATEGORIAS -->
                      <label>Categoría</label>
                      <select class="form-control" onchange="prueb();" name="categoria" id="categoria" value="" style="text-transform: uppercase">
                      </select>
                    </div>
                  </div>

                  <div class="col-sm-3">
                    <div class="form-group">
                      <!-- JORNADA -->
                      <label>Jornada</label>
                      <select class="form-control" onchange="prueba();" name="jornada" id="jornada" value="" style="text-transform: uppercase">
                      </select>
                    </div>
                  </div>

                  <div class="col-sm-3">
                    <div class="form-group">
                      <!-- HORARIO DE ENTRADA -->
                      <label>Horario Entrada</label>

                      <select class="form-control" name="txt_hi" id="txt_hi" value="" required>

                      </select>
                    </div>
                  </div>

                  <div class="col-sm-3">
                    <div class="form-group">
                      <!-- HORARIO DE SALIDA -->
                      <label>Horario Salida</label>
                      <select class="form-control" name="txt_hf" id="txt_hf" value="" onblur="valida_horario_edita()" required>

                      </select>
                    </div>
                  </div>


                  <div class="col-sm-4">
                    <div class="form-group">

                      <!-- TABLA COMISIONES Y ACTIVIDADES -->
                      <div class="container">
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalTask2">Agregar</button>

                        <label for="">Comisiones y Actividades</label>


                        <table class="table table-bordered table-striped m-0">
                          <thead>
                            <tr>

                              <th hidden>#</th>
                              <th>Comisiones</th>
                              <th>Actividades</th>
                            </tr>
                          </thead>
                          <tbody id="tbData3"></tbody>
                        </table>
                      </div>
                    </div>
                  </div>


                  <div class="modal fade" tabindex="-1" role="dialog" id="ModalTask2">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Datos</h5>
                          <button class="close" data-dismiss="modal">
                            &times;
                          </button>
                        </div>

                        <div class="modal-body">
                          <div class="container">
                            <div class="form-group">
                              <label>Comisiones</label>
                              <select class="form-control" name="comisiones" id="comisiones">

                              </select>

                              <label>Actividades</label>
                              <select class="form-control" name="actividades" id="actividades">

                              </select>

                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button class="btn btn-success" onclick="addTask3()">Agregar</button>
                          <button class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        </div>
                      </div>
                    </div>
                  </div>


                </div>

                <div class="col-sm-1">
                  <div class="form-group">


                    <input class="form-control" type="hidden" id="age" name="age" maxlength="25" value="" required style="text-transform: uppercase">


                  </div>
                </div>

                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <p class="text-center" style="margin-top: 10px;">
            <button type="submit" class="btn btn-primary btn-lg" id="btn_guardar_registro_docentes" name="btn_guardar_registro_docentes" onclick="RegistarDocente($('#txt_nombres').val(), $('#txt_apellidos').val(), $('#cb_genero').val(), $('#identidad').val(), $('#cb_nacionalidad').val(), $('#cb_ecivil').val(), $('#txt_fecha_nacimiento').val(), $('#txt_hi').val(), $('#txt_hf').val(), $('#txt_n_empleado').val(), $('#txt_fecha_ingreso').val());   ">
              <i class="zmdi zmdi-floppy"></i>GUARDAR</button>
          </p>

        </section>
      </section>
    </div>



  </form>

  <script type="text/javascript" src="../js/funciones_registro_docentes.js"></script>
  <script type="text/javascript" src="../js/validar_registrar_docentes.js"></script>

</body>



</html>


<script>
  document.getElementById("seleccionararchivo").addEventListener("change", () => {
    var archivoseleccionado = document.querySelector("#seleccionararchivo");
    var archivos = archivoseleccionado.files;
    var imagenPrevisualizacion = document.querySelector("#mostrarimagen");
    // Si no hay archivos salimos de la función y quitamos la imagen
    if (!archivos || !archivos.length) {
      imagenPrevisualizacion.src = "";
      return;
    }
    // Ahora tomamos el primer archivo, el cual vamos a previsualizar
    var primerArchivo = archivos[0];
    // Lo convertimos a un objeto de tipo objectURL
    var objectURL = URL.createObjectURL(primerArchivo);
    // Y a la fuente de la imagen le ponemos el objectURL
    imagenPrevisualizacion.src = objectURL;
  });

  function Registrar() {
    //var f= new date();

    var archivo = $("#seleccionararchivo").val();
    //var extension = archivo.split('.').pop();
    //var nombrearchivo= "IMG"+f.getDate()+""+f.getMonth()+""+f.getFullYear()+""+f.getHours()+""+getMinutes()+""+f.getSeconds()+"."+extension;
    //if(archivo.length ==0){
    //return Swal.fire('Mensaje De Advertencia',"Debe Seleccionar un archivo","warning");
    //}

    var formData = new FormData();
    var foto = $("#seleccionararchivo")[0].files[0];
    formData.append('f', foto);
    //formData.append('nombrearchivo',nombrearchivo);

    $.ajax({
      url: '../Controlador/subirimagen.php',
      type: 'post',
      data: formData,
      contentType: false,
      processData: false,
      success: function(respuesta) {
        if (respuesta != 0) {
          Swal('Mensaje De Confirmacion', "Se subio el archivo con exito", "success");
        }
      }
    });
    return false;
  }
</script>




<script>
  document.getElementById("curriculum").addEventListener("change", () => {
    var archivoseleccionado2 = document.querySelector("#curriculum");
    var archivos2 = archivoseleccionado2.files;

  });

  function Registrarcurriculum() {
    //var f= new date();

    var archivo2 = $("#curriculum").val();
    //var extension = archivo.split('.').pop();
    //var nombrearchivo= "IMG"+f.getDate()+""+f.getMonth()+""+f.getFullYear()+""+f.getHours()+""+getMinutes()+""+f.getSeconds()+"."+extension;
    //if(archivo2.length==0){
    //return Swal.fire('Mensaje De Advertencia',"Debe Seleccionar un archivo","warning");
    //}

    var formData = new FormData();
    var curriculum = $("#curriculum")[0].files[0];
    formData.append('c', curriculum);
    //formData.append('nombrearchivo',nombrearchivo);

    $.ajax({
      url: '../Controlador/subirdocumento.php',
      type: 'post',
      data: formData,
      contentType: false,
      processData: false,
      success: function(respuesta) {
        if (respuesta != 0) {

          //Swal.fire('Mensaje De Confirmacion',"Se subio el archivo con exito","success");
        }
      }
    });
    return false;
  }
</script>