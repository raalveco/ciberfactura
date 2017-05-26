<?php
namespace Raalveco\Ciberfactura\Models\V33;

use \Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class CfdiImpuesto extends Model{
    protected $table = "cfdi_v33_impuestos";

    protected $fillable = ['cfdi_id','cfdi_concepto_id','type','base','impuesto','tipo_factor','tasa_o_cuota', 'importe'];

    protected static $rules = [
        "cfdi_id" => "required",
        "cfdi_concepto_id" => "required",
        "type" => "required",
        "base" => "required",
        "impuesto" => "required",
        "tipo_factor" => "required"
    ];

    protected static $messages = [
        'cfdi_id.required' => 'El Cfdi al que pertenece el Impuesto es obligatorio.',
        'cfdi_concepto_id.required' => 'El Concepto al que pertenece el Impuesto es obligatorio.',
        'type.required' => 'El Tipo del Impuesto es obligatorio.',
        'base.required' => 'La Base del Impuesto es obligatorio.',
        'impuesto.required' => 'La Clave del Impuesto es obligatorio.',
        'tipo_factor.required' => 'El Tipo de Factor del Impuesto es obligatorio.',
        'tasa_o_cuota.required' => 'La Tasa o la Cuota es un campo obligatorio.',
        'importe.required' => 'El Importe del Impuesto es obligatorio.',
    ];

    public static function create($data){
        $rules = CfdiImpuesto::$rules;

        if($data['tipo_factor'] == 'Tasa' || $data['tipo_factor'] == 'Couta'){
            $rules["tasa_o_cuota"] = 'required';
            $rules["importe"] = 'required';
        }

        $validator = Validator::make($data, $rules, CfdiImpuesto::$messages);

        if ($validator->fails()) {
            $errors = $validator->errors()->getMessages();

            if($errors){
                foreach($errors as $error){
                    throw new CfdiException($error[0]);
                }
            }
        }

        return static::query()->create($data);
    }
}