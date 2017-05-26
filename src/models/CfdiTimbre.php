<?php
namespace Raalveco\Ciberfactura\Models\V33;

use \Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Raalveco\Ciberfactura\Libraries\CfdiException;

class CfdiTimbre extends Model{
    protected $table = "cfdi_v33_timbres";

    protected $fillable = ['cfdi_id','version','uuid','fecha_timbrado','rfc_prov_certif','sello_cfd','no_certificado_sat','sello_sat'];

    protected static $rules = [
        "cfdi_id" => "required",
        "version" => "required",
        "uuid" => "required",
        "fecha_timbrado" => "required",
        "rfc_prov_certif" => "required",
        "sello_cfd" => "required",
        "no_certificado_sat" => "required",
        "sello_sat" => "required"
    ];

    protected static $messages = [
        'cfdi_id.required' => 'El Cfdi al que pertenece el Concepto es obligatorio.',
        'version.required' => 'La Versión del Timbre es obligatoria.',
        'uuid.required' => 'El UUID asignado al CFDI es obligatorio.',
        'fecha_timbrado.required' => 'La fecha de timbrado es obligatoria.',
        'rfc_prov_certif.required' => 'El RFC del Proveedor que Certifica es obligatorio.',
        'sello_cfd.required' => 'El Sello Digital del CFDI es obligatorio.',
        'no_certificado_sat.required' => 'El Número de Certificado del SAT es obligatorio.',
        'sello_sat.required' => 'El Sello del SAT es obligatorio.'
    ];

    public static function create($data){
        $validator = Validator::make($data, CfdiTimbre::$rules, CfdiTimbre::$messages);

        if ($validator->fails()) {
            $errors = $validator->errors()->getMessages();

            if($errors){
                foreach($errors as $error){
                    throw new CfdiException($error[0]);
                }
            }
        }

        $cfdi_timbre = static::query()->create($data);

        return $cfdi_timbre;
    }
}