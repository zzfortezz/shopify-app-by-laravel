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
        $shop_domain = ShopifyApp::shop()->shopify_domain;
        $data = SizeGuide::where('shop_domain', "$shop_domain")->get();
        return view('home')->with('sizeguieds', $data );
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shop = ShopifyApp::shop();
        $collections[] = $shop->api()->rest('GET', '/admin/custom_collections.json')->body->custom_collections;
        $collections[] = $shop->api()->rest('GET', '/admin/smart_collections.json')->body->smart_collections;



        return view('create')->with('collections', $collections);
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

        //insert or update data if shop_id existed
        SizeGuide::updateOrCreate([ 'shop_domain' => $shop_domain],[
            'title' => $request->title,
            'shop_domain' => $shop_domain,
            'description' => $request->description,
            'sizes' => $request->tabel_size
        ]);

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
    public function edit(SizeGuide $sizeGuide, Request $request)
    {
        $shop_domain = ShopifyApp::shop()->shopify_domain;

        $sizes =  DB::table('size_guides')->where('shop_domain', $shop_domain)->first();

        return view('edit')->with('sizeguides', $sizes);
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

        $sizeguide = DB::table('size_guides')->where('shop_domain', $shop_domain)->first();

        $headers = array(
            'Access-Control-Allow-Headers' => ' Content-Type, *',
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Credentials' => true,
            'Access-Control-Allow-Methods' => 'GET'
            );
//        echo json_encode($sizeguide);
        return response()->json($sizeguide, 200, $headers);
    }

    public function get_condition( Request $request){
        $shop_domain = ShopifyApp::shop()->shopify_domain;
        $shopify = ShopifyApp::shop();
        $condition = $request->condition;
        $data = '';
        if ( isset($condition) && $condition != '' ){
            switch ($condition){
                case 'product':
                    $data = $shopify->api()->rest('GET', '/admin/products.json')->body->products;
                    break;
                case 'collection':
                    $collections[] = $shopify->api()->rest('GET', '/admin/custom_collections.json')->body->custom_collections;
                    $collections[] = $shopify->api()->rest('GET', '/admin/smart_collections.json')->body->smart_collections;
                    foreach ($collections as $collection){
                        foreach ($collection as $collect){
                            $data[]= $collect;
                        }
                    }
                    break;
            }
        }

        return response($data);
    }
}
