<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bubblegum+Sans&family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bubblegum+Sans&family=Dancing+Script:wght@400..700&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/estiloModal.css">
    <title>Document</title>
</head>

<body>
    <script>
        AOS.init();
    </script>
    <header>
        <div class="overlay">
            <h1>TextilExport</h1>
            <h3>Líder en la industria textil</h3>
            <p>Especializada en la fabricación y exportación de productos textiles de alta calidad. Con años de experiencia en el mercado, TextilExport se ha ganado una reputación por su compromiso con la excelencia, la innovación y la satisfacción del cliente.</p>
            <br>
            <div class="arrow">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </header>
    <div class="container">
        <h2 data-aos="fade-up">Elige la categoria que mas te atraiga de nuestro catalogo.</h2>

        <div data-aos="fade-right" class="multi-button">
            <button id="allprod">Todos los productos</button>
            <button id="onlyTextiles">Productos Textiles</button>
            <button id="btnProm">Productos promocionales</button>
        </div>
        <div class="row">
            <div class="col-5 offset-4 p-5" style="display:none;" id="loader">
                <div class="spinner-border" style="width: 300px; height: 300px; color:white;" role="status">
                    <span class="sr-only"></span>
                </div>
            </div>

            <?php
            $db = json_decode(file_get_contents("db.json"), true);

            foreach ($db["productos"] as $producto) {
                echo '<div class="col-4 p-3" categoria="' . $producto["categoria"] . '">';
                echo '<a data-bs-toggle="modal" data-bs-target="#modalP" class="Amodal">';
                echo '<label hidden>' . $producto["codigo"] . '</label>';
                echo '<label hidden>' . $producto["descripcion"] . '</label>';
                echo '<label hidden>' . $producto["imagen"] . '</label>';
                echo '<label hidden>' . $producto["categoria"] . '</label>';
                echo '<label hidden>' . $producto["existencias"] . '</label>';
                echo '  <div class="containerC" style="background: url(\'' . $producto["imagen"] . '\'); background-size: 100% 100%;">';
                echo '    <div class="overlayC">';
                echo '      <div class="items"></div>';
                echo '      <div class="items head">';
                echo '        <p id="name">' . $producto["nombre"] . '</p>';
                echo '        <hr>';
                echo '      </div>';
                echo '      <div class="items price">';
                echo '        <p class="new" id="price">$' . $producto["precio"] . '</p>';
                echo '      </div>';
                echo '      <div class="items cart">';
                echo '        <i class="bi bi-info-circle-fill"></i>';
                echo '        <span>MAS INFORMACION</span>';
                echo '      </div>';
                echo '    </div>';
                echo '  </div>';
                echo ' </a>';
                echo '</div>';
            }


            ?>
        </div>
    </div>
    <?php
    include("modalProducto.php");
    ?>
</body>
<script src="js/modalLoadData.js"></script>
<script src="js/mostrarCategorias.js"></script>

</html>