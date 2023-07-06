<!DOCTYPE html>
<html lang="es">
<head>
    <title>Grove gallery</title>
    <link rel="stylesheet" href="../css/login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="img/icon.jpeg" type="image/x-icon">
</head>
<body>
<script>
        if (window.history.replaceState) { // verificamos disponibilidad
            window.history.replaceState(null, null, window.location.href, '../logicaviews/Admin.php');
        }
    </script>
    <!-- aqui empieza la creacion del login wow -->
    <div class="background"></div>
    
    <div class="container">
        <div class="item">
            <h2 class="logo"><i class="bx bx-music"></i>Groove Gallery</h2>
            <div class="text-item">
                <h2>Bienvenido <br><span>
                    al inicio de sesion 
                </span></h2>
                <p>Puedes encontrarnos facilmente en nuestras redes sociales, siguenos para estar al tanto de las mejores promociones</p>
                <div class="social-icon">
                    <a href="#"><i class='bx bxl-facebook'></i></a>
                    <a href="#"><i class='bx bxl-twitter'></i></a>
                    <a href="#"><i class='bx bxl-youtube'></i></a>
                    <a href="#"><i class='bx bxl-instagram'></i></a>
                </div>
            </div>
        </div>
        <div class="login-section">
            <div class="form-box login">
                <form method="POST" action="../crud/login.php">
                    <h2>Iniciar sesion</h2>
                    <div class="input-box">
                        <span class="icon"><i class='bx bxs-envelope'></i></span>
                        <input  type="text" name="username">
                        <label >Usuario</label>
                    </div>

                    <div class="input-box">
                        <span class="icon"><i class='bx bxs-lock-alt' ></i></span>
                        <input type="password" name="password" class="form-control fs-5 p-2">
                        <label>Contraseña</label>
                    </div>

                    <!--
                    <div class="remember-password">
                        <label for=""><input type="checkbox">Recordar usuario</label>
                        <a href="#">Recuperar contraseña</a>
                    </div> -->

                    <?php include '../include/ToolTipError.php'; ?>
                    <button type="submit" name="submit" class="btn">Iniciar</button>

                    <div class="create-account">
                        <p>¿Aún no tienes una cuenta? <a href="../crud/register.php" class="register-link">Regístrate</a></p>
                    </div>
                    
                </form>
            </div>

                        
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
    <script src="login.js"></script>

</body>

</html>