


<!DOCTYPE html>
<html>
<title>Crud stores</title>
<head>
  <?php require_once "dependencias.php"; ?>

</head>
<body>
	<div class="container">
		<br>
		<h1>CRUD</h1>
		<hr>
		<div class="row">
			<div class="col-sm-12">
				<div id="tablastores"></div>
			</div>
		</div>
	</div>


  <!--************************************************* agregar datosmodal ***********************************************-->
  <div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Depositos</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        	<form id="frmAgrega">
        		<label>Cuentan</label>
        		<input type="text" class="form-control form-control-sm" name="cuentanro" id="cuentanro">
        		<label>Cedula</label>
        		<input type="text" class="form-control form-control-sm" name="cedula" id="cedula">
        		<label>Valor</label>
        		<input type="text" class="form-control form-control-sm" name="valor" id="valor">
        	</form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-raised btn-primary" id="btnAgregarJuego">Agregar</button>
        </div>
      </div>
    </div>
  </div>
  <!--************************************************* agregar datosmodal ***********************************************-->


  <!--************************************************* updatemodal ***********************************************-->
  <div class="modal fade" id="updatemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">

          <h5 class="modal-title" id="exampleModalLabel">Actualiza Cuenta</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        	<form id="frmactualiza">
            <input type="text" hidden="" name="id_usuarios" id="id_usuarios">
            <label>Cuenta</label>
            <input type="text" class="form-control form-control-sm" name="cuentanroU" id="cuentanroU">
            <label>Cedula</label>
            <input type="text" class="form-control form-control-sm" name="cedulaU" id="cedulaU">
            <label>Valor</label>
            <input type="text" class="form-control form-control-sm" name="valorU" id="valorU">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-raised btn-warning" id="btnactualizar">Actualizar</button>
        </div>
      </div>
    </div>
  </div>
  <!--************************************************* updatemodal ***********************************************-->
</body>
</html>





<script type="text/javascript">
	$(document).ready(function(){
		$('#tablastores').load('tabla.php');

    $('#btnAgregarJuego').click(function(){
      if(validarFormVacio('frmAgrega') > 0){
        alertify.alert("Debes llenar todos los campos por favor!");
        return false;
      }

      datos=$('#frmAgrega').serialize();

      $.ajax({
        type:"POST",
        data:datos,
        url:"php/insertar.php",
        success:function(r){
          if(r==1){
           $('#frmAgrega')[0].reset();
           $('#tablastores').load('tabla.php');
           alertify.success("Agregado con exito :)");
         }else{
          alertify.error("No se pudo agregar :(");
        }
      }
    });
    });


  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#btnactualizar').click(function(){

      datos=$('#frmactualiza').serialize();
        $.ajax({
          type:"POST",
          data:datos,
          url:"php/actualizar.php",
          success:function(r){
            if(r==1){
             $('#tablastores').load('tabla.php');
               alertify.success("Actualizado con exito :)");
            }else{
               alertify.error("No se pudo actualizar :(");
            }
           }
        });
    });
  });
</script>

<script type="text/javascript">

  function obtenDatos(idusuarios){
    $.ajax({
      type:"POST",
      data:"idusuarios=" + idusuarios,
      url:"php/obtenerRegistro.php",
      success:function(r){
        datos=jQuery.parseJSON(r);

        $('#id_usuarios').val(datos['id_usuarios']);
        $('#cuentanroU').val(datos['cuentanroU']);
        $('#cedulaU').val(datos['cedulaU']);
        $('#valorU').val(datos['valorU']);
      }
    });
  }

  
  function validarFormVacio(formulario){
    datos=$('#' + formulario).serialize();
    d=datos.split('&');
    vacios=0;
    for(i=0;i< d.length;i++){
      controles=d[i].split("=");
      if(controles[1]=="A" || controles[1]==""){
        vacios++;
      }
    }
    return vacios;
  }

  function elimina(idusuarios){
      alertify.confirm('Eliminar usuarios', '¿Desea eliminar este registro?', 
              function(){ 
                  $.ajax({
                     type:"POST",
                      data:"idusuarios=" + idusuarios,
                      url:"php/eliminar.php",
                      success:function(r){
                          if(r==1){     
                              $('#tablastores').load('tabla.php');
                              alertify.success("Eliminado con exito :)");
                          }else{
                               alertify.error("No se pudo eliminar :(");
                          }
                      }
                  });
              }
              ,function(){ 
                alertify.error('Cancelo')
              });
  }

</script>