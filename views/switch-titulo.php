<?php

switch ($page) {
    case 'Siembra':
        echo '<span><strong>Siembra de precria y piscina</strong></span>';
    break;

    case 'Alimentacion-diaria':
        echo '<span><strong>Alimentacion diaria</strong></span>';
    break;

    case 'Control-peso':
        echo '<span><strong>Control de peso intermedio (miercoles) y peso semanal (Domingo)</strong></span>';
    break;

    case 'Poblacion':
        echo '<span><strong>Control poblacional</strong></span>';
    break;

    case 'Pesca':
        echo '<span><strong>Pesca de precria y piscina</strong></span>';
    break;

    case 'Transferencia_pre_ps':
        echo '<span><strong>Transferencia de Precria a Piscina</strong></span>';
    break;

    case 'Transferencia_ps_ps':
        echo '<span><strong>Transferencia de Piscina a Piscina</strong></span>';
    break;

    case 'Transferencia_pre_pre':
        echo '<span><strong>Transferencia de Precria a Precria</strong></span>';
    break;

    case 'Reporte-siembra-pesca':
        echo '<span><strong>Reporte de siembra y pesca de precria y piscina</strong></span>';
    break;

    case 'Reporte-semanal':
        echo '<span><strong>Alimentacion semanal de piscinas en proceso</strong></span>';
    break;

    case 'Reporte-precria':
        echo '<span><strong>Control de precrias</strong></span>';
    break;

    case 'Reporte-prolateo':
        echo '<span><strong>Prorrateo de larva y balanceado</strong></span>';
    break;

    case 'Reporte-poblacional':
        echo '<span><strong>Reporte poblacional</strong></span>';
    break;

    case 'Reporte-pesca':
        echo '<span><strong>Control de piscinas pescadas </strong></span>';
    break;

    case 'Acumulado-modelado':
        echo '<span><strong>Reporte acumulado</strong></span>';
    break;

    case 'Analisis-alimento':
        echo '<span><strong>Análisis de alimento</strong></span>';
    break;

    case 'Kardex':
        echo '<span><strong>Kardex de bodega</strong></span>';
    break;

    case 'Ingreso':
        echo '<span><strong>Ingreso de balanceado a bodega</strong></span>';
    break;

    case 'Egreso-pre':
        echo '<span><strong>Salida de balanceado de bodega</strong></span>';
    break;

    case 'Egreso-ps':
        echo '<span><strong>Salida de balanceado de bodega</strong></span>';
    break;

    case 'Mensaje':
        echo '<span><strong>Comentarios</strong></span>';
    break;

    case 'idprecria':
        echo '<span><strong>Tabla de control de alimentacion de precria</strong></span>';
    break;

    case 'Alimeto-acumulado-pescado':
        echo '<span><strong>Reporte de alimentacion de piscinas y precrias pescadas</strong></span>';
    break;

    default:
    echo '<span><strong>Alimentacion semanal de piscinas en proceso</strong></span>';
    break;
}
