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

            $package = $package->find($invoicenum);
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
        return $data;
    }
}