<?php
namespace App\Models;

use CodeIgniter\Model;

class PersonasModel extends Model
{
    protected $table = 'personas';
    protected $primaryKey = 'persona_id';
    protected $allowedFields = ['nombre','apellido','edad'];
}