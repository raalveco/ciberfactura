<?php
    namespace Raalveco\Ciberfactura\Libraries;

    use Raalveco\Ciberfactura\Models\CfdiFactura;

    class CfdiGenerator{
        public $xml;
        public $cfdi;

        public function __construct(CfdiFactura $cfdi){
            $this->cfdi = $cfdi;

            //Comprobante
            $comprobante = new CfdiNodo("cfdi:Comprobante");
            $comprobante->agregarAtributo("xsi:schemaLocation", "http://www.sat.gob.mx/cfd/3 http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv33.xsd http://www.sat.gob.mx/sitio_internet/cfd/catalogos http://www.sat.gob.mx/sitio_internet/cfd/catalogos/catCFDI.xsd http://www.sat.gob.mx/sitio_internet/cfd/tipoDatos/tdCFDI http://www.sat.gob.mx/sitio_internet/cfd/tipoDatos/tdCFDI/tdCFDI.xsd");
            $comprobante->agregarAtributo("xmlns:tdCFDI", "http://www.sat.gob.mx/sitio_internet/cfd/tipoDatos/tdCFDI");
            $comprobante->agregarAtributo("xmlns:catCFDI", "http://www.sat.gob.mx/sitio_internet/cfd/catalogos");
            $comprobante->agregarAtributo("xmlns:cfdi", "http://www.sat.gob.mx/cfd/3");
            $comprobante->agregarAtributo("xmlns:xsi", "http://www.w3.org/2001/XMLSchema-instance");

            $comprobante->agregarAtributo("Version", $cfdi->version);

            if($cfdi->serie){
                $comprobante->agregarAtributo("Serie", $cfdi->serie);
            }

            if($cfdi->folio){
                $comprobante->agregarAtributo("Folio", $cfdi->folio);
            }

            $comprobante->agregarAtributo("Fecha", date("Y-m-d")."T".date("H:i:s"));

            $comprobante->agregarAtributo("FormaPago", $cfdi->forma_pago);

            if($cfdi->condiciones_de_pago){
                $comprobante->agregarAtributo("CondicionesDePago", $cfdi->condiciones_de_pago);
            }

            $comprobante->agregarAtributo("SubTotal", $cfdi->sub_total);

            if($cfdi->descuento){
                $comprobante->agregarAtributo("Descuento", $cfdi->descuento);
            }

            $comprobante->agregarAtributo("Moneda", $cfdi->moneda);

            if($cfdi->tipo_cambio){
                $comprobante->agregarAtributo("TipoCambio", $cfdi->tipo_cambio);
            }

            $comprobante->agregarAtributo("Total", $cfdi->total);
            $comprobante->agregarAtributo("TipoDeComprobante", $cfdi->tipo_de_comprobante);

            if($cfdi->metodo_pago){
                $comprobante->agregarAtributo("MetodoPago", $cfdi->metodo_pago);
            }

            $comprobante->agregarAtributo("LugarExpedicion", $cfdi->lugar_expedicion);

            $this->cfdi = $comprobante;

            $cfdi_emisor = $cfdi->emisor;

            //Emisor
            $emisor = new CfdiNodo("cfdi:Emisor");
            $emisor->agregarAtributo("Rfc", $cfdi_emisor->rfc);
            $emisor->agregarAtributo("Nombre", $cfdi_emisor->nombre);
            $emisor->agregarAtributo("RegimenFiscal", $cfdi_emisor->regimen_fiscal);
            $comprobante->agregarNodo($emisor);

            $cfdi_receptor = $cfdi->receptor;

            //Receptor
            $receptor = new CfdiNodo("cfdi:Receptor");
            $receptor->agregarAtributo("Rfc", $cfdi_receptor->rfc);
            $receptor->agregarAtributo("Nombre", $cfdi_receptor->nombre);

            if($cfdi_receptor->residencia_fiscal){
                $receptor->agregarAtributo("ResidenciaFiscal", $cfdi_receptor->residencia_fiscal);
            }

            if($cfdi_receptor->num_reg_id_trib){
                $receptor->agregarAtributo("NumRegIdTrib", $cfdi_receptor->num_reg_id_trib);
            }

            $receptor->agregarAtributo("UsoCFDI", $cfdi_receptor->uso_cfdi);
            $comprobante->agregarNodo($receptor);

            $cfdi_conceptos = $cfdi->conceptos;

            //Conceptos
            $conceptos = new CfdiNodo("cfdi:Conceptos");

            if($cfdi_conceptos) foreach($cfdi_conceptos as $cfdi_concepto){
                $concepto = new CfdiNodo("cfdi:Concepto");

                $concepto->agregarAtributo("ClaveProdServ", $cfdi_concepto->clave_prod_serv);

                if($cfdi_concepto->no_identificacion){
                    $concepto->agregarAtributo("NoIdentificacion", $cfdi_concepto->no_identificacion);
                }

                $concepto->agregarAtributo("Cantidad", $cfdi_concepto->cantidad);
                $concepto->agregarAtributo("ClaveUnidad", $cfdi_concepto->clave_unidad);

                if($cfdi_concepto->unidad){
                    $concepto->agregarAtributo("Unidad", $cfdi_concepto->unidad);
                }

                $concepto->agregarAtributo("Descripcion", $cfdi_concepto->descripcion);
                $concepto->agregarAtributo("ValorUnitario", $cfdi_concepto->valor_unitario);
                $concepto->agregarAtributo("Importe", $cfdi_concepto->importe);

                if($cfdi_concepto->descuento){
                    $concepto->agregarAtributo("Descuento", $cfdi_concepto->descuento);
                }

                $impuestos = new CfdiNodo("cfdi:Impuestos");

                $traslados = new CfdiNodo("cfdi:Traslados");
                $retenciones = new CfdiNodo("cfdi:Retenciones");

                $cfdi_impuestos = $cfdi_concepto->impuestos;

                if($cfdi_impuestos) foreach($cfdi_impuestos as $cfdi_impuesto){
                    if($cfdi_impuesto->type == "traslado"){
                        $traslado = new CfdiNodo("cfdi:Traslado");

                        $traslado->agregarAtributo("Base", $cfdi_impuesto->base);
                        $traslado->agregarAtributo("Impuesto", $cfdi_impuesto->impuesto);
                        $traslado->agregarAtributo("TipoFactor", $cfdi_impuesto->tipo_factor);

                        if($cfdi_impuesto->tipo_factor == "Tasa" || $cfdi_impuesto->tipo_factor == "Cuota"){
                            $traslado->agregarAtributo("TasaOCuota", $cfdi_impuesto->tasa_o_cuota);
                            $traslado->agregarAtributo("Importe", $cfdi_impuesto->importe);
                        }

                        $traslados->agregarNodo($traslado);
                    }

                    if($cfdi_impuesto->type == "retencion"){
                        $retencion = new CfdiNodo("cfdi:Retencion");

                        $retencion->agregarAtributo("Base", $cfdi_impuesto->base);
                        $retencion->agregarAtributo("Impuesto", $cfdi_impuesto->impuesto);
                        $retencion->agregarAtributo("TipoFactor", $cfdi_impuesto->tipo_factor);

                        if($cfdi_impuesto->tipo_factor == "Tasa" || $cfdi_impuesto->tipo_factor == "Cuota"){
                            $retencion->agregarAtributo("TasaOCuota", $cfdi_impuesto->tasa_o_cuota);
                            $retencion->agregarAtributo("Importe", $cfdi_impuesto->importe);
                        }

                        $retenciones->agregarNodo($retencion);
                    }
                }

                if(count($traslados->nodos) > 0){
                    $impuestos->agregarNodo($traslados);
                }

                if(count($retenciones->nodos) > 0){
                    $impuestos->agregarNodo($retenciones);
                }

                if(count($impuestos->nodos) > 0){
                    $concepto->agregarNodo($impuestos);
                }

                $conceptos->agregarNodo($concepto);
            }

            $comprobante->agregarNodo($conceptos);

            $impuestos = new CfdiNodo("cfdi:Impuestos");

            $codigos_traslado = $cfdi->impuestos()->where("type","traslado")->groupBy("impuesto")->pluck("impuesto");
            $codigos_retencion = $cfdi->impuestos()->where("type","retencion")->groupBy("impuesto")->pluck("impuesto");

            if($codigos_retencion->count() > 0){
                $retenciones = new CfdiNodo("cfdi:Retenciones");

                $retenciones_total = 0;

                foreach($codigos_retencion as $codigo){
                    $importe = $cfdi->impuestos()->where("type","retencion")->where("impuesto", $codigo)->sum("importe");

                    $retencion = new CfdiNodo("cfdi:Retencion");
                    $retencion->agregarAtributo("Impuesto", $codigo);
                    $retencion->agregarAtributo("Importe", $importe);

                    $retenciones->agregarNodo($retencion);

                    $retenciones_total += $importe;
                }

                $impuestos->agregarAtributo("TotalImpuestosRetenidos", $retenciones_total);
                $impuestos->agregarNodo($retenciones);
            }

            if($codigos_traslado->count() > 0){
                $traslados = new CfdiNodo("cfdi:Traslados");

                $traslados_total = 0;

                $cfdi_impuestos = $cfdi->impuestos()->where("type","traslado")->get();

                foreach($cfdi_impuestos as $impuesto){


                    $traslado = new CfdiNodo("cfdi:Traslado");
                    $traslado->agregarAtributo("Impuesto", $impuesto->impuesto);
                    $traslado->agregarAtributo("TipoFactor", $impuesto->tipo_factor);

                    if($impuesto->tipo_factor == "Tasa" || $impuesto->tipo_factor == "Cuota"){
                        $traslado->agregarAtributo("TasaOCuota", $impuesto->tasa_o_cuota);
                        $traslado->agregarAtributo("Importe", $impuesto->importe);
                    }

                    $traslados->agregarNodo($traslado);

                    $traslados_total += $importe;
                }

                $impuestos->agregarAtributo("TotalImpuestosTrasladados", $traslados_total);
                $impuestos->agregarNodo($traslados);
            }

            $comprobante->agregarNodo($impuestos);

            $this->cfdi = $comprobante;
        }

        public function addendar(){
            //Addenda
            $addenda = new CfdiNodo("cfdi:Addenda");
            $this->cfdi->agregarNodo($addenda);
        }

        public function timbrar($timbre){
            $complemento = new CfdiNodo("cfdi:Complemento");

            $timbre_fiscal = new CfdiNodo("tfd:TimbreFiscalDigital");

            $timbre_fiscal->agregarAtributo("xmlns:tfd", "http://www.sat.gob.mx/TimbreFiscalDigital");
            $timbre_fiscal->agregarAtributo("xsi:schemaLocation", $timbre["schemaLocation"]);
            $timbre_fiscal->agregarAtributo("version", $timbre[0]["version"]);
            $timbre_fiscal->agregarAtributo("FechaTimbrado", $timbre[0]["FechaTimbrado"]);
            $timbre_fiscal->agregarAtributo("selloCFD", $timbre[0]["selloCFD"]);
            $timbre_fiscal->agregarAtributo("noCertificadoSAT", $timbre[0]["noCertificadoSAT"]);
            $timbre_fiscal->agregarAtributo("selloSAT", $timbre[0]["selloSAT"]);
            $timbre_fiscal->agregarAtributo("UUID", $timbre[0]["UUID"]);

            $complemento->agregarNodo($timbre_fiscal);
            $this->cfdi->agregarNodo($complemento);
        }

        public function sellar($sello, $noCertificado, $certificado){
            $this->cfdi->agregarAtributo("Sello", $sello);
            $this->cfdi->agregarAtributo("NoCertificado", $noCertificado);
            $this->cfdi->agregarAtributo("Certificado", $certificado);
        }

        public function getXML($format = true){
            $this->xml = new \DOMDocument('1.0' , 'UTF-8');
            $this->xml->appendChild($this->xmlizar($this->cfdi));
            $this->xml->formatOutput = $format;
            $xml = $this->xml->saveXML();

            return $xml;
        }

        public function saveFile($file, $format = true){
            $this->xml = new \DOMDocument('1.0' , 'UTF-8');
            $this->xml->appendChild($this->xmlizar($this->cfdi));
            $this->xml->formatOutput = $format;
            $this->xml->save($file);
        }

        public function saveXML($file, $format = true){
            $this->saveFile($file, $format);
        }

        public function xmlizar($nodo){
            $xml = $this->xml->createElement($nodo->nombre);

            if($nodo->atributos) foreach($nodo->atributos as $nombre => $valor){
                $tmp = $this->xml->createAttribute($nombre);
                $tmp->value = $valor;
                $xml->appendChild($tmp);
            }

            if($nodo->nodos) foreach($nodo->nodos as $n){
                $tmp = $this->xmlizar($n);
                $xml->appendChild($tmp);
            }

            return $xml;
        }
    }