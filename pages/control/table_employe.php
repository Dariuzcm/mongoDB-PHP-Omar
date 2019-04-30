<?php 
    namespace control;
    include('Employe.php');

    $search = $_POST['search'];
    $empment = new Employe();
    $modalEdit=null;
    $modalDelete=null;
    $response=null;
    $response = $empment->findPattern($search);
    $result=null;
    $altable='
            <table class="table table-striped table-bordered first">
                         
                        <thead>    
                        <tr>
                                    <th>Folio</th>
                                    <th>Nombre </th>
                                    <th>Apellido</th>
                                    <th>Telefono</th>
                                    <th>Email</th>
                                    <th>Fecha de Nacimiento</th>
                                    <th>Fecha de integración</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>';
    $downtable='</tbody>
                            <tfoot>
                                <tr>
                                    <th>Folio</th>
                                    <th>Nombre </th>
                                    <th>Apellido</th>
                                    <th>Telefono</th>
                                    <th>Email</th>
                                    <th>Fecha de Nacimiento</th>
                                    <th>Fecha de integración</th>
                                    <th></th>
                            </tr>
                            </tfoot>
                        </table>';
    $Alltable=$altable;

    foreach($response as $emp){
        $result .= '<tr>
            <td>'.$emp->_id.'</td>
            <td>'.$emp->nombre.'</td>
            <td>'.$emp->apellido.'</td>
            <td>'.$emp->telefono.'</td>
            <td>'.$emp->email.'</td>
            <td>'.$emp->fecha_nac.'</td>
            <td>'.$emp->fecha_in.'</td>
            <td>
                <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-'.$emp->_id.'-edit">Editar</button>
                <button data-toggle="modal" data-target="#modal-delete-'.$emp->_id.'"class="btn btn-sm btn-danger">
                    <i class="far fa-trash-alt"></i>
                </button>
            </td>
            </tr>';
            $modalDelete.='<!-- Modal -->
            <div class="modal fade" id="modal-delete-'.$emp->_id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Esta seguro de querer ELIMINAR el empleado con folio: '.$emp->_id.'?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div id="modal-delete-status"></div>
                    <h6>Despues de Confirmar se eliminará permanentemente.</h6>

                  </div>
                  <div class="modal-footer">
                    <button  type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
                    <button id="btn-delete-'.$emp->_id.'" type="button" class="btn btn-warning">ELIMINAR</button>
                  </div>
                </div>
              </div>
            </div><script>
            $("#modal").on("shown.bs.modal", function () {
                $("#modal-delete-'.$emp->_id.'").trigger("focus");
              });

              $("#btn-delete-'.$emp->_id.'").click(()=>{
                  $.ajax({
                    type: "post",
                    url: "control/EmpleadoEliminar.php",
                    data: { _id: "'.$emp->_id.'"},
                    beforeSend: ()=>{
                      $("#modal-delete-status").html("'."<div class='alert alert-light'>Excecute Deleting</div>".'");
                    },
                    success: function (response) {
                      $("#modal-delete-status").html(response);
                      location.reload();
                    }
                  });
                  return false;
              });
            </script>';

            $modalEdit.='<!-- Modal -->
            <div class="modal fade" id="modal-'.$emp->_id.'-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Registro: '.$emp->_id.'</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                  <form class="form-control" id="editform">
                    <div class="form-control">
                    <div id="modal-status-'.$emp->_id.'"></div>
                    <h6 class="card-header">Nombre: <input required name="nombre" id="input-nombre-'.$emp->_id.'"type="date" class="form-control" value="'.$emp->nombre.'"></h6>
                    <h6 class="card-header">Apellidos: <input required name="apellido" id="input-apellido-'.$emp->_id.'" type="text" class="form-control"value="'.$emp->apellido.'"></h6>
                    <h6 class="card-header">Telefono: <input required name="telefono" id="input-telefono-'.$emp->_id.'" type="text" class="form-control" value="'.$emp->telefono.'"></h6>
                    <h6 class="card-header">Email: <input required name="email" id="input-email-'.$emp->_id.'" type="number" class="form-control"value="'.$emp->email.'" ></h6>
                    <h6 class="card-header">Fecha de nacimiento: <input required name="fecha_nac" id="input-fecha_nac-'.$emp->_id.'" type="text" class="form-control" value="'.$emp->fecha_nac.'"></h6>
                    <h6 class="card-header">Fecha de ingreso: <input required name="fecha_in" id="input-fecha_in-'.$emp->_id.'" type="text" class="form-control" value="'.$emp->fecha_in.'"></h6>
                         </div>
                  </div>
                  <div class="modal-footer">
                    <button id="btn-cancel-'.$emp->_id.'" type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button id="btn-update-'.$emp->_id.'" type="button" class="btn btn-primary" disabled >Guardar Cambios</button>
                  </div>
                  </form>
                </div>
              </div>
            </div><script>
            $("#modal").on("shown.bs.modal", function () {
                $("#modal-'.$emp->_id.'-edit").trigger("focus")
              });
              $("#input-nombre-'.$emp->_id.'").change(()=>{
                $("#btn-update-'.$emp->_id.'").removeAttr("disabled");
              });
              $("#input-apellido-'.$emp->_id.'").change(()=>{
                $("#btn-update-'.$emp->_id.'").removeAttr("disabled");
              });
              $("#input-telefono-'.$emp->_id.'").change(()=>{
                $("#btn-update-'.$emp->_id.'").removeAttr("disabled");
              });
              $("#input-email-'.$emp->_id.'").change(()=>{
                $("#btn-update-'.$emp->_id.'").removeAttr("disabled");
              });
              $("#input-fecha_nac-'.$emp->_id.'").change(()=>{
                $("#btn-update-'.$emp->_id.'").removeAttr("disabled");
              });
              $("#input-fecha_in-'.$emp->_id.'").change(()=>{
                $("#btn-update-'.$emp->_id.'").removeAttr("disabled");
              });
              $("#btn-update-'.$emp->_id.'").click(()=>{    
                data = $("#editform").serialize();
                $.ajax({
                  type: "post",
                  url: "control/EmpleadoEditar.php",
                  data: data,
                  beforeSend : ()=>{
                  $("#modal-status-'.$emp->_id.'").html("<div class=\"alert alert-light\">Realizando Cambios</div>");
              
                  },
                  success: function (response) {
                  $("#modal-status-'.$emp->_id.'")
                    .html(response);
                    location.reload();                  }
                });
              });
              $("#btn-cancel-'.$emp->_id.'").click(()=>{
                $("#input-payment-'.$emp->_id.'").val("'.$emp->_id.'");
                $("#btn-update-'.$emp->_id.'").attr("disabled","disabled");
              });
            </script>';

    }
    
    if(!is_null($result)){
        $Alltable=$altable.$result.$downtable.$modalEdit.$modalDelete;
        echo $Alltable;
    }
    else {   
        $Alltable=$altable.'<tr><td>No existen Registros</td></tr>'.$downtable;
        echo $Alltable;
    }
?>
              