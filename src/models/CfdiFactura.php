<?php
namespace Raalveco\Ciberfactura\Models;

use \Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Raalveco\Ciberfactura\Libraries\CfdiException;

class CfdiFactura extends Model{
    protected $table = "cfdi_v33_facturas";

    protected $fillable = ['version','serie','folio','fecha','forma_pago','condiciones_de_pago','sub_total','descuento','moneda','tipo_cambio','total','tipo_de_comprobante','metodo_pago', 'lugar_expedicion'];

    protected static $rules = [
        "version" => "required",
        "fecha" => "required",
        "sub_total" => "required",
        "moneda" => "required",
        "total" => "required",
        "metodo_pago" => "required",
        "lugar_expedicion" => "required",
    ];

    protected static $messages = [
        'version.required' => 'La Versión del CFDI es obligatoria.',
        'fecha.required' => 'La Fecha del CFDI es obligatoria.',
        'sub_total.required' => 'El SubTotal del CFDI es obligatorio.',
        'moneda.required' => 'La Moneda del CFDI es obligatoria.',
        'total.required' => 'El Total del CFDI es obligatorio.',
        'metodo_pago.required' => 'El Método de Pago del CFDI es obligatorio.',
        'lugar_expedicion.required' => 'El Lugar de Expedición (Código Postal) del CFDI es obligatorio.',
    ];

    public static function create($data){
        $validator = Validator::make($data, CfdiFactura::$rules, CfdiFactura::$messages);

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

    public function addEmisor($data){
        if(!isset($data['cfdi_id'])){
            $data['cfdi_id'] = $this->id;
        }

        return CfdiEmisor::create($data);
    }

    public function addReceptor($data){
        if(!isset($data['cfdi_id'])){
            $data['cfdi_id'] = $this->id;
        }

        return CfdiReceptor::create($data);
    }

    public function addConcepto($data){
        if(!isset($data['cfdi_id'])){
            $data['cfdi_id'] = $this->id;
        }

        return CfdiConcepto::create($data);
    }

    public function emisor(){
        return $this->hasOne('Raalveco\Ciberfactura\Models\CfdiEmisor', 'cfdi_id');
    }

    public function receptor(){
        return $this->hasOne('Raalveco\Ciberfactura\Models\CfdiReceptor', 'cfdi_id');
    }

    public function conceptos(){
        return $this->hasMany('Raalveco\Ciberfactura\Models\CfdiConcepto', 'cfdi_id');
    }

    public function impuestos(){
        return $this->hasMany('Raalveco\Ciberfactura\Models\CfdiImpuesto', 'cfdi_id');
    }

    public function timbre(){
        return $this->hasOne('Raalveco\Ciberfactura\Models\CfdiTimbre', 'cfdi_id');
    }

    public static function validate($data, $rules, $messages){
        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            $errors = $validator->errors()->getMessages();

            if($errors){
                foreach($errors as $error){
                    throw new CfdiException($error[0]);
                }
            }

            return Redirect::back();
        }
    }
}