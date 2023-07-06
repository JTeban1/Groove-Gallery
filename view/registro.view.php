<!DOCTYPE html>
<html lang="en">

<head>
        <link rel="stylesheet" href="../css/register.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="../Img/icon.jpeg" type="image/x-icon">
</head>

<body> 

    <script>
        if (window.history.replaceState) { // verificamos disponibilidad
            window.history.replaceState(null, null, window.location.href, '../logicaviews/Admin.php');
        }
    </script>

    <div class="background"></div>


    <div class="container">
        <div class="item">
            <h2 class="logo"><i class="bx bx-music"></i>Groove Gallery</h2>
            <div class="text-item">
                <h2>¡Bienvenido! <br><span>
                    al inicio de sesion 
                </span></h2>
                <p>Puedes encontrarnos facilmente en nuestras redes sociales, siguenos para estar al tanto de las mejores promociones</p>
                <div class="social-icon">
                    <a href=""><i class='bx bxl-facebook'></i></a>
                    <a href=""><i class='bx bxl-twitter'></i></a>
                    <a href=""><i class='bx bxl-youtube'></i></a>
                    <a href="   "><i class='bx bxl-instagram'></i></a>
                </div>
            </div>
        </div>
        <div class="login-section">
            <div id="div-form">
            <div class="form-box login">
            <form action="../crud/register.php" method="post">

                    <h2>Regístrate</h2>

                    <div class="input-box">
                        <span class="icon"><i class='bx bxs-face'></i></span>
                        <input type="text" required name="nombre">
                        <label >Nombre</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><i class='bx bxs-face'></i></span>
                        <input type="text" required name="apellido">
                        <label >Apellido</label>
                    </div>

                    <div class="input-box">
                        <span class="icon" ><i class='bx bxs-captions'></i></span>
                        <select required required name="tipoDocumento">
                            <option value="" disabled selected>Tipo de documento</option>
                            <option value="CC">Cédula de Ciudadanía</option>
                            <option value="TI">Tarjeta Identidad</option>
                            <option value="CE">Cedula de Extranjería</option>
                        </select>
                    </div>

                    <div class="input-box">
                        <span class="icon"><i class='bx bxs-captions'></i></span>
                        <input type="text" required name="numeroDocumento">
                        <label >Número documento</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><i class='bx bxs-envelope'></i></span>
                        <input type="email" required name="email">
                        <label >Email</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><i class='bx bx-car'></i></span>
                        <input type="text" required name="direccion">
                        <label >Direccion</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><i class='bx bxs-phone'></i></span>
                        <input type="text" required name="celular">
                        <label >Celular</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><i class='bx bxs-user'></i></span>
                        <input type="text" required name="userName">
                        <label >Nombre de usuario</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><i class='bx bxs-lock-alt' ></i></span>
                        <input type="password" required name="password">
                        <label>Contraseña</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><i class='bx bxs-lock-alt'></i></span>
                        <input type="password" required name="validarPassword">
                        <label >Confirmar contraseña</label>
                    </div>
                    <div class="remember-password">
                        <label for=""><input type="checkbox">Acepto el uso de mis datos</label>
                    </div>

                    <div>
                    <?php include '../include/ToolTipError.php'; ?>
                    <button  type="submit" class="btn" name="submit" >Registrarse</button>
                    
                    </div>

                    <div class="create-account">
                        <p>¿Ya tienes una cuenta? 
                            <a href="../crud/login.php"   type="submit" class="login-link">Iniciar sesion</a>
                        </p>
                    </div>

                </form>
            </div>
            
        </div>
        </div>
    </div>


</body>

</html>