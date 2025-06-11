<?php

namespace App\Exceptions;

use Exception;

class GuiaRemisionException extends Exception
{
    public static function codigoExistente(string $codigo): self
    {
        return new self("Ya existe una guía con el código: {$codigo}");
    }
    
    public static function productoNoEncontrado(string $codigo): self
    {
        return new self("No se encontró el producto con código: {$codigo}");
    }
    
    public static function cantidadExcedida(int $disponible, int $solicitada): self
    {
        return new self("Cantidad excedida. Disponible: {$disponible}, Solicitada: {$solicitada}");
    }
}