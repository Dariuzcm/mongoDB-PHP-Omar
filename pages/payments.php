<?php 
   session_start();
   if(!isset($_SESSION['username']))
       echo '<script>window.location.href="../pages/login.html";</script>';
    if(!$_SESSION['privilage'])
           echo '<script>
            alert("No tienes permisos para entrar a este lugar.");
           window.location.href="../index.php";</script>';
     
?>
<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Pagos</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="../assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/libs/css/style.css">
    <link rel="stylesheet" href="../assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="icon" type="image/png" href="../assets/images/logo.png" />
</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
         <?php include('nav_bar.php');?>
         <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">Pagos</h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Administrar</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Pagos</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->
             
                    <div class="row">
                        <!-- ============================================================== -->
                        <!-- justified tabs  -->
                        <!-- ============================================================== -->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-5">
                            <div class="tab-regular">
                                <ul class="nav nav-tabs nav-fill" id="myTab7" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab-justify" data-toggle="tab" href="#home-justify" role="tab" aria-controls="home" aria-selected="true">Registrar</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab-justify" data-toggle="tab" href="#profile-justify" role="tab" aria-controls="profile" aria-selected="false">Buscar</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent7">
                                    <div class="tab-pane fade show active" id="home-justify" role="tabpanel" aria-labelledby="home-tab-justify">
                                        <!-- ============================================================== -->
                                        <!-- basic form -->
                                        <!-- ============================================================== -->
                                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                            <div class="card">
                                                <div id="status"></div>
                                                <h5 class="card-header">Campos obligatorios (*)</h5>
                                                <div class="card-body">
                                                    <form id="basicform" >
                                                        <div class="form-group">
                                                            <label for="">Fecha*</label>
                                                            <input id="r_fecha" required type="date" id="fecha" data-parsley-trigger="change" placeholder="dd-mm-yyyy" autocomplete="off" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Emisor*</label>
                                                            <input id="r_emisor" required type="text" id="emisor" data-parsley-trigger="change" placeholder="Enter payer name" autocomplete="off" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Receptor*</label>
                                                            <input id="r_receptor" required type="text" id="receptor" data-parsley-trigger="change" placeholder="Enter receiver name" autocomplete="off" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Cantidad*</label>
                                                            <input id="r_cantidad" required type="number" class="form-control" min="0.01" max="9999999.00" im-insert="true">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Motivo*</label>
                                                            <input id="r_motivo" required type="text" id="motivo" placeholder="Enter subject" class="form-control">
                                                        </div><br>
                                                        <div class="row">
                                                            <div class="col-sm-6 pb-2 pb-sm-4 pb-lg-0 pr-0">
                                                                
                                                            </div>
                                                            <div class="col-sm-6 pl-0">
                                                                <p class="text-right">
                                                                    <button type="submit" id="btn-reg-pay" class="btn btn-space btn-primary">Guardar</button>
                                                                    <button type="reset" class="btn btn-space btn-secondary">Cancelar</button>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- ============================================================== -->
                                        <!-- end basic form -->
                                        <!-- ============================================================== -->
                                    </div>
                                    <div class="tab-pane fade" id="profile-justify" role="tabpanel" aria-labelledby="profile-tab-justify">
                                        <div class="row">
                                            <!-- ============================================================== -->
                                            <!-- basic table  -->
                                            <!-- ============================================================== -->
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <div class="card">
                                                    <h3 class="card-header">Resultados</h3> 
                                                        <input type="text" id="txt-pago" class="form-control">
                                                        <button type="submit" class="btn btn-succes"id="btn-buscar-pago">Buscar Pagos</button>
                                                    
                                                    <div class="card-body">
                                                        <div id="search-status"></div>
                                                        <div id="table-div" class="table-responsive">
                                                            <table class="table table-striped table-bordered first">
                                                            <thead>    
                                                                <tr>
                                                                    <th></th>
                                                                </tr>
                                                                </thead>
                                                                <tbody id="t-body">
                                                                    <tr><td><h3>Iniciar Busqueda</h3>    </td></tr>
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <th></th>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- ============================================================== -->
                                            <!-- end basic table  -->
                                            <!-- ============================================================== -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================================== -->
                        <!-- end justified tabs  -->
                        <!-- ============================================================== -->
                    </div>
              
            </div>
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <div class="footer">
                <div class="container-fluid">
                    <div class="row">
                         <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                             Copyright © 2019 3DH. Desarrollado por 3DH con <a href="https://getbootstrap.com/">Bootstrap</a>.
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="text-md-right footer-links d-none d-sm-block">
                                <a href="javascript: void(0);">About</a>
                                <a href="javascript: void(0);">Support</a>
                                <a href="javascript: void(0);">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end footer -->
            <!-- ============================================================== -->
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="../assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="../assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <script src="../assets/libs/js/main-js.js"></script>
    <script src="../assets/vendor/inputmask/js/jquery.inputmask.bundle.js"></script>
    <script>
    $(function(e) {
        "use strict";
            $(".currency-inputmask").inputmask("$9999999")
    });
    </script>
    <script>
        $(document).ready(function () {
        $("#btn-reg-pay").click(function () { 
            data={
                fecha: $("#r_fecha").val(),
                emisor: $("#r_emisor").val(),
                receptor: $("#r_receptor").val(),
                cantidad: $("#r_cantidad").val(),
                motivo: $("#r_motivo").val()
            };
            $.ajax({
                type: "post",
                url: "control/PagoRegistrar.php",
                data: data,
                beforeSend: ()=>{
                    $("#status").html("<div class='alert alert-light'> <strong>Procesando Solicitud</strong></div>");
                },
                success: function (response) {
                    
                    $("#r_fecha").val("");
                    $("#r_emisor").val("");
                    $("#r_receptor").val("");
                    $("#r_cantidad").val("");
                    $("#r_motivo").val("");
                    $("#status").html(response);
                }
            });
        });
        $("#btn-buscar-pago").click(()=>{
            $.ajax({
                type: "post",
                url: "control/payment_table..php",
                data: {search: $("#txt-pago").val()},
                beforeSend: ()=>{
                    $("#search-status").html('<div class="alert alert-primary">Buscando ...</div>');
                },
                success: function (response) {
                    $("#search-status").html('<div></div>');
                    $("#table-div").html(response);  
                }
            });
            return false;
        });
    });

    </script>
</body>
</html>