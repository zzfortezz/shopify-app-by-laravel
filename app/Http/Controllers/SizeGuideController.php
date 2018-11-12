<?php

namespace App\Http\Controllers;

use App\SizeGuide;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
//use facade shopifyapp
use OhMyBrew\ShopifyApp\Facades\ShopifyApp;

class SizeGuideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home')->with('sizeguieds', SizeGuide::all() );
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate data input
        $error = $this->validate( $request,[
            'title' => 'required|max:255',
        ] );

        $shop_domain = ShopifyApp::shop()->shopify_domain;

        //get Shop ID
        $shops = DB::table('shops')->where('shopify_domain', "$shop_domain")->first();
        $shop_id = $shops->id;

        //insert or update data if shop_id existed
        $size =  SizeGuide::where('shop_id', $shop_id)->first();

        $size->title = $request->title;
        $size->shop_id = $shop_id;
        $size->description = $request->description;
        $size->sizes = $request->tabel_size;

        $size->save();

        //after insert redirect back to route name is home
        return redirect()->route('home');
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
        $sizeguide = $sizeGuide::all()->first();
        return view('edit')->with('sizeguides', $sizeguide);
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

    public function getsize( SizeGuide $sizeGuide, Request $request){
        $shop_domain = $request->shop;
        $shops = DB::table('shops')->where('shopify_domain', "$shop_domain")->first();
        $shop_id = $shops->id;

        $sizeguide = $sizeGuide::query()->where('shop_id', "$shop_id")->first();
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Credentials: true");
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Content-Type, *");
        echo json_encode($sizeguide);
    }
}
