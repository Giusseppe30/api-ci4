<?php
namespace App\Models;

use CodeIgniter\Model;

class ProductosModel extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'producto_id';
    protected $allowedFields = ['nombre_producto','sabor_producto','precio_producto'];
}