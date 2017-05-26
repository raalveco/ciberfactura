<?php
namespace Raalveco\Ciberfactura\Models\V32;

use \Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Raalveco\Ciberfactura\Libraries\CfdiException;

class CfdiReceptor extends Model{
    protected $table = "cfdi_v32_receptores";

    protected $fillable = ['id', 'cfdi_id','rfc','nombre'];
}