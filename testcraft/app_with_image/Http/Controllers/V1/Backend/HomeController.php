<?php

namespace App\Http\Controllers\V1\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PurchasePackagesRepository;
use App\Repositories\BaseRepository;

class HomeController extends Controller
{
    /**
     * @var PurchasePackagesRepository
     */
    protected $purchasePackagesRepository;

    /**
     * @var BaseRepository
     */
    protected $baseRepository;

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        PurchasePackagesRepository $purchasePackagesRepository,
        BaseRepository $baseRepository
    ){
        $this->purchasePackagesRepository = $purchasePackagesRepository;
        $this->baseRepository = $baseRepository;
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
