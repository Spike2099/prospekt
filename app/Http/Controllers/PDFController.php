<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;
use App\Models\MoySklad;


class PDFController extends Controller
{

    public function generatePDF($id, $name)
    {
        $data = [
            'order' => MoySklad::getInvoiceOne($id)
        ];
        $pdf = PDF::loadView('document.pdf', $data, [], 'UTF-8');
        return $pdf->download('Счёт №'.$data['order']['name'].'.pdf');
        //
        //->stream(); 
        //return $pdf
    }

    public function contractGenerate($type, $id)
    {
        $data = [
            'id' => $id,
            'type' => $type,
            'contract' => MoySklad::getContractId($id)
        ];
        $pdf = PDF::loadView('document.contract', $data, [], 'UTF-8');
        return $pdf->stream();
    }

    public function contractDownload($type, $id)
    {
        $data = [
            'id' => $id,
            'type' => $type,
            'contract' => MoySklad::getContractId($id)
        ];
        $pdf = PDF::loadView('document.contract', $data, [], 'UTF-8');
        return $pdf->download('Договор поставки запасных частей №'.$data['contract']['name'].'.pdf');
    }


    public function getOrganizationCard($id)
    {
        $data = [
            'card' => MoySklad::getOneCounterparty($id)
        ];
        $pdf = PDF::loadView('document.card', $data, [], 'UTF-8');
        return $pdf->stream();
    }


    public function getOrganizationCardDownload($id)
    {
        $data = [
            'card' => MoySklad::getOneCounterparty($id)
        ];
        $pdf = PDF::loadView('document.card', $data, [], 'UTF-8');
        return $pdf->download('Карточка организации '.$data['card']['name'].'.pdf');
    }

}
