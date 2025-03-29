<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Aquapro</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="src/img/grupo_vasco.png">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">

    <link rel="stylesheet" href="plugins/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="plugins/ionicons/dist/css/ionicons.min.css">
    <link rel="stylesheet" href="plugins/icon-kit/dist/css/iconkit.min.css">
    <link rel="stylesheet" href="plugins/perfect-scrollbar/css/perfect-scrollbar.css">
    <link rel="stylesheet" href="dist/css/theme.css">
    <script src="src/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <div class="auth-wrapper">
        <div class="container-fluid h-100">
            <div class="row flex-row h-100 bg-white">
                <div class="col-xl-8 col-lg-6 col-md-5 p-0 d-md-block d-lg-block d-sm-none d-none">
                    <div class="lavalite-bg" style="background-image: url('src/img/fondo_login.jpeg'); ">
                        <div class="lavalite-overlay"></div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-7 my-auto p-0" >
                    <div class="authentication-form mx-auto" >
                        <div class="logo-centered">
                            <a href="./index.php"><img src="src/img/grupo_vasco.png" alt="" style="width:230px; margin-left: -75px;"></a>
                        </div>
                        <form action="./controllers/login.php" method="POST">
                            <div class="form-group">
                                <input type="text" class="form-control" name="user_mail" placeholder="usuario" required>
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="contraseña" required>
                                <i class="fas fa-lock"></i>
                            </div>

                            <div class="sign-btn text-center">
                                <button class="btn btn-theme" type="submit" name="logear">Iniciar sesion</button><br><br>
                            </div>

                        </form>

                        <!-- modal recuperar contrase���a -->
                        

                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Cambiar clave de acceso</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="./controllers/actualizar-clave.php" method="POST">
                                
                                    <label class="col-form-label">Usuario:</label>
                                    <input type="text" name="usuario" class="form-control">
                                
                                
                                    <label class="col-form-label">Clave nueva:</label>
                                    <input type="password" name="clave" class="form-control">
                                
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                </div>
                            </form>
                            </div>
                        </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>
        window.jQuery || document.write('<script src="../src/js/vendor/jquery-3.3.1.min.js"><\/script>')
    </script>
    <script src="./plugins/popper.js/dist/umd/popper.min.js"></script>
    <script src="./plugins/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="./plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
    <script src="./plugins/screenfull/dist/screenfull.js"></script>
    <script src="./dist/js/theme.js"></script>
    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
    <script>
        (function(b, o, i, l, e, r) {
            b.GoogleAnalyticsObject = l;
            b[l] || (b[l] =
                function() {
                    (b[l].q = b[l].q || []).push(arguments)
                });
            b[l].l = +new Date;
            e = o.createElement(i);
            r = o.getElementsByTagName(i)[0];
            e.src = 'https://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e, r)
        }(window, document, 'script', 'ga'));
        ga('create', 'UA-XXXXX-X', 'auto');
        ga('send', 'pageview');
    </script>

</body>

</html>