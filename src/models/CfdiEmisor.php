<?php
namespace Raalveco\Ciberfactura\Models;

use \Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Raalveco\Ciberfactura\Libraries\CfdiException;

class CfdiEmisor extends Model{
    protected $table = "cfdi_v33_emisores";

    protected $fillable = ['cfdi_id','rfc','nombre','regimen_fiscal'];

    protected static $rules = [
        "cfdi_id" => "required",
        "rfc" => "required",
        "regimen_fiscal" => "required"
    ];

    protected static $messages = [
        'cfdi_id.required' => 'El Cfdi al que pertenece el Emisor es obligatorio.',
        'rfc.required' => 'El Rfc del Emisor es obligatorio.',
        'regimen_fiscal.required' => 'El Regimen Fiscal del Emisor es obligatorio.'
    ];

    public static function create($data){
        $validator = Validator::make($data, CfdiEmisor::$rules, CfdiEmisor::$messages);

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