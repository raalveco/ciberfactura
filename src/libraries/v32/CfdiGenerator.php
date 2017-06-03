<?php
    namespace Raalveco\Ciberfactura\Libraries\V32;

    use App\Models\Perception;
    use Carbon\Carbon;
    use Raalveco\Ciberfactura\Models\V32\CfdiFactura;

    class CfdiGenerator{
        public $xml;
        public $cfdi;
        public $cfdi_factura;

        public function __construct(CfdiFactura $cfdi, $nomina = false){
            $this->cfdi = $cfdi;
            $this->cfdi_factura = $cfdi;

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

            if($cfdi->fecha && $cfdi->fecha > '1980-01-01 00:00:00'){
                $comprobante->agregarAtributo("fecha", str_replace(" ","T", $cfdi->fecha));
            }
            else{
                $comprobante->agregarAtributo("fecha", date("Y-m-d")."T".date("H:i:s"));
            }

            $comprobante->agregarAtributo("formaDePago", "PAGO EN UNA SOLA EXHIBICION");

            $decimals = 4;
            if($nomina){
                $decimals = 2;
            }

            $comprobante->agregarAtributo("total", number_format($cfdi->total,$decimals,".",""));
            $comprobante->agregarAtributo("subTotal", number_format($cfdi->sub_total,$decimals,".",""));

            if(!$nomina && $cfdi->descuento > 0){
                $comprobante->agregarAtributo("descuento", number_format($cfdi->descuento,$decimals,".",""));
                $comprobante->agregarAtributo("motivoDescuento", $cfdi->motivo_descuento ? $cfdi->motivo_descuento : "Descuento General");
            }

            $cfdi_emisor = $cfdi->emisor;

            $comprobante->agregarAtributo("LugarExpedicion", $cfdi_emisor->codigo_postal);

            if($nomina){
                $comprobante->agregarAtributo("metodoDePago", "NA");
            }
            else{
                $comprobante->agregarAtributo("metodoDePago", $cfdi->metodo_pago ? $cfdi->metodo_pago : "NO IDENTIFICADO");
            }

            $comprobante->agregarAtributo("tipoDeComprobante", $cfdi->tipo_comprobante ? strtolower($cfdi->tipo_comprobante) : "ingreso");

            if(!$nomina && isset($cfdi->num_cta_pago) && $cfdi->num_cta_pago){
                $comprobante->agregarAtributo("NumCtaPago", $cfdi->num_cta_pago ? $cfdi->num_cta_pago : "");
            }

            if($nomina){
                $comprobante->agregarAtributo("Moneda", "MXN");
            }
            else{
                if(isset($cfdi->moneda) && $cfdi->moneda){
                    $comprobante->agregarAtributo("Moneda", $cfdi->moneda ? $cfdi->moneda : "");
                }
            }

            if(isset($cfdi->tipo_cambio) && $cfdi->tipo_cambio && $cfdi->tipo_cambio != 1){
                $comprobante->agregarAtributo("tipoCambio", $cfdi->tipo_cambio ? number_format($cfdi->tipo_cambio,2,".","") : "");
            }

            //Emisor
            $emisor = new Nodo("cfdi:Emisor");
            $emisor->agregarAtributo("rfc", $cfdi_emisor->rfc);
            $emisor->agregarAtributo("nombre", $cfdi_emisor->nombre);
            $comprobante->agregarNodo($emisor);

            if(!$nomina){
                //Emisor - Domicilio Fiscal
                $domicilioFiscal = new Nodo("cfdi:DomicilioFiscal");
                if($cfdi_emisor->calle) $domicilioFiscal->agregarAtributo("calle", $cfdi_emisor->calle);
                if($cfdi_emisor->no_exterior) $domicilioFiscal->agregarAtributo("noExterior", $cfdi_emisor->no_exterior);
                if($cfdi_emisor->no_interior) $domicilioFiscal->agregarAtributo("noInterior", $cfdi_emisor->no_interior);
                if($cfdi_emisor->colonia) $domicilioFiscal->agregarAtributo("colonia", $cfdi_emisor->colonia);
                if($cfdi_emisor->municipio) $domicilioFiscal->agregarAtributo("municipio", $cfdi_emisor->municipio);
                if($cfdi_emisor->estado) $domicilioFiscal->agregarAtributo("estado", $cfdi_emisor->estado);
                $domicilioFiscal->agregarAtributo("pais", $cfdi_emisor->pais ? $cfdi_emisor->pais : "MÉXICO");
                if($cfdi_emisor->codigo_postal) $domicilioFiscal->agregarAtributo("codigoPostal", $cfdi_emisor->codigo_postal);
                $emisor->agregarNodo($domicilioFiscal);

                //Emisor - Expedido En
                //Si hay sucursales, sacar datos de la sucursal, sino salen del contribuyente
                $expedioEn = new Nodo("cfdi:ExpedidoEn");
                if($cfdi_emisor->calle) $expedioEn->agregarAtributo("calle", $cfdi_emisor->calle);
                if($cfdi_emisor->no_exterior) $expedioEn->agregarAtributo("noExterior", $cfdi_emisor->no_exterior);
                if($cfdi_emisor->no_interior) $expedioEn->agregarAtributo("noInterior", $cfdi_emisor->no_interior);
                if($cfdi_emisor->colonia) $expedioEn->agregarAtributo("colonia", $cfdi_emisor->colonia);
                if($cfdi_emisor->municipio) $expedioEn->agregarAtributo("municipio", $cfdi_emisor->municipio);
                if($cfdi_emisor->estado) $expedioEn->agregarAtributo("estado", $cfdi_emisor->estado);
                $expedioEn->agregarAtributo("pais", $cfdi_emisor->pais ? $cfdi_emisor->pais : "MÉXICO");
                if($cfdi_emisor->codigo_postal) $expedioEn->agregarAtributo("codigoPostal", $cfdi_emisor->codigo_postal);
                $emisor->agregarNodo($expedioEn);
            }

            //Emisor - Regimenes Fiscales
            $cfdi_regimenes = $cfdi->regimenes;

            if($cfdi_regimenes) foreach($cfdi_regimenes as $cfdi_regimen){
                $regimenFiscal = new Nodo("cfdi:RegimenFiscal");

                if($nomina){
                    $regimenFiscal->agregarAtributo("Regimen", CfdiData::getRegimenCode($cfdi_regimen->regimen));
                }
                else{
                    $regimenFiscal->agregarAtributo("Regimen", $cfdi_regimen->regimen);
                }

                $emisor->agregarNodo($regimenFiscal);
            }

            $cfdi_receptor = $cfdi->receptor;

            //Receptor
            $receptor = new Nodo("cfdi:Receptor");
            $receptor->agregarAtributo("rfc", $cfdi_receptor->rfc);
            $receptor->agregarAtributo("nombre", $cfdi_receptor->nombre);
            $comprobante->agregarNodo($receptor);

            //Receptor - Domicilio Fiscal
            if(!$nomina) {
                $domicilio = new Nodo("cfdi:Domicilio");
                if ($cfdi_receptor->calle) $domicilio->agregarAtributo("calle", $cfdi_receptor->calle);
                if ($cfdi_receptor->no_exterior) $domicilio->agregarAtributo("noExterior", $cfdi_receptor->no_exterior);
                if ($cfdi_receptor->no_interior) $domicilio->agregarAtributo("noInterior", $cfdi_receptor->no_interior);
                if ($cfdi_receptor->colonia) $domicilio->agregarAtributo("colonia", $cfdi_receptor->colonia);
                if ($cfdi_receptor->municipio) $domicilio->agregarAtributo("municipio", $cfdi_receptor->municipio);
                if ($cfdi_receptor->estado) $domicilio->agregarAtributo("estado", $cfdi_receptor->estado);
                $domicilio->agregarAtributo("pais", $cfdi_receptor->pais ? $cfdi_receptor->pais : "MÉXICO");
                if ($cfdi_receptor->codigo_postal) $domicilio->agregarAtributo("codigoPostal", $cfdi_receptor->codigo_postal);
                $receptor->agregarNodo($domicilio);
            }

            $cfdi_conceptos = $cfdi->conceptos;

            //Conceptos
            $conceptos = new Nodo("cfdi:Conceptos");

            if($cfdi_conceptos) foreach($cfdi_conceptos as $cfdi_concepto){
                $concepto = new Nodo("cfdi:Concepto");

                if($nomina){
                    $concepto->agregarAtributo("cantidad", 1);
                    $concepto->agregarAtributo("unidad", "ACT");
                    $concepto->agregarAtributo("descripcion", "Pago de nómina");
                }
                else{
                    $concepto->agregarAtributo("cantidad", $cfdi_concepto->cantidad);
                    $concepto->agregarAtributo("unidad", $cfdi_concepto->unidad);
                    $concepto->agregarAtributo("descripcion", $cfdi_concepto->descripcion);
                }

                $concepto->agregarAtributo("valorUnitario", number_format($cfdi_concepto->valor_unitario,$decimals,".",""));
                $concepto->agregarAtributo("importe", number_format($cfdi_concepto->importe,$decimals,".",""));
                $conceptos->agregarNodo($concepto);
            }

            $comprobante->agregarNodo($conceptos);

            $cfdi_impuestos = $cfdi->impuestos;

            $total_trasladados = 0;
            $total_retenidos = 0;

            $impuestos = new Nodo("cfdi:Impuestos");
            $traslados = new Nodo("cfdi:Traslados");
            $retenidos = new Nodo("cfdi:Retenciones");

            if(!$nomina && $cfdi_impuestos) foreach($cfdi_impuestos as $cfdi_impuesto){
                if(strtoupper($cfdi_impuesto->tipo) == "TRASLADADO" || strtoupper($cfdi_impuesto->tipo) == "TRASLADO"){
                    $total_trasladados += $cfdi_impuesto->importe;

                    $traslado = new Nodo("cfdi:Traslado");
                    $traslado->agregarAtributo("tasa", number_format($cfdi_impuesto->tasa,2,".",""));
                    $traslado->agregarAtributo("importe", number_format($cfdi_impuesto->importe,$decimals,".",""));
                    $traslado->agregarAtributo("impuesto", $cfdi_impuesto->impuesto);

                    $traslados->agregarNodo($traslado);
                }
                else{
                    $total_retenidos += $cfdi_impuesto->importe;

                    $retenido = new Nodo("cfdi:Retencion");
                    $retenido->agregarAtributo("impuesto", $cfdi_impuesto->impuesto);
                    $retenido->agregarAtributo("importe", number_format($cfdi_impuesto->importe,$decimals,".",""));

                    $retenidos->agregarNodo($retenido);
                }
            }

            //Impuestos
            if($total_retenidos>0){
                $impuestos->agregarNodo($retenidos);
                $impuestos->agregarAtributo("totalImpuestosRetenidos", number_format($total_retenidos,$decimals,".",""));
            }

            if($total_trasladados>0){
                $impuestos->agregarNodo($traslados);
                $impuestos->agregarAtributo("totalImpuestosTrasladados", number_format($total_trasladados,$decimals,".",""));
            }

            $comprobante->agregarNodo($impuestos);

            $this->cfdi = $comprobante;
        }

        public function addPayroll($payroll){
            $complemento_nomina = new Nodo("cfdi:Complemento");

            $nomina = new Nodo("nomina12:Nomina");
            $nomina->agregarAtributo("xmlns:nomina12", "http://www.sat.gob.mx/nomina12");

            $date = explode("/", $payroll->date);
            $start_date = explode("/", $payroll->start_date);
            $end_date = explode("/", $payroll->end_date);

            if(count($start_date) == 1){
                $start_date = explode("-", $start_date[0]);

                $dt1 = Carbon::create($start_date[0], $start_date[1], $start_date[2], 0);
            }
            else{
                $dt1 = Carbon::create($start_date[2], $start_date[1], $start_date[0], 0);
            }

            if(count($end_date) == 1){
                $end_date = explode("-", $end_date[0]);

                $dt2 = Carbon::create($end_date[0], $end_date[1], $end_date[2], 0);
            }
            else{
                $dt2 = Carbon::create($end_date[2], $end_date[1], $end_date[0], 0);
            }

            $days = $dt1->diffInDays($dt2);

            $nomina->agregarAtributo("Version", "1.2");

            //Orginaria = O, Extraordinaria = E
            $nomina->agregarAtributo("TipoNomina", "O");

            $nomina->agregarAtributo("FechaPago", count($date) == 1 ? $date[0] : $date[2]."-".$date[1]."-".$date[0]);
            $nomina->agregarAtributo("FechaInicialPago", count($start_date) == 1 ? $start_date[0] : $start_date[2]."-".$start_date[1]."-".$start_date[0]);
            $nomina->agregarAtributo("FechaFinalPago", count($end_date) == 1 ? $end_date[0] : $end_date[2]."-".$end_date[1]."-".$end_date[0]);

            $d1 = Carbon::createFromFormat("d/m/Y", $payroll->start_date);
            $d2 = Carbon::createFromFormat("d/m/Y", $payroll->end_date);

            $days = $d1->diffInDays($d2) + 1;

            if($days > 0){
                $nomina->agregarAtributo("NumDiasPagados", number_format($days, 3, ".", ""));
            }

            $emisor = new Nodo("nomina12:Emisor");

            //Atributo condicional para expresar la CURP del emisor del comprobante de nómina cuando es una persona física.
            if(isset($payroll->employer->curp) && $payroll->employer->curp){
                $emisor->agregarAtributo("Curp", $payroll->employer->curp);
            }

            //Atributo condicional para expresar el registro patronal, clave de ramo - pagaduría o la que le asigne la institución de seguridad social al patrón, a 20 posiciones máximo.
            if(isset($payroll->employer->employer_number) && $payroll->employer->employer_number){
                $emisor->agregarAtributo("RegistroPatronal", $payroll->employer->employer_number);
            }

            //Atributo opcional para expresar el RFC de la persona que fungió como patrón cuando el pago al trabajador se realice a través de un tercero como vehículo o herramienta de pago.
            if(isset($payroll->employer->rfc_patron) && $payroll->employer->rfc_patron){
                $emisor->agregarAtributo("RfcPatronOrigen", $payroll->employer->rfc_patron);
            }

            $nomina->agregarNodo($emisor);

            $receptor = new Nodo("nomina12:Receptor");

            if($payroll->employee->curp) $receptor->agregarAtributo("Curp", $payroll->employee->curp);
            if($payroll->employee->nss) $receptor->agregarAtributo("NumSeguridadSocial", $payroll->employee->nss);

            if($payroll->employee->start_date && $payroll->employee->start_date != "0000-00-00" && $payroll->employee->start_date != "00/00/0000"){
                $start_date = explode("/", $payroll->employee->start_date);

                $receptor->agregarAtributo("FechaInicioRelLaboral", count($start_date) == 1 ? $start_date[0] : $start_date[2]."-".$start_date[1]."-".$start_date[0]);

                if(count($start_date) == 1){
                    $start_date = explode("-", $start_date[0]);

                    $dt1 = Carbon::create($start_date[0], $start_date[1], $start_date[2], 0);
                    $dt2 = Carbon::createFromFormat("d/m/Y", $payroll->end_date);

                    $weeks = floor($dt1->diffInWeeks($dt2));
                }
                else{
                    $dt1 = Carbon::create($start_date[2], $start_date[1], $start_date[0], 0);
                    $dt2 = Carbon::createFromFormat("d/m/Y", $payroll->end_date);

                    $weeks = floor($dt1->diffInWeeks($dt2));
                }

                $receptor->agregarAtributo("Antigüedad", "P".$weeks."W");
            }

            if($payroll->employee->contract_type) $receptor->agregarAtributo("TipoContrato", CfdiData::getContractCode($payroll->employee->contract_type));

            if($payroll->employee->syndicated){
                $receptor->agregarAtributo("Sindicalizado", "Sí");
            }

            if($payroll->employee->journal_type) $receptor->agregarAtributo("TipoJornada", CfdiData::getJournalCode($payroll->employee->journal_type));
            $receptor->agregarAtributo("TipoRegimen", str_pad($payroll->employee->regimen->code,2,"0",STR_PAD_LEFT));

            $receptor->agregarAtributo("NumEmpleado", $payroll->employee->number);

            if($payroll->employee->job_position) $receptor->agregarAtributo("Puesto", str_pad($payroll->employee->job_position,2,"0",STR_PAD_LEFT));
            if($payroll->employer->work_risk) $receptor->agregarAtributo("RiesgoPuesto", $payroll->employer->work_risk);
            if($payroll->employee->periodicity) $receptor->agregarAtributo("PeriodicidadPago", CfdiData::getPeriodicityCode($payroll->employee->periodicity));

            if($payroll->employee->payment_method != "01"){
                if(strlen($payroll->employee->clabe) != 18){
                    if($payroll->employee->bank && $payroll->employee->bank->code){
                        $receptor->agregarAtributo("Banco", $payroll->employee->bank->code);
                    }
                }

                if($payroll->employee->clabe){
                    $receptor->agregarAtributo("CuentaBancaria", $payroll->employee->clabe);
                }
            }

            if($payroll->employee->base_salary > 0) $receptor->agregarAtributo("SalarioBaseCotApor", number_format($payroll->employee->base_salary,2,".",""));
            if($payroll->employee->base_salary > 0) $receptor->agregarAtributo("SalarioDiarioIntegrado", number_format($payroll->employee->base_salary * 1.0452,2,".",""));

            if($payroll->employee->state){
                $receptor->agregarAtributo("ClaveEntFed", CfdiData::getStateCode($payroll->employee->state));
            }
            else{
                //Por default 14 para Jalisco.
                $receptor->agregarAtributo("ClaveEntFed", "14");
            }

            $nomina->agregarNodo($receptor);

            //if($payroll->employer->employer_number) $nomina->agregarAtributo("RegistroPatronal", $payroll->employer->employer_number);

            //if($payroll->employee->curp) $nomina->agregarAtributo("CURP", $payroll->employee->curp);

            //if($payroll->employee->nss) $nomina->agregarAtributo("NumSeguridadSocial", $payroll->employee->nss);

            $payments = false;
            $percepciones = false;

            $total_gravado = 0;
            $total_exento = 0;

            $ot_total_gravado = 0;
            $ot_total_exento = 0;

            $TotalSueldos = 0;
            $TotalSeparacionIndemnizacion = 0;
            $TotalJubilacionPensionRetiro = 0;

            if($payroll->perceptions){
                //PERCEPCIONES
                $percepciones = new Nodo("nomina12:Percepciones");

                foreach($payroll->perceptions as $perception){
                    //Ya no se agregará el subsidio al empleo como una percepcion
                    if(str_pad($perception->code, 3, "0", STR_PAD_LEFT) != "017"){
                        $percepcion = new Nodo("nomina12:Percepcion");
                        $percepcion->agregarAtributo("TipoPercepcion", $perception->code);

                        //Falta verificar como se define
                        $percepcion->agregarAtributo("Clave", $perception->code);

                        $percepcion->agregarAtributo("Concepto", $perception->name);
                        $percepcion->agregarAtributo("ImporteGravado", number_format($perception->taxable_amount,2,".",""));
                        $percepcion->agregarAtributo("ImporteExento", number_format($perception->exempt_amount,2,".",""));

                        $total_gravado += $perception->taxable_amount;
                        $total_exento += $perception->exempt_amount;

                        if(str_pad($perception->code, 3, "0", STR_PAD_LEFT) == "022" || str_pad($perception->code, 3, "0", STR_PAD_LEFT) == "023" || str_pad($perception->code, 3, "0", STR_PAD_LEFT) == "025"){
                            $TotalSeparacionIndemnizacion += $perception->taxable_amount + $perception->exempt_amount;
                        }
                        elseif(str_pad($perception->code, 3, "0", STR_PAD_LEFT) == "039" || str_pad($perception->code, 3, "0", STR_PAD_LEFT) == "044"){
                            $TotalJubilacionPensionRetiro += $perception->taxable_amount + $perception->exempt_amount;
                        }
                        else{
                            $TotalSueldos += $perception->taxable_amount + $perception->exempt_amount;
                        }

                        $percepciones->agregarNodo($percepcion);
                    }
                    else{
                        $payments = new Nodo("nomina12:OtrosPagos");

                        $payment = new Nodo("nomina12:OtroPago");

                        $payment->agregarAtributo("TipoOtroPago", "002");
                        $payment->agregarAtributo("Clave", "002");
                        $payment->agregarAtributo("Concepto", $perception->name);
                        $payment->agregarAtributo("Importe", number_format($perception->taxable_amount + $perception->exempt_amount,2,".",""));

                        $subsidy = new Nodo("nomina12:SubsidioAlEmpleo");
                        $subsidy->agregarAtributo("SubsidioCausado", number_format($perception->taxable_amount + $perception->exempt_amount,2,".",""));

                        $payment->agregarNodo($subsidy);

                        $ot_total_gravado += $perception->taxable_amount;
                        $ot_total_exento += $perception->exempt_amount;

                        $payments->agregarNodo($payment);
                    }
                }
            }

            if($payroll->hours){
                if(!$percepciones){
                    $percepciones = new Nodo("nomina12:Percepciones");
                }

                $percepcion = new Nodo("nomina12:Percepcion");

                $percepcion->agregarAtributo("TipoPercepcion", "019");
                $percepcion->agregarAtributo("Clave", "019");

                $percepcion->agregarAtributo("Concepto", "Horas Extra");

                $horas_extra = new Nodo("nomina12:HorasExtra");

                $he_total_gravado = 0;
                $he_total_exento = 0;

                foreach($payroll->hours as $hour){
                    $hora_extra = new Nodo("nomina12:HorasExtras");

                    $hora_extra->agregarAtributo("Dias", $hour->days);
                    $hora_extra->agregarAtributo("TipoHoras", CfdiData::getHourCode($hour->type));
                    $hora_extra->agregarAtributo("HorasExtra", $hour->hours);
                    $hora_extra->agregarAtributo("ImportePagado", number_format($hour->import,2,".",""));

                    $he_total_gravado += 0;
                    $he_total_exento += $hour->import;

                    $total_gravado += 0;
                    $total_exento += $hour->import;

                    $horas_extra->agregarNodo($hora_extra);
                }

                $percepcion->agregarNodo($horas_extra);

                $percepcion->agregarAtributo("ImporteExento", number_format($he_total_exento,2,".",""));
                $percepcion->agregarAtributo("ImporteGravado", number_format($he_total_gravado,2,".",""));

                $percepciones->agregarNodo($percepcion);
            }

            $percepciones->agregarAtributo("TotalExento", number_format($total_exento,2,".",""));
            $percepciones->agregarAtributo("TotalGravado", number_format($total_gravado,2,".",""));

            $percepciones->agregarAtributo("TotalSueldos", number_format($TotalSueldos,2,".",""));
            $percepciones->agregarAtributo("TotalSeparacionIndemnizacion", number_format($TotalSeparacionIndemnizacion,2,".",""));
            $percepciones->agregarAtributo("TotalJubilacionPensionRetiro", number_format($TotalJubilacionPensionRetiro,2,".",""));

            $nomina->agregarAtributo("TotalPercepciones", number_format($total_gravado + $total_exento,2,".",""));

            $nomina->agregarNodo($percepciones);

            if($payroll->deductions){
                //DEDUCCIONES
                $deducciones = new Nodo("nomina12:Deducciones");

                $total_deductions = 0;
                $total_isr = 0;

                foreach($payroll->deductions as $deduction){
                    $deduccion = new Nodo("nomina12:Deduccion");
                    $deduccion->agregarAtributo("TipoDeduccion", $deduction->code);

                    //Falta verificar como se define
                    $deduccion->agregarAtributo("Clave", $deduction->code);

                    $deduccion->agregarAtributo("Concepto", $deduction->name);
                    $deduccion->agregarAtributo("Importe", number_format($deduction->taxable_amount,2,".",""));

                    if($deduction->code == "002"){
                        $total_isr += $deduction->taxable_amount;
                    }
                    else{
                        $total_deductions += $deduction->taxable_amount;
                    }

                    $deducciones->agregarNodo($deduccion);
                }

                $deducciones->agregarAtributo("TotalOtrasDeducciones", number_format($total_deductions,2,".",""));
                $deducciones->agregarAtributo("TotalImpuestosRetenidos", number_format($total_isr,2,".",""));

                $nomina->agregarAtributo("TotalDeducciones", number_format($total_deductions + $total_isr,2,".",""));

                $nomina->agregarNodo($deducciones);
            }

            if($payroll->incapacities){
                //INCAPACIDADES
                $incapacidades = new Nodo("nomina12:Incapacidades");

                foreach($payroll->incapacities as $incapacity){
                    $incapacidad = new Nodo("nomina12:Incapacidad");

                    $incapacidad->agregarAtributo("DiasIncapacidad", $incapacity->days);
                    $incapacidad->agregarAtributo("TipoIncapacidad", $incapacity->code);
                    $incapacidad->agregarAtributo("ImporteMonetario", number_format($incapacity->discount,2,".",""));

                    $incapacidades->agregarNodo($incapacidad);
                }

                $nomina->agregarNodo($incapacidades);
            }

            if($payments){

                $nomina->agregarAtributo("TotalOtrosPagos", number_format($ot_total_gravado + $ot_total_exento,2,".",""));


                $nomina->agregarNodo($payments);
            }

            //Ya no se deben contemplar las horas extra como un nodo independiente

            /*
            if($payroll->hours){
                //HORAS EXTRA
                $horas_extra = new Nodo("nomina:HorasExtras");

                foreach($payroll->hours as $hour){
                    $hora_extra = new Nodo("nomina:HorasExtras");

                    $hora_extra->agregarAtributo("Dias", $hour->days);
                    $hora_extra->agregarAtributo("TipoHoras", $hour->type);
                    $hora_extra->agregarAtributo("HorasExtra", $hour->hours);
                    $hora_extra->agregarAtributo("ImportePagado", number_format($hour->import,4,".",""));

                    $horas_extra->agregarNodo($hora_extra);
                }

                $nomina->agregarNodo($horas_extra);
            }
            */

            $complemento_nomina->agregarNodo($nomina);

            $this->cfdi->agregarNodo($complemento_nomina);
        }

        public function addendar(){
            //Addenda
            $addenda = new Nodo("cfdi:Addenda");
            $this->cfdi->agregarNodo($addenda);
        }

        public function timbrar($timbre){
            $complemento = new Nodo("cfdi:Complemento");

            $timbre_fiscal = new Nodo("tfd:TimbreFiscalDigital");

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
            $this->cfdi_factura->sello = $sello;
            $this->cfdi_factura->no_certificado = $noCertificado;
            $this->cfdi_factura->certificado = $certificado;
            $this->cfdi_factura->save();

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

                $valor = str_replace("&", "&amp;", $valor);

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
