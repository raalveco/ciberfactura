<?php
namespace Raalveco\Ciberfactura\Models;

use \Illuminate\Database\Eloquent\Model;

class CfdiEmisor extends Model{
    protected $table = "cfdi_v33_emisores";

    protected $fillable = ['cfdi_id','rfc','nombre','regimen_fiscal'];
}