<?php
require_once 'Entrenadora.php';
require_once 'Pokemon.php';
session_start();

if (!isset($_SESSION['entrenadoras'])) {
    $_SESSION['entrenadoras'] = [];
}

if (!isset($_SESSION['pokemons'])) {
    $_SESSION['pokemons'] = [];
}

$mensaje = '';
$pokemonInfo = '';

if (isset($_POST['agregarPokemon'])) {
    $entrenadoraId = isset($_POST['entrenadora_agregar']) ? (int)$_POST['entrenadora_agregar'] : null;
    $pokemonId = isset($_POST['pokemon_agregar']) ? (int)$_POST['pokemon_agregar'] : null;
    if ($entrenadoraId !== null && $pokemonId !== null &&
        isset($_SESSION['entrenadoras'][$entrenadoraId]) &&
        isset($_SESSION['pokemons'][$pokemonId])) {
        $mensaje = $_SESSION['entrenadoras'][$entrenadoraId]
            ->capturarPokemon($_SESSION['pokemons'][$pokemonId]);
    } else {
        $mensaje = 'Selecciona una entrenadora y un pok�mon v�lidos.';
    }
}

if (isset($_POST['mostrarPokemon'])) {
    $pokemonInfoId = isset($_POST['pokemon_info_id']) ? (int)$_POST['pokemon_info_id'] : null;
    if ($pokemonInfoId !== null && isset($_SESSION['pokemons'][$pokemonInfoId])) {
        $pokemonInfo = $_SESSION['pokemons'][$pokemonInfoId]->MostrarInfo();
    } else {
        $pokemonInfo = '<p>Selecciona un pokemon valido.</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Pokemon</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<section>
    <h1>Gestionar Pokemons</h1>
    <?php if ($mensaje !== ''): ?>
        <p class="notice"><?php echo $mensaje; ?></p>
    <?php endif; ?>
    <?php if ($pokemonInfo !== ''): ?>
        <div class="pokemon-info">
            <?php echo $pokemonInfo; ?>
        </div>
    <?php endif; ?>
</section>

<section>
    <h2>Añadir Pokomon a un equipo</h2>
    <form method="POST" action="">
        <label for="entrenadora_agregar">Entrenadora</label>
        <select id="entrenadora_agregar" name="entrenadora_agregar" required>
            <option value="">Selecciona una entrenadora</option>
            <?php foreach ($_SESSION['entrenadoras'] as $id => $entrenadora): ?>
                <option value="<?php echo $id; ?>"><?php echo htmlspecialchars($entrenadora->getNombre()); ?></option>
            <?php endforeach; ?>
        </select>

        <label for="pokemon_agregar">Pok�mon</label>
        <select id="pokemon_agregar" name="pokemon_agregar" required>
            <option value="">Selecciona un pokemon</option>
            <?php foreach ($_SESSION['pokemons'] as $id => $pokemon): ?>
                <option value="<?php echo $id; ?>"><?php echo htmlspecialchars($pokemon->getNombre()); ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit" name="agregarPokemon">Agregar al equipo</button>
    </form>
</section>

<section>
    <h2>Ver informaci�n de un Pok�mon</h2>
    <form method="POST" action="">
        <label for="pokemon_info_id">Pok�mon</label>
        <select id="pokemon_info_id" name="pokemon_info_id" required>
            <option value="">Selecciona un pok�mon</option>
            <?php foreach ($_SESSION['pokemons'] as $id => $pokemon): ?>
                <option value="<?php echo $id; ?>"><?php echo htmlspecialchars($pokemon->getNombre()); ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit" name="mostrarPokemon">Mostrar informaci�n</button>
    </form>
</section>

<section>
    <h2>Entrenadoras creadas</h2>
    <?php if (count($_SESSION['entrenadoras']) > 0): ?>
        <?php foreach ($_SESSION['entrenadoras'] as $entrenadora): ?>
            <article class="card">
                <h3><?php echo htmlspecialchars($entrenadora->getNombre()); ?></h3>
                <?php echo $entrenadora->MostrarEquipo(); ?>
            </article>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No hay entrenadoras cargadas todavia.</p>
    <?php endif; ?>
</section>

<section>
    <h2>Pokemons disponibles</h2>
    <?php if (count($_SESSION['pokemons']) > 0): ?>
        <?php foreach ($_SESSION['pokemons'] as $pokemon): ?>
            <article class="card">
                <?php echo $pokemon->MostrarInfo(); ?>
            </article>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No hay pokemons registrados todavia.</p>
    <?php endif; ?>
</section>

<section>
    <a href="gestion.php">Volver a gesti�n</a>
</section>
</body>
</html>
