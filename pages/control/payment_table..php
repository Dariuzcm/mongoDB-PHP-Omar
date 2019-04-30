<?php 
    namespace control;
    include('Payment.php');

    $search = $_POST['search'];
    $payment = new Payment();
    $modalEdit=null;
    $modalDelete=null;
    $response=null;
    $response = $payment->findPattern($search);
    $result=null;
    $altable='
            <table class="table table-striped table-bordered first">
                         
                        <thead>    
                        <tr>
                                    <th>Folio</th>
                                    <th>Fecha</th>
                                    <th>Emisor</th>
                                    <th>Receptor</th>
                                    <th>Cantidad</th>
                                    <th>Motivo</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>';
    $downtable='</tbody>
                            <tfoot>
                                <tr>
                                <th>Folio</th>
                                <th>Fecha</th>
                                <th>Emisor</th>
                                <th>Receptor</th>
                                <th>Cantidad</th>
                                <th>Motivo</th>
                                <th></th>
                            </tr>
                            </tfoot>
                        </table>';
    $Alltable=$altable;

    foreach($response as $pay){
        $result .= '<tr>
            <td>'.$pay->_id.'</td>
            <td>'.$pay->fecha.'</td>
            <td>'.$pay->emisor.'</td>
            <td>'.$pay->receptor.'</td>
            <td>'.$pay->cantidad.'</td>
            <td>'.$pay->motivo.'</td>
            <td>
                <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-'.$pay->_id.'-edit">Editar</button>
                <button data-toggle="modal" data-target="#modal-delete-'.$pay->_id.'"class="btn btn-sm btn-danger">
                    <i class="far fa-trash-alt"></i>
                </button>
            </td>
            </tr>';
            $modalDelete.='<!-- Modal -->
            <div class="modal fade" id="modal-delete-'.$pay->_id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Esta seguro de querer ELIMINAR el pago con folio: '.$pay->_id.'?</h5>
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
                    <button id="btn-delete-'.$pay->_id.'" type="button" class="btn btn-warning">ELIMINAR</button>
                  </div>
                </div>
              </div>
            </div><script>
            $("#modal").on("shown.bs.modal", function () {
                $("#modal-delete-'.$pay->_id.'").trigger("focus");
              });

              $("#btn-delete-'.$pay->_id.'").click(()=>{
                  $.ajax({
                    type: "post",
                    url: "control/PagoEliminar.php",
                    data: { _id: "'.$pay->_id.'"},
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
            <div class="modal fade" id="modal-'.$pay->_id.'-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Registro: '.$pay->_id.'</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="form-control">
                    <div id="modal-status-'.$pay->_id.'"></div>
                    <h6 class="card-header">Fecha: <input required id="input-fecha-'.$pay->_id.'"type="date" class="form-control" value="'.$pay->fecha.'"></h6>
                    <h6 class="card-header">Emisor: <input required id="input-emisor-'.$pay->_id.'" type="text" class="form-control"value="'.$pay->emisor.'"></h6>
                    <h6 class="card-header">Receptor: <input required id="input-receptor-'.$pay->_id.'" type="text" class="form-control" value="'.$pay->receptor.'"></h6>
                    <h6 class="card-header">Cantidad: <input required id="input-cantidad-'.$pay->_id.'" type="number" class="form-control"value="'.$pay->cantidad.'" ></h6>
                    <h6 class="card-header">Motivo: <input required id="input-motivo-'.$pay->_id.'" type="text" class="form-control" value="'.$pay->motivo.'"></h6>
                         </div>
                  </div>
                  <div class="modal-footer">
                    <button id="btn-cancel-'.$pay->_id.'" type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button id="btn-update-'.$pay->_id.'" type="button" class="btn btn-primary" disabled >Guardar Cambios</button>
                  </div>
                </div>
              </div>
            </div><script>
            $("#modal").on("shown.bs.modal", function () {
                $("#modal-'.$pay->_id.'-edit").trigger("focus")
              });
              $("#input-fecha-'.$pay->_id.'").change(()=>{
                $("#btn-update-'.$pay->_id.'").removeAttr("disabled");
              });
              $("#input-emisor-'.$pay->_id.'").change(()=>{
                $("#btn-update-'.$pay->_id.'").removeAttr("disabled");
              });
              $("#input-receptor-'.$pay->_id.'").change(()=>{
                $("#btn-update-'.$pay->_id.'").removeAttr("disabled");
              });
              $("#input-cantidad-'.$pay->_id.'").change(()=>{
                $("#btn-update-'.$pay->_id.'").removeAttr("disabled");
              });
              $("#input-motivo-'.$pay->_id.'").change(()=>{
                $("#btn-update-'.$pay->_id.'").removeAttr("disabled");
              });
              $("#btn-update-'.$pay->_id.'").click(()=>{    
                $.ajax({
                  type: "post",
                  url: "control/PagoEditar.php",
                  data: {
                    fecha: $("#input-fecha-'.$pay->_id.'").val(),
                    emisor: $("#input-emisor-'.$pay->_id.'").val(),
                    receptor: $("#input-receptor-'.$pay->_id.'").val(),
                    cantidad:$("#input-cantidad-'.$pay->_id.'").val(),
                    motivo:$("#input-motivo-'.$pay->_id.'").val(),
                    id: "'.$pay->_id.'"
                  },
                  beforeSend : ()=>{
                  $("#modal-status-'.$pay->_id.'").html("<div class=\"alert alert-light\">Realizando Cambios</div>");
              
                  },
                  success: function (response) {
                  $("#modal-status-'.$pay->_id.'")
                    .html(response);
                    location.reload();                  }
                });
              });
              $("#btn-cancel-'.$pay->_id.'").click(()=>{
                $("#input-payment-'.$pay->_id.'").val("'.$pay->_id.'");
                $("#btn-update-'.$pay->_id.'").attr("disabled","disabled");
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
              