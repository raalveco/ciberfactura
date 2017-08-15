<?php
    namespace Raalveco\Ciberfactura\Libraries;

    use Illuminate\Support\Str;
    use Raalveco\Ciberfactura\Models\CfdiFactura;

    class CfdiGenerator{
        public $xml;
        public $cfdi;
        public $complemento;

        public function __construct(CfdiFactura $cfdi, $ine = false){
            $this->cfdi = $cfdi;

            //Comprobante
            $comprobante = new CfdiNodo("cfdi:Comprobante");

            if($ine){
                $comprobante->agregarAtributo("xmlns:cfdi", "http://www.sat.gob.mx/cfd/3");
                $comprobante->agregarAtributo("xmlns:ine", "http://www.sat.gob.mx/ine");
                $comprobante->agregarAtributo("xmlns:xsi", "http://www.w3.org/2001/XMLSchema-instance");
                $comprobante->agregarAtributo("xsi:schemaLocation", "http://www.sat.gob.mx/cfd/3 http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv32.xsd http://www.sat.gob.mx/ine http://www.sat.gob.mx/sitio_internet/cfd/ine/ine11.xsd");
            }
            else{
                $comprobante->agregarAtributo("xmlns:cfdi", "http://www.sat.gob.mx/cfd/3");
                $comprobante->agregarAtributo("xmlns:xsi", "http://www.w3.org/2001/XMLSchema-instance");
                $comprobante->agregarAtributo("xsi:schemaLocation", "http://www.sat.gob.mx/cfd/3 http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv32.xsd");
            }

            $comprobante->agregarAtributo("version", "3.2");

            if($cfdi->serie){
                $comprobante->agregarAtributo("serie", $cfdi->serie);
            }
            
            if($cfdi->folio){
                $comprobante->agregarAtributo("folio", $cfdi->folio);
            }

            $comprobante->agregarAtributo("fecha", date("Y-m-d")."T".date("H:i:s"));

            $comprobante->agregarAtributo("formaDePago", "PAGO EN UNA SOLA EXHIBICION");
            $comprobante->agregarAtributo("total", number_format($cfdi->total,4,".",""));
            $comprobante->agregarAtributo("subTotal", number_format($cfdi->subTotal,4,".",""));

            if($cfdi->descuento > 0){
                $comprobante->agregarAtributo("descuento", number_format($cfdi->descuento,4,".",""));
                $comprobante->agregarAtributo("motivoDescuento", $cfdi->motivoDescuento ? $cfdi->motivoDescuento : "Descuento General");
            }

            $comprobante->agregarAtributo("LugarExpedicion", "MÉXICO");
            $comprobante->agregarAtributo("metodoDePago", $cfdi->metodoPago ? $cfdi->metodoPago : "NO IDENTIFICADO");
            $comprobante->agregarAtributo("tipoDeComprobante", $cfdi->tipoDeComprobante ? strtolower($cfdi->tipoDeComprobante) : "ingreso");

            if(isset($cfdi->numCtaPago) && $cfdi->numCtaPago){
                $comprobante->agregarAtributo("NumCtaPago", $cfdi->numCtaPago ? substr($cfdi->numCtaPago,strlen($cfdi->numCtaPago) - 4) : "");
            }

            $comprobante->agregarAtributo("Moneda", $cfdi->moneda ? $cfdi->moneda : "MXN");

            if(isset($cfdi->tipoCambio) && $cfdi->tipoCambio && $cfdi->tipoCambio*1 != 1 && $cfdi->tipoCambio*1 > 0){
                $comprobante->agregarAtributo("TipoCambio", $cfdi->tipoCambio ? number_format($cfdi->tipoCambio*1,4,".","") : "");
            }

            $cfdi_emisor = $cfdi->emisor();

            //Emisor
            $emisor = new CfdiNodo("cfdi:Emisor");
            $emisor->agregarAtributo("rfc", $cfdi_emisor->rfc);
            $emisor->agregarAtributo("nombre", $cfdi_emisor->nombre);
            $comprobante->agregarNodo($emisor);

            //Emisor - Domicilio Fiscal
            $domicilioFiscal = new CfdiNodo("cfdi:DomicilioFiscal");
            if($cfdi_emisor->calle) $domicilioFiscal->agregarAtributo("calle", $cfdi_emisor->calle);
            if($cfdi_emisor->noExterior) $domicilioFiscal->agregarAtributo("noExterior", $cfdi_emisor->noExterior);
            if($cfdi_emisor->noInterior) $domicilioFiscal->agregarAtributo("noInterior", $cfdi_emisor->noInterior);
            if($cfdi_emisor->colonia) $domicilioFiscal->agregarAtributo("colonia", $cfdi_emisor->colonia);
            if($cfdi_emisor->municipio) $domicilioFiscal->agregarAtributo("municipio", $cfdi_emisor->municipio);
            if($cfdi_emisor->estado) $domicilioFiscal->agregarAtributo("estado", $cfdi_emisor->estado);
            if($cfdi_emisor->pais) $domicilioFiscal->agregarAtributo("pais", $cfdi_emisor->pais);
            if($cfdi_emisor->codigoPostal) $domicilioFiscal->agregarAtributo("codigoPostal", $cfdi_emisor->codigoPostal);
            $emisor->agregarNodo($domicilioFiscal);

            //Emisor - Expedido En
            //Si hay sucursales, sacar datos de la sucursal, sino salen del contribuyente
            $expedioEn = new CfdiNodo("cfdi:ExpedidoEn");
            if($cfdi_emisor->calle) $expedioEn->agregarAtributo("calle", $cfdi_emisor->calle);
            if($cfdi_emisor->noExterior) $expedioEn->agregarAtributo("noExterior", $cfdi_emisor->noExterior);
            if($cfdi_emisor->noInterior) $expedioEn->agregarAtributo("noInterior", $cfdi_emisor->noInterior);
            if($cfdi_emisor->colonia) $expedioEn->agregarAtributo("colonia", $cfdi_emisor->colonia);
            if($cfdi_emisor->municipio) $expedioEn->agregarAtributo("municipio", $cfdi_emisor->municipio);
            if($cfdi_emisor->estado) $expedioEn->agregarAtributo("estado", $cfdi_emisor->estado);
            if($cfdi_emisor->pais) $expedioEn->agregarAtributo("pais", $cfdi_emisor->pais);
            if($cfdi_emisor->codigoPostal) $expedioEn->agregarAtributo("codigoPostal", $cfdi_emisor->codigoPostal);
            $emisor->agregarNodo($expedioEn);

            //Emisor - Regimenes Fiscales
            $cfdi_regimenes = $cfdi->regimenes();
            if($cfdi_regimenes) foreach($cfdi_regimenes as $cfdi_regimen){
                $regimenFiscal = new CfdiNodo("cfdi:RegimenFiscal");
                $regimenFiscal->agregarAtributo("Regimen", $cfdi_regimen->regimen);
                $emisor->agregarNodo($regimenFiscal);
            }

            $cfdi_receptor = $cfdi->receptor();

            //Receptor
            $receptor = new CfdiNodo("cfdi:Receptor");
            $receptor->agregarAtributo("rfc", $cfdi_receptor->rfc);
            $receptor->agregarAtributo("nombre", $cfdi_receptor->nombre);
            $comprobante->agregarNodo($receptor);

            //Receptor - Domicilio Fiscal
            $domicilio = new CfdiNodo("cfdi:Domicilio");
            if($cfdi_receptor->calle) $domicilio->agregarAtributo("calle", $cfdi_receptor->calle);
            if($cfdi_receptor->noExterior) $domicilio->agregarAtributo("noExterior", $cfdi_receptor->noExterior);
            if($cfdi_receptor->noInterior) $domicilio->agregarAtributo("noInterior", $cfdi_receptor->noInterior);

            if($cfdi_receptor->colonia) $domicilio->agregarAtributo("colonia", $cfdi_receptor->colonia);
            if($cfdi_receptor->municipio) $domicilio->agregarAtributo("municipio", $cfdi_receptor->municipio);
            if($cfdi_receptor->estado) $domicilio->agregarAtributo("estado", $cfdi_receptor->estado);
            if($cfdi_receptor->pais) $domicilio->agregarAtributo("pais", $cfdi_receptor->pais);
            if($cfdi_receptor->codigoPostal) $domicilio->agregarAtributo("codigoPostal", $cfdi_receptor->codigoPostal);
            $receptor->agregarNodo($domicilio);

            $cfdi_conceptos = $cfdi->conceptos();

            //Conceptos
            $conceptos = new CfdiNodo("cfdi:Conceptos");

            if($cfdi_conceptos) foreach($cfdi_conceptos as $cfdi_concepto){
                $concepto = new CfdiNodo("cfdi:Concepto");
                $concepto->agregarAtributo("cantidad", $cfdi_concepto->cantidad);
                $concepto->agregarAtributo("unidad", $cfdi_concepto->unidad);
                $concepto->agregarAtributo("descripcion", $cfdi_concepto->descripcion);
                $concepto->agregarAtributo("valorUnitario", number_format($cfdi_concepto->valorUnitario,4,".",""));
                $concepto->agregarAtributo("importe", number_format($cfdi_concepto->importe,4,".",""));
                $conceptos->agregarNodo($concepto);
            }

            $comprobante->agregarNodo($conceptos);

            $cfdi_impuestos = $cfdi->impuestos();

            $total_trasladados = 0;
            $total_retenidos = 0;

            $impuestos = new CfdiNodo("cfdi:Impuestos");
            $traslados = new CfdiNodo("cfdi:Traslados");
            $retenidos = new CfdiNodo("cfdi:Retenciones");

            if($cfdi_impuestos) foreach($cfdi_impuestos as $cfdi_impuesto){
                if(strtoupper($cfdi_impuesto->tipo) == "TRASLADADO" || strtoupper($cfdi_impuesto->tipo) == "TRASLADO"){
                    $total_trasladados += $cfdi_impuesto->importe;

                    $traslado = new CfdiNodo("cfdi:Traslado");
                    $traslado->agregarAtributo("tasa", number_format($cfdi_impuesto->tasa,2,".",""));
                    $traslado->agregarAtributo("importe", number_format($cfdi_impuesto->importe,4,".",""));
                    $traslado->agregarAtributo("impuesto", $cfdi_impuesto->impuesto);

                    $traslados->agregarNodo($traslado);
                }
                else{
                    $total_retenidos += $cfdi_impuesto->importe;

                    $retenido = new CfdiNodo("cfdi:Retencion");
                    $retenido->agregarAtributo("impuesto", $cfdi_impuesto->impuesto);
                    $retenido->agregarAtributo("importe", number_format($cfdi_impuesto->importe,4,".",""));

                    $retenidos->agregarNodo($retenido);
                }
            }

            //Impuestos
            if($total_retenidos>0){
                $impuestos->agregarNodo($retenidos);
                $impuestos->agregarAtributo("totalImpuestosRetenidos", number_format($total_retenidos,4,".",""));
            }

            if($total_trasladados>0){
                $impuestos->agregarNodo($traslados);
                $impuestos->agregarAtributo("totalImpuestosTrasladados", number_format($total_trasladados,4,".",""));
            }

            $comprobante->agregarNodo($impuestos);

            $this->complemento = new CfdiNodo("cfdi:Complemento");

            $comprobante->agregarNodo($this->complemento);

            $this->cfdi = $comprobante;
        }

        public function ine($ine){
            $ine_nodo = new CfdiNodo("ine:INE");

            $ine_nodo->agregarAtributo("Version", "1.1");
            $ine_nodo->agregarAtributo("TipoProceso", $ine->TipoProceso);

            if(Str::lower($ine->TipoProceso) == "ordinario"){
                $ine_nodo->agregarAtributo("TipoComite", $ine->TipoComite);

                if(Str::lower($ine->TipoComite) == "ejecutivo nacional"){
                    $ine_nodo->agregarAtributo("IdContabilidad", $ine->IdContabilidad);
                }
                else{
                    if(Str::lower($ine->TipoComite) == "ejecutivo estatal"){
                        $ine_entidad_nodo = new CfdiNodo("ine:Entidad");
                        $ine_entidad_nodo->agregarAtributo("ClaveEntidad", $ine->ClaveEntidad);

                        $ine_contabilidad_nodo = new CfdiNodo("ine:Contabilidad");
                        $ine_contabilidad_nodo->agregarAtributo("IdContabilidad", $ine->IdContabilidad);

                        $ine_entidad_nodo->agregarNodo($ine_contabilidad_nodo);

                        $ine_nodo->agregarNodo($ine_entidad_nodo);
                    }
                    else{
                        $ine_nodo->agregarAtributo("IdContabilidad", $ine->IdContabilidad);

                        $ine_entidad_nodo = new CfdiNodo("ine:Entidad");
                        $ine_entidad_nodo->agregarAtributo("ClaveEntidad", $ine->ClaveEntidad);

                        $ine_nodo->agregarNodo($ine_entidad_nodo);
                    }
                }
            }
            else{
                $ine_entidad_nodo = new CfdiNodo("ine:Entidad");
                $ine_entidad_nodo->agregarAtributo("ClaveEntidad", $ine->ClaveEntidad);
                $ine_entidad_nodo->agregarAtributo("Ambito", $ine->Ambito);

                $ine_contabilidad_nodo = new CfdiNodo("ine:Contabilidad");
                $ine_contabilidad_nodo->agregarAtributo("IdContabilidad", $ine->IdContabilidad);

                $ine_entidad_nodo->agregarNodo($ine_contabilidad_nodo);

                $ine_nodo->agregarNodo($ine_entidad_nodo);
            }

            $this->complemento->agregarNodo($ine_nodo);
        }

        public function addendar(){
            //Addenda
            $addenda = new CfdiNodo("cfdi:Addenda");
            $this->cfdi->agregarNodo($addenda);
        }

        public function timbrar($timbre){
            $timbre_fiscal = new CfdiNodo("tfd:TimbreFiscalDigital");

            $timbre_fiscal->agregarAtributo("xmlns:tfd", "http://www.sat.gob.mx/TimbreFiscalDigital");
            $timbre_fiscal->agregarAtributo("xmlns:xsi", "http://www.w3.org/2001/XMLSchema-instance");
            $timbre_fiscal->agregarAtributo("xsi:schemaLocation", $timbre["schemaLocation"]);
            $timbre_fiscal->agregarAtributo("version", $timbre[0]["version"]);
            $timbre_fiscal->agregarAtributo("FechaTimbrado", $timbre[0]["FechaTimbrado"]);
            $timbre_fiscal->agregarAtributo("selloCFD", $timbre[0]["selloCFD"]);
            $timbre_fiscal->agregarAtributo("noCertificadoSAT", $timbre[0]["noCertificadoSAT"]);
            $timbre_fiscal->agregarAtributo("selloSAT", $timbre[0]["selloSAT"]);
            $timbre_fiscal->agregarAtributo("UUID", $timbre[0]["UUID"]);

            $this->complemento->agregarNodo($timbre_fiscal);
        }

        public function sellar($sello, $noCertificado, $certificado){
            $this->cfdi->agregarAtributo("sello", $sello);
            $this->cfdi->agregarAtributo("noCertificado", $noCertificado);
            $this->cfdi->agregarAtributo("certificado", $certificado);
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