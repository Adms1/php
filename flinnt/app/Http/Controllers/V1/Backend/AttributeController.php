<?php

namespace App\Http\Controllers\V1\Backend;

use Illuminate\Http\Request;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.attributes.attr_list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.attributes.attr_add');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function specificationCreate()
    {
        return view('admin.attributes.specification_add');
    }

    /**
     * Show the List of resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function specificationList()
    {
        return view('admin.attributes.specification_list');
    }

    /**
     * Show the List of resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function specificationStore()
    {
        return view('admin.attributes.specification_list');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return view('admin.attributes.attr_list');
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
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function productsAttributeCreate()
    {
        $sp_attributes = array(
            '1' => 'Screen Size',
            '2' => 'Model Name',
            '3' => 'Brand Name',
            '4' => 'Number of USB ports'
        );

        $pr_attributes = array(
            '1' => 'Color',
            '2' => 'Style',
            '3' => 'Size',
            '4' => 'Language',
        );

        return view('admin.attributes.product_attr_add',compact('sp_attributes', 'pr_attributes'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function productsAttributeList()
    {
        $sp_attributes = array(
            '1' => 'Screen Size',
            '2' => 'Model Name',
            '3' => 'Brand Name',
            '4' => 'Number of USB ports'
        );

        $pr_attributes = array(
            '1' => 'Color',
            '2' => 'Style',
            '3' => 'Size',
            '4' => 'Language',
        );

        return view('admin.attributes.product_attr_list',compact('sp_attributes', 'pr_attributes'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function productsAttributeStore()
    {
        $sp_attributes = array(
            '1' => 'Screen Size',
            '2' => 'Model Name',
            '3' => 'Brand Name',
            '4' => 'Number of USB ports'
        );

        $pr_attributes = array(
            '1' => 'Color',
            '2' => 'Style',
            '3' => 'Size',
            '4' => 'Language',
        );

        return view('admin.attributes.product_attr_list',compact('sp_attributes', 'pr_attributes'));
    }
}
