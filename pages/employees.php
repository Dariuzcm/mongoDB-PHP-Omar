<?php 
   session_start();
   if(!isset($_SESSION['username']))
       echo '<script>window.location.href="/pages/login.html";</script>';
?>
<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Empleados</title>
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
         <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <?php include('nav_bar.php');?>
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">Empleados</h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Administrar</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Empleados</li>
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
                                                <h5 class="card-header">Campos obligatorios (*)</h5>
                                                <div class="card-body">
                                                    <div id="status"></div>
                                                    <form id="basicform">
                                                        <div class="form-group">
                                                            <label for="">Nombres*</label>
                                                            <input type="text" name="nombre" required placeholder="Enter the name" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Apellidos*</label>
                                                            <input type="text" name="apellido" data-parsley-trigger="change" required="" placeholder="Enter the name" autocomplete="off" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                                <label>N&uacute;mero telef&oacute;nico* <small class="text-muted">(999) 999-9999</small></label>
                                                                <input type="phone" name="telefono" >
                                                            </div>
                                                        <div class="form-group">
                                                            <label for="">Correo electr&oacute;nico*</label>
                                                            <input type="email" name="email" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Fecha de nacimiento*</label>
                                                            <input type="date" name="fecha_nac" placeholder="Enter the birthday" required class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Fecha de ingreso*</label>
                                                            <input type="date" name="fecha_in" required placeholder="Enter the enter day" class="form-control">
                                                        </div><br>
                                                        <div class="row">
                                                            <div class="col-sm-6 pb-2 pb-sm-4 pb-lg-0 pr-0">
                                                                
                                                            </div>
                                                            <div class="col-sm-6 pl-0">
                                                                <p class="text-right">
                                                                    <button type="submit" class="btn btn-space btn-primary" id="save_employe">Guardar</button>
                                                                    <button class="btn btn-space btn-secondary">Cancelar</button>
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
                                                        <input type="text" id="txt-employe" class="form-control">
                                                        <button type="submit" class="btn btn-success" id="btn-buscar-employe">Buscar Proyectos</button>
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
        $(document).ready(function () {
            $('#save_employe').click(function () { 
                data = $('#basicform').serialize();
                $.ajax({
                    type: "post",
                    url: "control/EmployRegister.php",
                    data: data,
                    beforeSend: function(){
                        $('#status').html("<div class='alert alert-primary'>Realizando Registro</div>");
                    },
                    success: function (response) {
                        $('#status').html(response);
                    }
                });
                return false;
            });
            $('#btn-buscar-employe').click(()=>{
                data={search: $('#text-employe')};
                $.ajax({
                    type: "post",
                    url: "control/table_employe.php",
                    data: data,
                    beforeSend:()=>{
                        
                    },
                    success: function (response) {
                        
                    }
                });
            });
            
        });
    </script>
    
</body>
 
</html>