<?php
require_once 'Pokemon.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Pokemon</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <section>
        <a href="gestion.php">Ir a gestión</a>
        <a href="crearentrenadora.php">Ir a entrenadoras</a>
        <a href="combate.php">Combate Pokemon</a>
    </section>
    <section>
        <h1>Crear Pokemon</h1>
        <form method="POST" action="">
            <label for="nombre"><p>Nombre</p></label>
            <input type="text" name="nombre">
            <label for="elemento"><p>Elemento</p></label>
            <input type="text" name="elemento">
            <label for="tipo"><p>Tipo</p></label>
            <input type="text" name="tipo">
            <label for="movimiento"><p>Movimiento</p></label>
            <input type="text" name="movimiento" id="movimiento">
            <label for="dano"><p>Daño</p></label>
            <input type="number" name="dano" id="dano">
            <label for="precision"><p>Precision</p></label>
            <input type="number" name="precision" id="precision" min="10" max="100">
            <label for="usos"><p>Usos</p> </label>
            <input type="number" name="usos" id="usos" min="5" max="30">
            <p></p>
            <input type="submit" value="crear">
        </form>
    </section>

    <?php
    if(!isset($_SESSION["pokemons"])){
        $_SESSION["pokemons"]=[];
    }

    if(isset($_POST["nombre"], $_POST["elemento"], $_POST["tipo"], $_POST["movimiento"], $_POST["dano"], $_POST["precision"], $_POST["usos"])){
        $nombre = $_POST["nombre"];
        $elemento = $_POST["elemento"];
        $tipo = $_POST["tipo"];
        $movimiento = $_POST["movimiento"];
        $dano = $_POST["dano"];
        $precision = $_POST["precision"];
        $usos = $_POST["usos"];

        $pokemon = new Pokemon($nombre, $elemento, $tipo, $movimiento, $dano, $precision, $usos);
        $_SESSION["pokemons"][]=$pokemon;

        $mensaje= "Pokemon creado con éxito.";
    }

    if (isset($mensaje)){
        echo "<section>";
        echo "<p>$mensaje</p>";
        echo "</section>";
    }  

    ?>

    <section>
        <h2>Pokémon creados</h2>
        <?php
        if (count($_SESSION["pokemons"]) > 0) {
            foreach ($_SESSION["pokemons"] as $pokemon) {
                echo "<p>" . $pokemon->mostrarInfo() . "</p>";
            }
        } else {
            echo "<p>No hay Pokémon creados todavía</p>";
        }
        ?>
    </section>

</body>
</html>