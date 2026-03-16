<?php
require_once "Pokemon.php";
require_once "Entrenadora.php";
session_start();

$mensaje = "";

// Redirigir si no hay datos suficientes en la sesión
if (!isset($_SESSION["entrenadoras"]) || count($_SESSION["entrenadoras"]) < 2) {
    $mensaje = "Se necesitan al menos 2 entrenadoras creadas para combatir.";
} elseif (!isset($_SESSION["pokemons"]) || count($_SESSION["pokemons"]) < 2) {
    $mensaje = "Se necesitan al menos 2 Pokémon creados para combatir.";
}

//Comprobamos si se puede empezar el combate
if (isset($_POST["combatir"]) && isset($_POST["entrenadora1"]) && isset($_POST["entrenadora2"]) && isset($_POST["pokemon1"]) && isset($_POST["pokemon2"])) {
    $idEntrenadora1 = $_POST["entrenadora1"];
    $idEntrenadora2 = $_POST["entrenadora2"];
    $idPokemon1 = $_POST["pokemon1"];
    $idPokemon2 = $_POST["pokemon2"];

    if ($idEntrenadora1 === $idEntrenadora2) {
        $mensaje = "¡Una entrenadora no puede combatir contra sí misma!";
    } elseif ($idPokemon1 === $idPokemon2) {
        $mensaje = "¡No puedes usar exactamente el mismo Pokémon para ambas!";
    } else {
        // Obtenemos los objetos de la sesión
        $entrenadora1 = $_SESSION["entrenadoras"][$idEntrenadora1];
        $entrenadora2 = $_SESSION["entrenadoras"][$idEntrenadora2];
        $pokemon1 = $_SESSION["pokemons"][$idPokemon1];
        $pokemon2 = $_SESSION["pokemons"][$idPokemon2];

        // Construimos el resultado usando los métodos de tus clases
        $mensaje = "<h3>¡Empieza el combate!</h3>";
        $mensaje .= "<p><strong>" . $entrenadora1->getNombre() . "</strong> lanza a " . $pokemon1->getNombre() . ".</p>";
        $mensaje .= "<p><strong>" . $entrenadora2->getNombre() . "</strong> responde con " . $pokemon2->getNombre() . ".</p>";

        // Usamos el método Atacar() de en Pokemon.php
        $mensaje .= "<p>▶ " . $pokemon1->Atacar($pokemon2) . "</p>";
        $mensaje .= "<p>▶ " . $pokemon2->Atacar($pokemon2) . "</p>";

        $mensaje .= "<p><em>¡Ambos Pokémon han demostrado ser muy fuertes, es un empate técnico!</em></p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Combate Pokémon</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<h1>Estadio de Combate</h1>

<section>
    <?php if ($mensaje !== ""): ?>
        <div><?= $mensaje ?></div>
        <hr>
    <?php endif; ?>

    <form method="POST" action="">
        <h3>Esquina Roja</h3>
        <label>Entrenadora 1:</label>
        <select name="entrenadora1">
            <?php
            if (isset($_SESSION["entrenadoras"])) {
                foreach ($_SESSION["entrenadoras"] as $id => $entrenadora) {
                    echo "<option value='$id'>" . $entrenadora->getNombre() . "</option>";
                }
            }
            ?>
        </select>
        <br><br>
        <label>Pokémon de "<?= isset($entrenadora1) ? $entrenadora1->getNombre() : 'Entrenadora 1' ?>":</label>
        <select name="pokemon1">
            <?php
            if (isset($_SESSION["pokemons"])) {
                foreach ($_SESSION["pokemons"] as $id => $pokemon) {
                    echo "<option value='$id'>" . $pokemon->getNombre() . "</option>";
                }
            }
            ?>
        </select>

        <hr>

        <h3>Esquina Azul</h3>
        <label>Entrenadora 2:</label>
        <select name="entrenadora2">
            <?php
            if (isset($_SESSION["entrenadoras"])) {
                foreach ($_SESSION["entrenadoras"] as $id => $entrenadora) {
                    echo "<option value='$id'>" . $entrenadora->getNombre() . "</option>";
                }
            }
            ?>
        </select>
        <br><br>
        <label>Pokémon de "<?= isset($entrenadora2) ? $entrenadora2->getNombre() : 'Entrenadora 2' ?>":</label>
        <select name="pokemon2">
            <?php
            if (isset($_SESSION["pokemons"])) {
                foreach ($_SESSION["pokemons"] as $id => $pokemon) {
                    echo "<option value='$id'>" . $pokemon->getNombre() . "</option>";
                }
            }
            ?>
        </select>

        <br><br>
        <button type="submit" name="combatir">¡Iniciar Combate!</button>
    </form>
</section>

<section>
    <p><a href="gestion.php">Volver a Gestión</a></p>
    <p><a href="crearpokemon.php">Crear más Pokémon</a></p>
    <p><a href="crearentrenadora.php">Crear más Entrenadoras</a></p>
</section>
</body>
</html>
</body>
</html>


