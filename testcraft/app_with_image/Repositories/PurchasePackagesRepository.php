<?php

namespace App\Repositories;

use App\PaymentTransaction;
use App\Invoice;
use Auth;
use Log;
use DB;

/**
 * Class PurchasePackagesRepository.
 *
 * @package namespace App\Repositories;
 */
class PurchasePackagesRepository
{

    /**
     * Create a new model instance.
     *
     * @return void
     */
    public function __construct(PaymentTransaction $table)
    {
        $this->table = $table;
    }

    /**
     * Get resource list.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        try {
            // echo "<pre>";
            $package = Invoice::with(['invoiceDetail.testPackage', 'student', 'paymentTransaction.status'])
                            ->whereHas('invoiceDetail.testPackage', function ($query) {
                                    if (Auth::guard('tutor')->check()) {
                                        $tutor_id = Auth::guard('tutor')->user()->TutorID;
                                        $query->where('TutorID', $tutor_id);
                                    }
                            })
                            ->whereHas('paymentTransaction', function ($query) {
                                    if (Auth::guard('tutor')->check()) {
                                        $query->where('ExternalTransactionStatusID', 3);
                                    }
                            })
                            ->orderBy('CreateDate', 'DESC')
                            ->get();
            // print_r($package->toArray());
            // die;


            /*$package = $this->table;
            if (Auth::guard('tutor')->check()) {
                $tutor_id = Auth::guard('tutor')->user()->TutorID;
                $package = $package->where('TutorID', $tutor_id);
            } */
            return $package;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('test package list.',['PurchasePackagesRepository/list', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get Purchase Package Info By Invoice Number.
     *
     * @param  int  $invoicenum
     * @return \Illuminate\Http\Response
     */
    public function getPurchasePackageInfoByInvoiceNumber($invoicenum)
    {
        try {
            /*echo "<pre>";*/

            if (Auth::guard('tutor')->check()) {
                $tutor_id = Auth::guard('tutor')->user()->TutorID;
            }

            $package = Invoice::with(['invoiceDetail.testPackage.tutor', 'student', 'paymentTransaction.status'])
                            ->whereHas('invoiceDetail.testPackage', function ($query) {
                                    if (Auth::guard('tutor')->check()) {
                                        $tutor_id = Auth::guard('tutor')->user()->TutorID;
                                        $query->where('TutorID', $tutor_id);
                                    }
                            })
                            ->whereHas('paymentTransaction', function ($query) {
                                    if (Auth::guard('tutor')->check()) {
                                        $query->where('ExternalTransactionStatusID', 3);
                                    }
                            });

            /*if (Auth::guard('tutor')->check()) {
                $tutor_id = Auth::guard('tutor')->user()->TutorID;
                $package = $package->where('invoiceDetail.testPackage.TutorID', 5);
            }*/

            $package = $package->find($invoicenum);
            /*print_r($package->toArray());
            die;*/


            /*$package = $this->table;
            if (Auth::guard('tutor')->check()) {
                $tutor_id = Auth::guard('tutor')->user()->TutorID;
                $package = $package->where('TutorID', $tutor_id);
            } */
            return $package;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('test package list.',['PurchasePackagesRepository/list', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get date wise total price by ajax
     *
     * @return array $data
     */
    public function getTransactionByAjax()
    {
        $data = [];
        try {
            // $orders = DB::table('Invoice')
            //     ->join('InvoiceDetail', 'InvoiceDetail.InvoiceID', '=', 'Invoice.InvoiceID')
            //     ->join('TestPackage', 'TestPackage.TestPackageID', '=', 'InvoiceDetail.TestPackageID')
            //     ->join('PaymentTransaction', 'PaymentTransaction.PaymentTransactionID', '=', 'Invoice.PaymentTransactionID');

            // if (Auth::guard('tutor')->check()) {
            //     $tutor_id = Auth::guard('tutor')->user()->TutorID;
            //     $orders = $orders->where('TutorID', 5);
            // }

            // $orders = $orders->where('ExternalTransactionStatusID', 3);

            // $orders = $orders->select(DB::raw("convert(date, Invoice.CreateDate, 105) as sale_date, SUM(InvoiceDetail.Amount) as total_count"))
            //                 ->groupBy(DB::raw("convert(date, Invoice.CreateDate, 105)"))
            //                 ->orderBy(DB::raw("convert(date, Invoice.CreateDate, 105)", 'ASC'))
            //                 ->get();

            // $orders = Invoice::with(['invoiceDetail' => function($query) {
            //                     $query->select('InvoiceDetailID', 'InvoiceID', 'Amount');
            //                 }])
            //                 ->selectRaw('convert(varchar, CreateDate, 105) as CreateDate')
            //                 ->groupBy('CreateDate')
            //                 ->orderBy('CreateDate')
            //                 ->get();

            $orders = Invoice::whereHas('invoiceDetail.testPackage', function ($query) {
                                    if (Auth::guard('tutor')->check()) {
                                        $tutor_id = Auth::guard('tutor')->user()->TutorID;
                                        $query->where('TutorID', $tutor_id);
                                    }
                            })
                            ->whereHas('paymentTransaction', function ($query) {
                                    if (Auth::guard('tutor')->check()) {
                                        $query->where('ExternalTransactionStatusID', 3);
                                    }
                            })
                            ->select(DB::raw("convert(date, CreateDate, 105) as sale_date, SUM(Amount) as total_count"))
                            ->groupBy(DB::raw("convert(date, CreateDate, 105)"))
                            ->orderBy(DB::raw("convert(date, CreateDate, 105)", 'ASC'))
                            ->get()->toArray();
                            /*echo "<pre>";
                            print_r($orders->toArray());
                            die;*/
            // $orders = Order::select(DB::raw("SUM(order_total_price) as total_count, DATE_FORMAT(order_date, '%d-%m-%Y') as sale_date"))
            //     ->where('order_status', 2)
            //     ->groupBy('sale_date')
            //     ->orderBy('order_date')
            //     ->get()->toArray();

            $total = array_column($orders, 'total_count');
            $date = array_column($orders, 'sale_date');
            $data['total'] = $total;
            $data['date'] = $date; 
            return $data;
        } catch (\Exception $e) {
            echo $e->getMessage();
            Log::channel('loginfo')->error('Get date wise total price by ajax.',['PurchasePackagesRepository/getTransactionByAjax', $e->getMessage()]);
            return false;
        }

        /*echo "<pre>";
        print_r($data);
        die;*/
        return $data;
    }
}