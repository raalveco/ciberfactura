<?php
namespace Raalveco\Ciberfactura\Models\V32;

use \Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Raalveco\Ciberfactura\Libraries\CfdiException;

class CfdiConcepto extends Model{
    protected $table = "cfdi_v32_conceptos";

    protected $fillable = ['id', 'cfdi_id'];
}