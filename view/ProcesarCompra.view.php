<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
if (!isset($_SESSION['valid'])) {
  header('Location: ../crud/login.php');
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Procesar tu compra</title>
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/estilo.css">
  <link rel="icon" href="../Img/logoIcon.png">
  <script src="../js/popper.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

  <link rel="stylesheet" href="../css/sweetalert2.min.css">
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
  </script>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/b56decc6bc.js" crossorigin="anonymous"></script>
</head>



  
  <header class="p-3 text-bg-dark">
    <div class="dropdown">
      <div class="d-flex flex-wrap ">
        <a href="../index.php" class="navbar-brand d-flex align-items-center my-2 my-lg-0 me-lg-auto">
          <strong>Groove Gallery</strong>
        </a>
        <?php if (isset($_SESSION['idrol'])) { ?>
          <div class="text-end navbar-brand d-flex">
            <?php if ($_SESSION['idrol'] == 1) { ?>
              <button type="button" onclick="location.href='../logicaviews/pageadmin.php'" class="btn btn-outline-light me-2">Administrar</button>
            <?php } ?>
            <button type="button" onclick="location.href='../crud/logout.php'" class="btn btn-outline-light me-2">Salir</button>
          </div>
        <?php } ?>
      </div>
    </div>
  </header>
  <?php
  require "../crud/conf/connection.php";
  require "../include/carrito.php";
  ?>
  <div class="container">
    <main>
      <div class="py-5 text-center">
        <h2>Realiza tu pago</h2>
        <p class="lead text-bg-dark">Los datos que ingrese en esta parte son solo para la dirección de envío y persona de quien
          recibe y no afecta sus datos registrados</p>
      </div>

      <div class="row g-3">
        <div class="col-md-5 col-lg-4 order-md-last">
          <h4 class="d-flex justify-content-between align-items-center mb-3 bg-light list-group">
            <span class="m-2">Carrito de compras</span>
          </h4>
          <ul class="list-group mb-3">
            <?php
            if (isset($_SESSION['carritoProcesado'])) {
              if (sizeof($_SESSION['carritoProcesado']) != sizeof($_SESSION['carrito'])) {
                foreach ($_SESSION['carrito'] as $x => $value) {
                  $contentCarrito = $resultado->fetch(PDO::FETCH_ASSOC);
                  $_SESSION['carritoProcesado'][$_SESSION['carrito'][$x]] = $_GET[$x];
                }
              }
            }
            $subTotal = 0;
            if (!isset($_SESSION['carritoProcesado'])) {
              foreach ($_SESSION['carrito'] as $x => $value) {
                $contentCarrito = $resultado->fetch(PDO::FETCH_ASSOC);
                $_SESSION['carritoProcesado'][$_SESSION['carrito'][$x]] = $_GET[$x];
              }
              foreach ($_SESSION['carrito'] as $x => $value) {
                $idCarrito = $_SESSION['carrito'][$x];
                $resultado = $conexion->prepare("SELECT * FROM articulo WHERE idarticulo = :id");
                $resultado->execute(array(':id' => $idCarrito));
                $contentCarrito = $resultado->fetch(PDO::FETCH_ASSOC);
                $subTotal = $subTotal + $contentCarrito['precio_venta'] * $_SESSION['carritoProcesado'][$value];
            ?>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                  <div>
                    <h6 class="my-0"><?php echo $contentCarrito['nombre']; ?></h6>
                  </div>
                  <div>
                    <h6 class="my-0">
                      $<?php echo number_format($contentCarrito['precio_venta'] * $_SESSION['carritoProcesado'][$value], 2); ?>
                    </h6>
                    <small class="text-muted"><?php echo 'Cantidad: ' . $_SESSION['carritoProcesado'][$value]; ?></small>
                  </div>
                </li>
              <?php
              }
            } else {
              foreach ($_SESSION['carrito'] as $x => $value) {
                $idCarrito = $_SESSION['carrito'][$x];
                $resultado = $conexion->prepare("SELECT * FROM articulo WHERE idarticulo = :id");
                $resultado->execute(array(':id' => $idCarrito));
                $contentCarrito = $resultado->fetch(PDO::FETCH_ASSOC);
                $subTotal = $subTotal + $contentCarrito['precio_venta'] * $_SESSION['carritoProcesado'][$value];
              ?>
                <li class="list-group-item d-flex justify-content-between lh-sm">

                  <div>
                    <h6 class="my-0"><?php echo $contentCarrito['nombre']; ?>
                      <? //php echo number_format($contentCarrito['nombre'] * $_SESSION['carritoProcesado'][$value], 4);
                      ?>
                    </h6>
                    <h6 class="my-0">
                      <?php echo number_format($contentCarrito['precio_venta'] * $_SESSION['carritoProcesado'][$value], 2); ?>
                    </h6>
                    <small class="text-muted"><?php echo 'Cantidad: ' . $_SESSION['carritoProcesado'][$value]; ?></small>
                  </div>
                </li>
            <?php
              }
            }
            ?>
            <li class="list-group-item d-flex justify-content-between bg-light">
              <div class="text-success">
                <h6 class="my-0">Valor del Envio</h6>
                <small></small>
              </div>
              <strong class="text-success">$8,00</strong>
            </li>

            <li class="list-group-item d-flex justify-content-between fs-5">
              <Strong>Total</Strong>
              <strong><?php echo number_format($subTotal +   8, 2); ?></strong>
            </li>
          </ul>

        </div>
        <div class="col-md-7 col-lg-8">
          <h4 class="mb-3">Dirección de Envio</h4>
          <form action="ProcesarCompra.php" method="post" class="needs-validation" novalidate>
            <div class="row g-3">
              <div class="col-sm-6">
                <label for="firstName" class="form-label fw-bold">Nombre</label>
                <input type="text" name="firstName" class="form-control" id="firstName" value="<?php echo $content['nombre']; ?>" placeholder="Benito" required>
                <div class="invalid-feedback">
                  Pendiente
                </div>
              </div>

              <div class="col-sm-6 ">
                <label for="lastName" class="form-label fw-bold">Apellido</label>
                <input type="text" name="lastName" class="form-control" id="lastName" value="<?php echo $content['apellido']; ?>" placeholder="Velez Molano" required>
                <div class="invalid-feedback">
                  Pendiente
                </div>


              </div>

              <div class="col-12 ">
                <label for="email" class="form-label fw-bold">Correo</label>
                <div class="input-group has-validation">
                  <span class="input-group-text">@</span>
                  <input type="email" name="email" class="form-control" id="email" value="<?php echo $content['email']; ?>" placeholder="benito@example.com">
                </div>
                <div class="invalid-feedback">
                  Pendiente
                </div>
              </div>

              <div class="col-12">
                <label for="address" class="form-label fw-bold">Dirección</label>
                <input type="text" name="direccion" class="form-control" value="<?php echo $content['direccion']; ?>" id="address" placeholder="Dg 36 # 12-12" required>
                <div class="invalid-feedback">
                  Pendiente
                </div>
              </div>

              <div class="col-12 ">
                <label for="phone" class="form-label fw-bold">Celular</label>
                <input type="tel" name="telPrincipal" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" value="<?php echo $content['telefono']; ?>" class="form-control" id="phone" placeholder="300 734 5264" required>
              </div>

              <div class="col-12 ">
                <label for="phone" class="form-label fw-bold">Celular 2<span class="text-muted">
                    (Opcional)</span></label>
                <input type="tel" name="telOpcional" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" class="form-control" id="phone" placeholder="300 734 5264">
              </div>

              <div class="col-md-4  ">
                <label for="state" class="form-label fw-bold">Departamento</label>
                <select name="region" class="form-select" id="state" required>
                  <option value="Amazonas">Amazonas</option>
                  <option value="Antioquia">Antioquia</option>
                  <option value="Arauca">Arauca</option>
                  <option value="Atlántico">Atlántico</option>
                  <option value="Bolívar">Bolívar</option>
                  <option value="Boyacá">Boyacá</option>
                  <option value="Caldas">Caldas</option>
                  <option value="Caquetá">Caquetá</option>
                  <option value="Casanare">Casanare</option>
                  <option value="Cauca">Cauca</option>
                  <option value="Cesar">Cesar</option>
                  <option value="Chocó">Chocó</option>
                  <option value="Córdoba">Córdoba</option>
                  <option value="Cundinamarca">Cundinamarca</option>
                  <option value="Guainía">Guainía</option>
                  <option value="Guaviare">Guaviare</option>
                  <option value="Huila">Huila</option>
                  <option value="La Guajira">La Guajira</option>
                  <option value="Magdalena">Magdalena</option>
                  <option value="Meta">Meta</option>
                  <option value="Nariño">Nariño</option>
                  <option value="Norte de Santander">Norte de Santander</option>
                  <option value="Putumayo">Putumayo</option>
                  <option value="Quindío">Quindío</option>
                  <option value="Risaralda">Risaralda</option>
                  <option value="San Andrés y Providencia">San Andrés y Providencia</option>
                  <option value="Santander">Santander</option>
                  <option value="Sucre">Sucre</option>
                  <option value="Tolima">Tolima</option>
                  <option value="Valle del Cauca">Valle del Cauca</option>
                  <option value="Vaupés">Vaupés</option>
                  <option value="Vichada">Vichada</option>
                </select>
                <div class="invalid-feedback">
                  Pendiente
                </div>
              </div>

              <div class="col-md-3  ">
                <label for="zip" class="form-label fw-bold">Barrio</label>
                <input type="text" name="barrio" class="form-control" id="barrio" placeholder="Florencia" required>
                <div class="invalid-feedback">
                  Pendiente
                </div>
              </div>

              <div class="col-md-3  ">
                <label for="zip" class="form-label fw-bold">Código postal<span class="text-muted">
                    (Opcional)</span></label>
                <input type="text" name="postalCode" class="form-control" id="zip" placeholder="051051" required>
                <div class="invalid-feedback">
                  Pendiente
                </div>
              </div>

              <h4 class="mb-3 mt-3">Datos del medio de pago</h4>

              <div class="col-sm-6">
                <label for="nombreTarjeta" class="form-label fw-bold">Nombre de la tarjeta debito</label>
                <input type="text" name="nombreTarjeta" class="form-control" id="nombreTarjeta" placeholder="Benito A Ramirez J" required>
                <div class="invalid-feedback">
                  Pendiente
                </div>
              </div>

              <div class="col-sm-6">
                <label for="numeroTarjeta" class="form-label fw-bold">Numero Tarjeta</label>
                <input type="number" name="numeroTarjeta" class="form-control" id="numeroTarjeta" placeholder="XXXX XXXX XXXX XXXX" required>
                <div class="invalid-feedback">
                  Pendiente
                </div>
              </div>

              <div class="col-sm-6">
                <label for="cvc" class="form-label fw-bold">CVC</label>
                <input type="number" name="cvc" class="form-control" id="cvc" placeholder="XXX" required>
                <div class="invalid-feedback">
                  Pendiente
                </div>
              </div>

              <div class="col-sm-6">
                <label for="fechaVencimiento" class="form-label fw-bold">Fecha de vencimiento</label>
                <input type="text" name="fechaVencimiento" class="form-control" id="fechaVencimiento" placeholder="MM/AA" required>
                <div class="invalid-feedback">
                  Pendiente
                </div>
              </div>
            </div>
            <br>
            <center> <?php include '../include/ToolTipError.php'; ?></center>

            <br>
            <div class="row justify-content-between">
              <div class="col-md-4 ">
                <a href="javascript:history.back()" style="width: 200px;" class="btn btn-warning btn-block">Regresar</a>
              </div>
              <div class="col-md-4">
                <button class="btn btn-primary" style="width: 200px;" type="submit">Realizar Pago</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </main>
    <br><br>
  </div>
  <?php include "../include/footer.php" ?>
  <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../checkout/form-validation.js"></script>

</body>

</html>