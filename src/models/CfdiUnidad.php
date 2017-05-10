<?php
namespace Raalveco\Ciberfactura\Models;

use \Illuminate\Database\Eloquent\Model;

class CfdiUnidad extends Model{
    protected $table = "cfdi_v33_unidades";

    protected $fillable = ['code', 'name'];
}