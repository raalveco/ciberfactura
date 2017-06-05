<?php
namespace Raalveco\Ciberfactura\Libraries\V32;

use App\Models\Folio;
use Illuminate\Support\Str;
use Raalveco\Ciberfactura\Models\V32\CfdiComplemento;
use Raalveco\Ciberfactura\Models\V32\CfdiFactura;

class Cfdi extends CfdiBase{
    public function __construct(){
        parent::__construct();
    }

    public function cadenaOriginal(){
        $this->cadenaOriginal = $this->originalString();
        return $this->cadenaOriginal;
    }

    public function sellar(){
        $this->sello = $this->signData($this->key, $this->cadenaOriginal);

        $this->cfdi->sello = $this->sello;
        $this->cfdi->save();

        $this->xml->sellar($this->sello, $this->noCertificado, $this->certificado);

        return $this->sello;
    }

    public function timbrar(){
        $timbrador = new CfdiTimbrador($this->rfc, $this->certificate, $this->production);

        $response = $timbrador->timbrar($this->xml->getXML());

        $tmp = substr($response->TimbrarXMLResult, strpos($response->TimbrarXMLResult, 'xsi:schemaLocation="') + 20);
        $tmp = substr($tmp, 0, strpos($tmp, '"'));

        $timbre = simplexml_load_string($response->TimbrarXMLResult);
        $timbre[0]["schemaLocation"] = str_replace('"', '', $tmp);

        CfdiComplemento::create([
            'cfdi_id' => $this->cfdi->id,
            'version' => (string)$timbre[0]["version"],
            'uuid' => strtoupper((string)$timbre[0]["UUID"]),
            'fecha_timbrado' => (string)$timbre[0]["FechaTimbrado"],
            'sello_cfd' => (string)$timbre[0]["selloCFD"],
            'no_certificado_sat' => (string)$timbre[0]["noCertificadoSAT"],
            'sello_sat' => (string)$timbre[0]["selloSAT"]
        ]);

        $this->cfdi->uuid = strtoupper((string)$timbre[0]["UUID"]);
        $this->cfdi->save();

        $this->xml->timbrar($timbre);
    }

    public function cancelar($path = false){
        try{
            $timbrador = new CfdiTimbrador($this->rfc, $this->certificate, $this->production);

            if($this->production){
                $response = $timbrador->cancelar($this->cfdi->uuid);
            }
            else{
                $response = "CANCELED";
            }

            if(!$path){
                file_put_contents(public_path()."/cfdis/".strtoupper($this->cfdi->uuid)."_ACUSE_CANCELACION.xml",$response);
            }
            else{
                file_put_contents($path,$response);
            }

            return $response;
        }
        catch(CfdiException $e){
            throw $e;
        }
    }

    public function guardar($path = false){
        if(!$path){
            $this->xml->saveFile(public_path()."/cfdis/".strtoupper($this->cfdi->uuid).".xml");
        }
        else{
            $this->xml->saveFile($path);
        }
    }

    public function addendar(){
        $this->xml->addendar();
    }

}