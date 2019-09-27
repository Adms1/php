<?php

namespace App\Http\Controllers\V1\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;
use App\Repositories\PurchasePackagesRepository;
use PDF;

class PurchasePackagesController extends Controller
{
    /**
     * @var BaseRepository
     */
    protected $baseRepository;

    /**
     * @var PurchasePackagesRepository
     */
    protected $purchasePackagesRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        BaseRepository $baseRepository,
        PurchasePackagesRepository $purchasePackagesRepository
    ){
        $this->baseRepository = $baseRepository;
        $this->purchasePackagesRepository = $purchasePackagesRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchase_packages = $this->purchasePackagesRepository->list();
        return view('admin.purchase_package.index', compact('purchase_packages'));
    }

    /**
     * Display the invoice in pdf by invoice number.
     *
     * @param  int $invoicenum
     * @return \Illuminate\Http\Response
     */
    public function getPurchasePackageDetailByInvoiceNumber($invoicenum)
    {
        $data = [];
        // Get Data for PDF
        $pdf_data = $this->purchasePackagesRepository->getPurchasePackageInfoByInvoiceNumber($invoicenum);

        $amount = array_sum($pdf_data->invoiceDetail->pluck('Amount')->toArray());
        $pdf_data['in_word'] = $this->baseRepository->getIndianCurrency($amount);
        $data['pdf_data'] = $pdf_data;
        $pdf = PDF::loadView('partials.pdf', $data);
        return $pdf->stream("invoice_".$pdf_data['paymentTransaction']['PaymentOrderID'].".pdf", array("Attachment" => false));
    }

    /**
     * Get date wise total price by ajax
     *
     * @return \Illuminate\Http\Response
     */
    public function getTransactionByAjax()
    {
        // Get transaction records
        $transactions = $this->purchasePackagesRepository->getTransactionByAjax();
        if ($transactions) {
            return response()->json([
                'success' => true,
                'data'  => $transactions,
            ]);
        } else {
            return response()->json([
                'success' => true,
                'data'  => [],
            ]);
        }
    }
}
