<?php
class ProductoCesta
{
    // Declaración de una propiedad
    public $id;
    public $unidades;
    public $foto;
    public $nombre;
    public $precio;
    public $oferta;


    // Declaración de un método
    public function crear($ident)
    {
        $this->id = $ident;
        $this->unidades = 1;
        return $this->check(1);
    }

    public function add()
    {
        $this->unidades += 1;
        if ($this->check(0))
            return true;
        else {
            $this->unidades -= 1;
            return false;
        }
    }

    public function sub()
    {
        $this->unidades -= 1;
        if ($this->unidades == 0)
            return false;
        else
            return true;
    }

    public function check($mod) //1: Check y añade datos; 0: Solo check
    {
        $xml = simplexml_load_file("../xml/productos.xml");
        foreach ($xml->children() as $producto) {
            if ($producto['id'] == $this->id) {
                if ($producto->stock >= $this->unidades) {
                    if ($mod) {
                        $this->foto = (string)$producto->imagen;
                        $this->nombre = (string)$producto->nombre;
                        $this->precio = (string)$producto->precio;
                        $this->oferta = (string)$producto->oferta;
                    }
                    return true;
                } else return false;
            }
        }
        return false;
    }
}
