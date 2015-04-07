<?php
    namespace Ciberfactura;

    class CfdiGenerator{
        public $xml;
        public $cfdi;

        public function __construct(CfdiFactura $cfdi){
            $this->cfdi = $cfdi;

            //Comprobante
            $comprobante = new Nodo("cfdi:Comprobante");
            $comprobante->agregarAtributo("xsi:schemaLocation", "http://www.sat.gob.mx/cfd/3 http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv32.xsd");
            $comprobante->agregarAtributo("xsi:schemaLocation", "http://www.sat.gob.mx/cfd/3 http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv32.xsd");
            $comprobante->agregarAtributo("xmlns:cfdi", "http://www.sat.gob.mx/cfd/3");
            $comprobante->agregarAtributo("xmlns:xsi", "http://www.w3.org/2001/XMLSchema-instance");
            $comprobante->agregarAtributo("version", "3.2");

            if($cfdi->serie){
                $comprobante->agregarAtributo("serie", $cfdi->serie);
            }
            
            if($cfdi->folio){
                $comprobante->agregarAtributo("folio", $cfdi->folio);
            } 

            $comprobante->agregarAtributo("fecha", date("Y-m-d")."T".date("H:i:s"));

            $comprobante->agregarAtributo("formaDePago", "PAGO EN UNA SOLA EXHIBICION");
            $comprobante->agregarAtributo("total", number_format($cfdi->total,2,".",""));
            $comprobante->agregarAtributo("subTotal", number_format($cfdi->subTotal,2,".",""));
            $comprobante->agregarAtributo("LugarExpedicion", "MÉXICO");
            $comprobante->agregarAtributo("metodoDePago", $cfdi->metodoPago ? $cfdi->metodoPago : "efectivo");
            $comprobante->agregarAtributo("tipoDeComprobante", $cfdi->tipoDeComprobante ? $cfdi->tipoDeComprobante : "ingreso");

            $cfdi_emisor = $cfdi->emisor();

            //Emisor
            $emisor = new Nodo("cfdi:Emisor");
            $emisor->agregarAtributo("rfc", $cfdi_emisor->rfc);
            $emisor->agregarAtributo("nombre", $cfdi_emisor->nombre);
            $comprobante->agregarNodo($emisor);

            //Emisor - Domicilio Fiscal
            $domicilioFiscal = new Nodo("cfdi:DomicilioFiscal");
            $domicilioFiscal->agregarAtributo("calle", $cfdi_emisor->calle);
            $domicilioFiscal->agregarAtributo("noExterior", $cfdi_emisor->noExterior);
            if($cfdi_emisor->interior) $domicilioFiscal->agregarAtributo("noInterior", $cfdi_emisor->noInterior);
            $domicilioFiscal->agregarAtributo("colonia", $cfdi_emisor->colonia);
            $domicilioFiscal->agregarAtributo("municipio", $cfdi_emisor->municipio);
            $domicilioFiscal->agregarAtributo("estado", $cfdi_emisor->estado);
            $domicilioFiscal->agregarAtributo("pais", $cfdi_emisor->pais);
            $domicilioFiscal->agregarAtributo("codigoPostal", $cfdi_emisor->codigoPostal);
            $emisor->agregarNodo($domicilioFiscal);

            //Emisor - Expedido En
            //Si hay sucursales, sacar datos de la sucursal, sino salen del contribuyente
            $expedioEn = new Nodo("cfdi:ExpedidoEn");
            $expedioEn->agregarAtributo("calle", $cfdi_emisor->calle);
            $expedioEn->agregarAtributo("noExterior", $cfdi_emisor->noExterior);
            if($cfdi_emisor->interior) $expedioEn->agregarAtributo("noInterior", $cfdi_emisor->noInterior);
            $expedioEn->agregarAtributo("colonia", $cfdi_emisor->colonia);
            $expedioEn->agregarAtributo("municipio", $cfdi_emisor->municipio);
            $expedioEn->agregarAtributo("estado", $cfdi_emisor->estado);
            $expedioEn->agregarAtributo("pais", $cfdi_emisor->pais);
            $expedioEn->agregarAtributo("codigoPostal", $cfdi_emisor->codigoPostal);
            $emisor->agregarNodo($expedioEn);

            //Emisor - Regimenes Fiscales
            $cfdi_regimenes = $cfdi->regimenes();
            if($cfdi_regimenes) foreach($cfdi_regimenes as $cfdi_regimen){
                $regimenFiscal = new Nodo("cfdi:RegimenFiscal");
                $regimenFiscal->agregarAtributo("Regimen", $cfdi_regimen->regimen);
                $emisor->agregarNodo($regimenFiscal);
            }

            $cfdi_receptor = $cfdi->receptor();

            //Receptor
            $receptor = new Nodo("cfdi:Receptor");
            $receptor->agregarAtributo("rfc", $cfdi_receptor->rfc);
            $receptor->agregarAtributo("nombre", $cfdi_receptor->nombre);
            $comprobante->agregarNodo($receptor);

            //Receptor - Domicilio Fiscal
            $domicilio = new Nodo("cfdi:Domicilio");
            $domicilio->agregarAtributo("calle", $cfdi_receptor->calle);
            $domicilio->agregarAtributo("noExterior", $cfdi_receptor->noExterior);
            if($cfdi_receptor->interior) $domicilio->agregarAtributo("noInterior", $cfdi_receptor->noInterior);
            $domicilio->agregarAtributo("colonia", $cfdi_receptor->colonia);
            $domicilio->agregarAtributo("municipio", $cfdi_receptor->municipio);
            $domicilio->agregarAtributo("estado", $cfdi_receptor->estado);
            $domicilio->agregarAtributo("pais", $cfdi_receptor->pais);
            $domicilio->agregarAtributo("codigoPostal", $cfdi_receptor->codigoPostal);
            $receptor->agregarNodo($domicilio);

            $cfdi_conceptos = $cfdi->conceptos();

            //Conceptos
            $conceptos = new Nodo("cfdi:Conceptos");

            if($cfdi_conceptos) foreach($cfdi_conceptos as $cfdi_concepto){
                $concepto = new Nodo("cfdi:Concepto");
                $concepto->agregarAtributo("cantidad", $cfdi_concepto->cantidad);
                $concepto->agregarAtributo("unidad", $cfdi_concepto->unidad);
                $concepto->agregarAtributo("descripcion", $cfdi_concepto->descripcion);
                $concepto->agregarAtributo("valorUnitario", number_format($cfdi_concepto->valorUnitario,2,".",""));
                $concepto->agregarAtributo("importe", number_format($cfdi_concepto->importe,2,".",""));
                $conceptos->agregarNodo($concepto);
            }

            $comprobante->agregarNodo($conceptos);

            $cfdi_impuestos = $cfdi->impuestos();

            $total_trasladados = 0;
            $total_retenidos = 0;

            $impuestos = new Nodo("cfdi:Impuestos");
            $traslados = new Nodo("cfdi:Traslados");
            $retenidos = new Nodo("cfdi:Retenidos");

            if($cfdi_impuestos) foreach($cfdi_impuestos as $cfdi_impuesto){
                if(strtoupper($cfdi_impuesto->tipo) == "TRASLADADO"){
                    $total_trasladados += $cfdi_impuesto->importe;

                    $traslado = new Nodo("cfdi:Traslado");
                    $traslado->agregarAtributo("tasa", number_format($cfdi_impuesto->tasa,2,".",""));
                    $traslado->agregarAtributo("importe", number_format($cfdi_impuesto->importe,2,".",""));
                    $traslado->agregarAtributo("impuesto", $cfdi_impuesto->nombre);

                    $traslados->agregarNodo($traslado);
                }
                else{
                    $total_retenidos += $cfdi_impuesto->importe;

                    $retenido = new Nodo("cfdi:Retenido");
                    $retenido->agregarAtributo("tasa", number_format($cfdi_impuesto->tasa,2,".",""));
                    $retenido->agregarAtributo("importe", number_format($cfdi_impuesto->importe,2,".",""));
                    $retenido->agregarAtributo("impuesto", $cfdi_impuesto->nombre);

                    $retenidos->agregarNodo($retenido);
                }
            }

            //Impuestos
            if($total_trasladados>0){
                $impuestos->agregarNodo($traslados);
                $impuestos->agregarAtributo("totalImpuestosTrasladados", number_format($total_trasladados,2,".",""));
            }

            if($total_retenidos>0){
                $impuestos->agregarNodo($retenidos);
                $impuestos->agregarAtributo("totalImpuestosRetenidos", number_format($total_retenidos,2,".",""));
            }

            $comprobante->agregarNodo($impuestos);

            $this->cfdi = $comprobante;
        }

        public function addendar(){
            //Addenda
            $addenda = new Nodo("cfdi:Addenda");
            $this->cfdi->agregarNodo($addenda);
        }

        public function timbrar($timbre){
            $complemento = new Nodo("cfdi:Complemento");

            $complemento->agregarAtributo("xmlns:tfd", "http://www.sat.gob.mx/TimbreFiscalDigital");
            $complemento->agregarAtributo("xsi:schemaLocation", $timbre["schemaLocation"]);
            $complemento->agregarAtributo("version", $timbre[0]["version"]);
            $complemento->agregarAtributo("FechaTimbrado", $timbre[0]["FechaTimbrado"]);
            $complemento->agregarAtributo("selloCFD", $timbre[0]["selloCFD"]);
            $complemento->agregarAtributo("noCertificadoSAT", $timbre[0]["noCertificadoSAT"]);
            $complemento->agregarAtributo("selloSAT", $timbre[0]["selloSAT"]);
            $complemento->agregarAtributo("UUID", $timbre[0]["UUID"]);

            $this->cfdi->agregarNodo($complemento);
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