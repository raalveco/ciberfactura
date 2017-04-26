<?php
namespace Raalveco\Ciberfactura\Models;

use \Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Raalveco\Ciberfactura\Libraries\CfdiException;

class CfdiReceptor extends Model{
    protected $table = "cfdi_v33_receptores";

    protected $fillable = ['cfdi_id','rfc','nombre','residencia_fiscal','num_reg_id_trib','uso_cfdi'];

    protected static $rules = [
        "cfdi_id" => "required",
        "rfc" => "required",
        "uso_cfdi" => "required"
    ];

    protected static $messages = [
        'cfdi_id.required' => 'El Cfdi al que pertenece el Receptor es obligatorio.',
        'rfc.required' => 'El Rfc del Receptor es obligatorio.',
        'uso_cfdi.required' => 'El Uso del CFDI del Receptor es obligatorio.'
    ];

    public static function create($data){
        $validator = Validator::make($data, CfdiReceptor::$rules, CfdiReceptor::$messages);

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