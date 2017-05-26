<?php
namespace Raalveco\Ciberfactura\Models\V33;

use \Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Raalveco\Ciberfactura\Libraries\CfdiException;

class CfdiConcepto extends Model{
    protected $table = "cfdi_v33_conceptos";

    protected $fillable = ['cfdi_id','clave_prod_serv','no_identificacion','cantidad','clave_unidad','unidad','descripcion','valor_unitario','importe','descuento','cfdi_impuesto_id'];

    protected static $rules = [
        "cfdi_id" => "required",
        "clave_prod_serv" => "required",
        "cantidad" => "required",
        "clave_unidad" => "required",
        "descripcion" => "required",
        "valor_unitario" => "required",
        "importe" => "required"
    ];

    protected static $messages = [
        'cfdi_id.required' => 'El Cfdi al que pertenece el Concepto es obligatorio.',
        'clave_prod_serv.required' => 'La Clave de Producto o Servicio del Concepto es obligatorio.',
        'cantidad.required' => 'La Cantidad del Concepto es obligatorio.',
        'clave_unidad.required' => 'La Clave de Unidad del Concepto es obligatorio.',
        'descripcion.required' => 'La Descripción del Concepto es obligatorio.',
        'valor_unitario.required' => 'El Valor Unitario del Concepto es obligatorio.',
        'importe.required' => 'El Importe del Concepto es obligatorio.',
    ];

    public static function create($data){
        $validator = Validator::make($data, CfdiConcepto::$rules, CfdiConcepto::$messages);

        if ($validator->fails()) {
            $errors = $validator->errors()->getMessages();

            if($errors){
                foreach($errors as $error){
                    throw new CfdiException($error[0]);
                }
            }
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $cfdi_concepto = static::query()->create($data);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return $cfdi_concepto;
    }

    public function addImpuesto($data){
        if(!isset($data['cfdi_id'])){
            $data['cfdi_id'] = $this->cfdi_id;
        }

        if(!isset($data['cfdi_concepto_id'])){
            $data['cfdi_concepto_id'] = $this->id;
        }

        $cfdi_impuesto = CfdiImpuesto::create($data);

        return $cfdi_impuesto;
    }

    public function impuestos(){
        return $this->hasMany('Raalveco\Ciberfactura\Models\CfdiImpuesto', 'cfdi_concepto_id');
    }
}