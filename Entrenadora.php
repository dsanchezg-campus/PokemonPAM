<?php
class Entrenadora{
    private $nombre;
    private $pokemons;
    private $equipo_pokemon;
    public function __construct($nombre){
        $this->nombre = $nombre;
        $this->pokemons = [];
        $this->equipo_pokemon = [];
    }

    public function CazarPokemon($pokemon){
        $this->pokemons[] = $pokemon;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function MostrarEquipo(){
        if(empty($this->equipo_pokemon)){
            return "<p>" . $this->nombre . " no tiene pokemons en su equipo.</p>";
        }
        $lista ="<h3>Equipo de " . $this->nombre . ":</h3>";
        foreach($this->equipo_pokemon as $pokemon){
            $lista .= "<div>" . $pokemon->MostrarInfo() . "</div><hr>";
        }
        return $lista;
    }

    public function MostrarInfo(){
        return "<p>Nombre: " . $this->nombre . "</p>" .
            "<p>Pokemons en el equipo: " . count($this->equipo_pokemon) . "</p>" .
            "<p>Pokemons capturados: " . count($this->pokemons) . "</p>";
    }

    public function anadirPokemonAlEquipo($pokemon){
        if(count($this->equipo_pokemon) >= 6){
            return $this->nombre . " ya tiene 6 pokemons en su equipo.";
        }

        foreach($this->equipo_pokemon as $miembro){
            if(method_exists($miembro, 'getNombre') && method_exists($pokemon, 'getNombre')){
                if($miembro->getNombre() === $pokemon->getNombre()){
                    return $pokemon->getNombre() . " ya forma parte del equipo de " . $this->nombre . ".";
                }
            }
        }

        $this->equipo_pokemon[] = $pokemon;
        return $pokemon->getNombre() . " se ha unido al equipo de " . $this->nombre . ".";
    }

    public function capturarPokemon($pokemon){
        $this->CazarPokemon($pokemon);
        return $this->anadirPokemonAlEquipo($pokemon);
    }
    public function EnsenarMovimiento(Pokemon $pokemon, $movimiento, $dano, $precision, $usos) : string{
        $pokemon->AprenderMovimientos($movimiento, $dano, $precision, $usos);
        return $pokemon->getNombre(). " ha aprendido ". $movimiento;
    }

}