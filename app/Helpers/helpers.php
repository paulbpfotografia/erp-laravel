<?php

use Ramsey\Uuid\Type\Decimal;


// Pinta con estilos dependiendo del estado del pedido

if (!function_exists('clase_estado_pedido')) {
    function clase_estado_pedido(string $estado): string
    {
        return match (strtolower($estado)) {
            'enviado'    => 'badge bg-info',
            'pendiente'  => 'badge bg-danger',
            'preparado'  => 'badge bg-warning',
            'recibido'   => 'badge bg-primary',
            'entregado'  => 'badge bg-success',
            default      => 'badge bg-secondary',
        };
    }
}


// Calcula en cada vista de pedido el total de cada artículo que lleva. Multiplica cantidad por precio unitario

if (!function_exists('calcular_total_pedido_por_producto')) {
    function calcular_total_pedido_por_producto(float $unit_price, int $quantity): float{
        return round($unit_price * $quantity, 2);
    }
}





