<div class="position-fixed text-dark"
    style='left: 0px; top: 0px; width: 100vw; height: 100vw; background: rgba(0, 0, 0, 0.586); display: none;'
    id="AdvertenciaInfo">
    <div id='validacionCrud' class='p-3 text-center '>
        <h1 class='col col-12 my-auto mt-3'>Información</h1>
        <i class="fa-regular fa-circle-question m-3 text-primary" style='font-size: 60px;'></i>
        <p class='col col-12 m-auto fw-semibold'>Este artículo ya fue agregado al carrito, podrá editarlo cuando procese la
            compra</p>
    </div>
</div>

<div class="position-fixed text-dark"
    style='left: 0px; top: 0px; width: 100vw; height: 100vw; background: rgba(0, 0, 0, 0.586); display: none;'
    id="AdvertenciaCarritoVacio">
    <div id='validacionCrud' class='p-3 text-center '>
        <h1 class='col col-12 my-auto mt-3'>Información</h1>
        <i class="fa-regular fa-circle-question m-3 text-danger" style='font-size: 60px;'></i>
        <p class='col col-12 m-auto fw-semibold'>El carrito de compras actualmente se encuentra vacío, agrega más artículos para poder procesar la compra</p>
    </div>
</div>

<script>
<?php if(isset($errores)){echo $errores;}?>
    function informacionArticuloAgregado() {
        setTimeout(function(){
        const div = document.querySelector("#AdvertenciaInfo");
        div.style.display = "block";
    },0);

    setTimeout(function(){
        const div = document.querySelector("#AdvertenciaInfo");
        div.style.display = "none";
    },4000);
    }

    function carritoVacio() {
        setTimeout(function(){
        const div = document.querySelector("#AdvertenciaCarritoVacio");
        div.style.display = "block";
    },0);

    setTimeout(function(){
        const div = document.querySelector("#AdvertenciaCarritoVacio");
        div.style.display = "none";
        window.location.href = "../index.php";
    },4000);
    }
</script>