<?php

namespace App\Controllers;

use App\Models\InvoiceModel;


class SurveyorController extends BaseController
{

    protected $invoiceModel;
    protected $session;

    public function __construct() {
        $this->invoiceModel = new InvoiceModel();
        $this->session = session();
    }

    public function index() {
        return view('layout/_header')
            . view('surveyors/navigasi')
            . view('surveyors/index') 
            . view('layout/_footer');
    }


}