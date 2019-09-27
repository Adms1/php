<?php

namespace App\Http\Controllers\V1\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;
use App\Repositories\PurchasePackagesRepository;

class HomeController extends Controller
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
        $purchase_packages = $this->purchasePackagesRepository->list()->take(5);
        return view('home', compact('purchase_packages'));
    }

    /**
     * Upload ckeditor image.
     *
     * @return \Illuminate\Http\Response
     */
    public function uploadImage(Request $request) {
        return $this->baseRepository->uploadCKEditorImage($request);
    }
}
