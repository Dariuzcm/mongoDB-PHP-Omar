<?php 
    namespace control;
    include('Usuario.php');

    $search = $_POST['search'];
    $user = new Usuario();
    $modalEdit=null;
    $modalDelete=null;
    $response=null;
    $response = $user->findPattern($search);
    $result=null;
    $altable='
            <table class="table table-striped table-bordered first">
                         
                        <thead>    
                        <tr>
                                    <th>Nombre de Usuario</th>
                                    <th>Privilegio</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>';
    $downtable='</tbody>
                            <tfoot>
                                <tr>
                                    <th>Nombre de Usuario</th>
                                    <th>Privilegio</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>';
    $Alltable=$altable;

    foreach($response as $us){
        
        $admin="Basico";
        $options='<option value=false>Basico</option>
                <option value=true>Administrador</option>';
        if($us->privilage === true) 
          {  $admin="Administrador";
            $options='<option value=true>Administrador</option>
              <option value=false>Basico</option>';
          }
            $result .= '<tr>
            <td>'.$us->username->name.'</td>
            <td>'.$admin.'</td>
            <td>
                <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-'.$us->username->name.'-edit">Editar</button>
                <button data-toggle="modal" data-target="#modal-delete-'.$us->username->name.'"class="btn btn-sm btn-danger">
                    <i class="far fa-trash-alt"></i>
                </button>
            </td>
            </tr>';
            $modalDelete.='<!-- Modal -->
            <div class="modal fade" id="modal-delete-'.$us->username->name.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Esta seguro de querer ELIMINAR al usuario: '.$us->username->name.'?</h5>
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
                    <button id="btn-delete-'.$us->username->name.'" type="button" class="btn btn-warning">ELIMINAR</button>
                  </div>
                </div>
              </div>
            </div><script>
            $("#modal").on("shown.bs.modal", function () {
                $("#modal-delete-'.$us->username->name.'").trigger("focus");
              });

              $("#btn-delete-'.$us->username->name.'").click(()=>{
                  $.ajax({
                    type: "post",
                    url: "control/deleteUser.php",
                    data: { username: "'.$us->username->name.'"},
                    beforeSend: ()=>{
                      $("#modal-delete-status").html("'."<div class='alert alert-light'>Excecute Deleting</div>".'");
                    },
                    success: function (response) {
                      $("#modal-delete-status").html(response);
                      location.reload();
                    }
                  });
              });
            </script>';

            $modalEdit.='<!-- Modal -->
            <div class="modal fade" id="modal-'.$us->username->name.'-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Usuario: '.$us->username->name.'</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="form-control">
                    <div id="modal-status-'.$us->username->name.'"></div>
                    <h6 class="card-header">Nombre de Usuario: <input required id="input-username-'.$us->username->name.'"type="text" class="form-control" value="'.$us->username->name.'"></h6>
                    <h6 class="card-header">Cambiar Contraseña: <input required id="input-pass-'.$us->username->name.'" type="password" class="form-control" ></h6>
                    <h6 class="card-header">Cambiar Privilegio: <select id="input-priv-'.$us->username->name.'" class="form-control" >'.$options.'</select></h6>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button id="btn-cancel-'.$us->username->name.'" type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button id="btn-update-'.$us->username->name.'" type="button" class="btn btn-primary" disabled >Guardar Cambios</button>
                  </div>
                </div>
              </div>
            </div><script>
            $("#modal").on("shown.bs.modal", function () {
                $("#modal-'.$us->username->name.'-edit").trigger("focus")
              });
              $("#input-username-'.$us->username->name.'").change(()=>{
                $("#btn-update-'.$us->username->name.'").removeAttr("disabled");
              });
              $("#input-pass-'.$us->username->name.'").change(()=>{
                $("#btn-update-'.$us->username->name.'").removeAttr("disabled");
              });
              $("#btn-update-'.$us->username->name.'").click(()=>{ 
                priv= ($("#input-priv-'.$us->username->name.'").val() === "true");
                
                $.ajax({
                  type: "post",
                  url: "control/updateUser.php",
                  data: {
                    oldname: "'.$us->username->name.'",
                    username: $("#input-username-'.$us->username->name.'").val() ,
                    pass: $("#input-pass-'.$us->username->name.'").val() ,
                    priv: priv
                  },
                  beforeSend : ()=>{
                  $("#modal-status-'.$us->username->name.'")
                    .html("<div class=\"alert alert-light\">Realizando Cambios</div>");
              
                  },
                  success: function (response) {
                  $("#modal-status-'.$us->username->name.'")
                    .html(response);
                    location.reload();
                  }
                });
              });
              $("#btn-cancel-'.$us->username->name.'").click(()=>{
                $("#input-username-'.$us->username->name.'").val("'.$us->username->name.'");
                $("#btn-update-'.$us->username->name.'").attr("disabled","disabled");
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
