<?php

namespace App\Http\Controllers;

use App\SizeGuide;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class SizeGuideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $error = $this->validate( $request,[
            'title' => 'required|max:255',
        ] );

        $shop_domain = ShopifyApp::shop()->shopify_domain;

        $shop_id = DB::table('shops')->where('	shopify_domain', $shop_domain)->first();

        $size = new SizeGuide;

        $size->title = $request->title;
        $size->shop_id = $shop_id;


        $size->save();


        return redirect('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SizeGuide  $sizeGuide
     * @return \Illuminate\Http\Response
     */
    public function show(SizeGuide $sizeGuide)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SizeGuide  $sizeGuide
     * @return \Illuminate\Http\Response
     */
    public function edit(SizeGuide $sizeGuide)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SizeGuide  $sizeGuide
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SizeGuide $sizeGuide)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SizeGuide  $sizeGuide
     * @return \Illuminate\Http\Response
     */
    public function destroy(SizeGuide $sizeGuide)
    {
        //
    }
}
