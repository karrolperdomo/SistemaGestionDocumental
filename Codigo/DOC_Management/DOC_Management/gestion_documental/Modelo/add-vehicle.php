<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['doc_management']) == 0) {
    header('location:logout.php');
} else {

    if (isset($_POST['submit'])) {


        $parkingnumber = mt_rand(1, 10);
        $marca = $_POST['marca'];
        $catename = $_POST['catename'];
        $vehcomp = $_POST['vehcomp'];
        $placa = $_POST['placa'];
        $identificacion_propieta = $_POST['identificacion_propieta'];
        $nombre_propieta = $_POST['nombre_propieta'];
        $ownercontno = $_POST['ownercontno'];
        $enteringtime = $_POST['enteringtime'];
        $estado = 'Out';

        $ret = mysqli_query($con, "select *from  vehiculo where Placa like '$placa%'");
        $num = mysqli_num_rows($ret);
        if ($num > 0) {
            $row = mysqli_fetch_array($ret);
            $id = $row['ID'];
            $estado = $row['Estado'];

            if ($estado == 'Out') {
                header('location:view-outgoingvehicle-detail.php?viewid=' . $id);
            } else {
                header('location:view-incomingvehicle-detail.php?viewid=' . $id);
            }
        } else {



            $query_insert = "insert into vehiculo(Bahia,Categoria,Marca,Placa,numero_identificacion,Propietario,Celular,estado) " .
                "value " .
                "('$parkingnumber','$catename','$marca','$placa','$identificacion_propieta','$nombre_propieta','$ownercontno','$estado')";
            echo $query_insert;
            $query = mysqli_query($con, $query_insert);

            if ($query) {
                echo "<script>alert('Vehiculo añadido');</script>";
                echo "<script>window.location.href ='manage-incomingvehicle.php'</script>";
            } else {
                echo "<script>alert('Ha ocurrido algo. Intente de nuevo');</script>";
            }
        }
    }

?>
    <!doctype html>
    <html class="no-js" lang="">

    <head>

        <title>Registrar Documento</title>


        <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
        <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

        <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

    </head>

    <body>
        <?php include_once('includes/sidebar.php'); ?>
        <!-- Right Panel -->

        <?php include_once('includes/header.php'); ?>

        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Registro</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="dashboard.php">Tablero de mandos</a></li>
                                    <li><a href="add-vehicle.php">Documento</a></li>
                                    <li class="active">Registrar Documento</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="animated fadeIn">


                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">


                        </div> <!-- .card -->

                    </div>
                    <!--/.col-->



                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Registrar </strong> Documento
                            </div>
                            <div class="card-body card-block">
                                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    <p style="font-size:16px; color:red" align="center"> <?php if ($msg) {
                                                                                                echo $msg;
                                                                                            }  ?> </p>


                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="select" class=" form-control-label">Tipo Documento:</label></div>
                                        <div class="col-12 col-md-9">
                                            <select name="catename" id="catename" class="form-control">
                                                <option value="0">Cartas</option>
                                                <option value="1">Cartas circulares</option>
                                                <option value="2">Convocatorias</option>
                                                <option value="3">Actas</option>
                                                <option value="4">Transcripción de acuerdos</option>

                                                <?php $query = mysqli_query($con, "select * from categoria");
                                                while ($row = mysqli_fetch_array($query)) {
                                                ?>
                                                    <option value="<?php echo $row['tipo']; ?>"><?php echo $row['tipo']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="select" class=" form-control-label">Destinatario:</label></div>
                                        <div class="col-12 col-md-9">
                                            <select name="csatename" id="catename" class="form-control">
                                                <option value="0">Alejandro de la Espriella Chacón</option>
                                                <option value="1">Karol Rocio Perdomo Salgado</option>
                                                <option value="2">Erika Paola Caro Castro</option>
                                                <option value="3">Luis Eduardo Carrilo</option>
                                                <option value="4">Luis Doncel</option>
                                                <option value="5">Sergio Sandoval</option>
                                                <option value="6">Laura Gonzales</option>

                                                <?php $query = mysqli_query($con, "select * from categoria");
                                                while ($row = mysqli_fetch_array($query)) {
                                                ?>
                                                    <option value="<?php echo $row['tipo']; ?>"><?php echo $row['tipo']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="select" class=" form-control-label">Area designada:</label></div>
                                        <div class="col-12 col-md-9">
                                            <select name="catename" id="catename" class="form-control">
                                                <option value="0">Talento Humano</option>
                                                <option value="1">Custodia</option>
                                                <option value="2">Seguridad</option>
                                                <option value="3">Clasificación</option>
                                                <option value="4">Recuperación</option>

                                                <?php $query = mysqli_query($con, "select * from categoria");
                                                while ($row = mysqli_fetch_array($query)) {
                                                ?>
                                                    <option value="<?php echo $row['tipo']; ?>"><?php echo $row['tipo']; ?></option>
                                                <?php } ?>
                                            </select>

                                        </div>
                                    </div>

                                    <form enctype="multipart/form-data" action="" name="form" method="post">
                                        Seleccione Archivo
                                            <input type="file" name="file" id="file" /></td>
                                            <input type="submit" name="submit" id="submit" value="Subir" />
                                    </form>





                                    <p style="text-align: center;">
                                        <button type="submit" class="btn btn-primary btn-sm" name="submit">Escalar</button>
                                    </p>
                                </form>
                            </div>

                        </div>

                    </div>

                    <div class="col-lg-6">


                    </div>



                </div>


            </div><!-- .animated -->
        </div><!-- .content -->

        <div class="clearfix"></div>

        <?php include_once('includes/footer.php'); ?>

        </div><!-- /#right-panel -->

        <!-- Right Panel -->

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
        <script src="assets/js/main.js"></script>


    </body>

    </html>
<?php }  ?>