<?php
class Pokemon {
    private string $nombre;
    private string $elemento;
    private string $tipo;
    private array $movimientos;
    private int $nivel;
    private array $vida;

    public function __construct($nombre, $elemento, $tipo, $movimiento, $danio, $precision, $usos) {
        $this->nombre = $nombre;
        $this->elemento = $elemento;
        $this->tipo = $tipo;
        $this->movimientos[]['nombre'] = $movimiento;
        $this->movimientos[]['tipo'] = $tipo;
        $this->movimientos[]['danio'] = $danio;
        $this->movimientos[]['precision'] = $precision;
        $this->movimientos[]['usos'] = $usos;
        $this->nivel = 1;
        $this->vida['actual'] = 100;
        $this->vida['total'] = 100;
    }

    public function getNombre() {
    return $this->nombre;
}

    public function Atacar(){
        return $this->nombre . " ataca con " . $this->ataque . " y causa daño.";
    }
    

    public function Evolucionar(){
        $this->nivel++;
        $this->vida['total'] += 20;
        $this->vida['actual'] += 20;
        return $this->nombre . " ha evolucionado al nivel " . $this->nivel . " y ahora tiene " . $this->vida['total'] . " puntos de vida.";
    }

    public function MostrarInfo() : string {
    return 
        "<p>Nombre: " . $this->nombre . "</p>" .
        "<p>Elemento: " . $this->elemento . "</p>" .
        "<p>Tipo: " . $this->tipo . "</p>" .
        "<p>Nivel: " . $this->nivel . "</p>" .
        "<p>Vida: " . $this->vida['total']. " / ".$this->vida['actual'] . "</p>";
    }
    public function MostrarMovimientos() : array{
        return $this->movimientos;
    }
}
?>