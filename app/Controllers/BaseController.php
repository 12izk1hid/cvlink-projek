<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Models\KasModel;
use App\Models\InvoiceModel;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['form', 'url', 'security', 'array', 'html', 'date', 'text'];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();

    }

    public function alamat()
    {
        return 'Kawasan Berikat Nusantara (KBN) Cakung<br> Jalan jawa Blok A-14 no. 4 Cakung-Cilingcing<br> Jakarta Utara. 14140';
    }

    public function invoicecode()
    {
        return 'WGSL-INV-';
    }

    public function ambilidinvoicemaks()
    {
        $invoiceModel = new InvoiceModel();
        $data = $invoiceModel->ambilidInvoicemaks();
        foreach ($data as $dt) {
            $id = $dt['id'] + 1;
        }
        return 'WGSL-INV-' . date('Y') . '-' . $id;
    }

    public function ambilkas()
    {
        $kas = 0;
        $kasModel = new KasModel();
        $kas = $kasModel->where('id', '1')->first();
        $kasReal = $kas['total'];
        return $kasReal;
    }
    public function ambilkasbank()
    {
        $kas = 0;
        $kasModel = new KasModel();
        $kas = $kasModel->where('id', '2')->first();
        $kasReal = $kas['total'];
        return $kasReal;
    }
}
