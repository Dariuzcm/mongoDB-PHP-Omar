<?php
    namespace control;
    include('Project.php');

    $search = $_POST['search'];
    $project = new Project();
    $modalEdit=null;
    $modalDelete=null;
    $response=null;
    $response = $project->findPattern($search);
    $result=null;
    $altable='
            <table class="table table-striped table-bordered first">
       
                        <thead>    
                        <tr>
                                    <th>Folio</th>
                                    <th>Nombre del Proyecto</th>
                                    <th>Fecha de Inicio</th>
                                    <th>Fecha de Finalización</th>
                                    <th>Nombre de Lider</th>
                                    <th>Nombre de cliente</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>';
    $downtable='</tbody>
                            <tfoot>
                                <tr>
                                <th>Folio</th>
                                <th>Nombre del Proyecto</th>
                                <th>Fecha de Inicio</th>
                                <th>Fecha de Finalización</th>
                                <th>Nombre de Lider</th>
                                <th>Nombre de cliente</th>
                                <th></th>
                            </tr>
                            </tfoot>
                        </table>';
    $Alltable=$altable;

    foreach($response as $project){
        $result .= '<tr>
            <td>'.$project->_id.'</td>
            <td>'.$project->proyect_name.'</td>
            <td>'.$project->begin_date.'</td>
            <td>'.$project->end_date.'</td>
            <td>'.$project->manager_name.'</td>
            <td>'.$project->client_name.'</td>
            <td>
                <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-'.$project->_id.'-edit">Editar</button>
                <button data-toggle="modal" data-target="#modal-delete-'.$project->_id.'"class="btn btn-sm btn-danger">
                    <i class="far fa-trash-alt"></i>
                </button>
            </td>
            </tr>';
            $modalDelete.='<!-- Modal -->
            <div class="modal fade" id="modal-delete-'.$project->_id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Esta seguro de querer ELIMINAR el proyecto con folio: '.$project->_id.'?</h5>
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
                    <button id="btn-delete-'.$project->_id.'" type="button" class="btn btn-warning">ELIMINAR</button>
                  </div>
                </div>
              </div>
            </div><script>
            $("#modal").on("shown.bs.modal", function () {
                $("#modal-delete-'.$project->_id.'").trigger("focus");
              });

              $("#btn-delete-'.$project->_id.'").click(()=>{
                  $.ajax({
                    type: "post",
                    url: "control/ProjectDelete.php",
                    data: { _id: "'.$project->_id.'"},
                    beforeSend: ()=>{
                      $("#modal-delete-status").html("'."<div class='alert alert-light'>Excecute Deleting</div>".'");
                    },
                    success: function (response) {
                      $("#modal-delete-status").html(response);
                     /* location.reload();*/
                    }
                  });
                  return false;
              });
            </script>';

            $modalEdit.='<!-- Modal -->
            <div class="modal fade" id="modal-'.$project->_id.'-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Registro: '.$project->_id.'</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="form-control">
                    <div id="modal-status-'.$project->_id.'"></div>
                    <form id="modalForm-'.$project->_id.'">
                    <h6 class="card-header">Fecha: <input required name="_id" id="input-id-'.$project->_id.'"type="text" readonly class="form-control" value="'.$project->_id.'"></h6>                    
                    <h6 class="card-header">Fecha: <input required name="proyect_name" id="input-proyect_name-'.$project->_id.'"type="text" class="form-control" value="'.$project->proyect_name.'"></h6>
                    <h6 class="card-header">Emisor: <input required name="begin_date"  id="input-begin_date-'.$project->_id.'" type="date" class="form-control"value="'.$project->begin_date.'"></h6>
                    <h6 class="card-header">Receptor: <input required name="end_date" id="input-end_date-'.$project->_id.'" type="date" class="form-control" value="'.$project->end_date.'"></h6>
                    <h6 class="card-header">Cantidad: <input required name="manager_name" id="input-manager_name-'.$project->_id.'" type="text" class="form-control"value="'.$project->manager_name.'" ></h6>
                    <h6 class="card-header">Motivo: <input required name="client_name" id="input-client_name-'.$project->_id.'" type="text" class="form-control" value="'.$project->client_name.'"></h6>
                         </div>
                  </div>
                  <div class="modal-footer">
                    <button id="btn-cancel-'.$project->_id.'" type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button id="btn-update-'.$project->_id.'" type="button" class="btn btn-primary" disabled >Guardar Cambios</button>
                  </div>
                </div>
              </div>
            </div><script>
            $("#modal").on("shown.bs.modal", function () {
                $("#modal-'.$project->_id.'-edit").trigger("focus")
              });
              $("#input-proyect_name-'.$project->_id.'").change(()=>{
                $("#btn-update-'.$project->_id.'").removeAttr("disabled");
              });
              $("#input-begin_date-'.$project->_id.'").change(()=>{
                $("#btn-update-'.$project->_id.'").removeAttr("disabled");
              });
              $("#input-end_date-'.$project->_id.'").change(()=>{
                $("#btn-update-'.$project->_id.'").removeAttr("disabled");
              });
              $("#input-manager_name-'.$project->_id.'").change(()=>{
                $("#btn-update-'.$project->_id.'").removeAttr("disabled");
              });
              $("#input-client_name-'.$project->_id.'").change(()=>{
                $("#btn-update-'.$project->_id.'").removeAttr("disabled");
              });
              $("#btn-update-'.$project->_id.'").click(()=>{    
                  data= $("#modalForm-'.$project->_id.'").serialize();
                $.ajax({
                  type: "post",
                  url: "control/ProjectEditar.php",
                  data: data,
                  beforeSend : ()=>{
                  $("#modal-status-'.$project->_id.'").html("<div class=\"alert alert-light\">Realizando Cambios</div>");
              
                  },
                  success: function (response) {
                  $("#modal-status-'.$project->_id.'")
                    .html(response);
                    location.reload();                 }
                });
              });
              $("#btn-cancel-'.$project->_id.'").click(()=>{
                $("#input-project-'.$project->_id.'").val("'.$project->_id.'");
                $("#btn-update-'.$project->_id.'").attr("disabled","disabled");
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