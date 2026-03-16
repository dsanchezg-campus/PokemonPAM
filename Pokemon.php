<?php
class Pokemon {
    private $nombre;
    private $elemento;
    private $tipo;
    private $ataque;
    private $nivel;
    private $vida;

    public function __construct($nombre, $elemento, $tipo, $ataque){
        $this->nombre = $nombre;
        $this->elemento = $elemento;
        $this->tipo = $tipo;
        $this->ataque = $ataque;
        $this->nivel = 1;
        $this->vida = 100;
    }

    public function getNombre() {
    return $this->nombre;
}

    public function Atacar(){
        return $this->nombre . " ataca con " . $this->ataque . " y causa daño.";
    }
    

    public function Evolucionar(){
        $this->nivel++;
        $this->vida += 20;
        return $this->nombre . " ha evolucionado al nivel " . $this->nivel . " y ahora tiene " . $this->vida . " puntos de vida.";
    }

    public function MostrarInfo(){
    return 
        "<p>Nombre: " . $this->nombre . "</p>" .
        "<p>Elemento: " . $this->elemento . "</p>" .
        "<p>Tipo: " . $this->tipo . "</p>" .
        "<p>Ataque: " . $this->ataque . "</p>" .
        "<p>Nivel: " . $this->nivel . "</p>" .
        "<p>Vida: " . $this->vida . "</p>";
    }

}
?>