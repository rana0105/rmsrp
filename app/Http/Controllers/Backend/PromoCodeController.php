<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Models\Backend\PromoCode;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class PromoCodeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    
    public function index()
    {
        $promoCodeList = Promocode::all();
        // return $promoCodeList->count();
        return view('backend.promoCode.index',compact('promoCodeList'));
    }

    public function exportCSV(){
        
        if(Promocode::all()->count() > 0){
        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
        ,   'Content-type'        => 'text/csv'
        ,   'Content-Disposition' => 'attachment; filename=promoCodes.csv'
        ,   'Expires'             => '0'
        ,   'Pragma'              => 'public'
        ];
        $list = Promocode::all()->toArray();
        array_unshift($list, array_keys($list[0]));
        $callback = function() use ($list) 
        {
            $FH = fopen('php://output', 'w');
            foreach ($list as $row) { 
                fputcsv($FH, $row);
            }
            fclose($FH);
        };
         return Response::stream($callback, 200, $headers);
    }else{
        return redirect()->back()->with('error','No data found to export');
    }
    }

    public function exportXL(){

        if(Promocode::all()->count() > 0){
        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
        ,   'Content-type'        => 'text/xl'
        ,   'Content-Disposition' => 'attachment; filename=promoCodes.xls'
        ,   'Expires'             => '0'
        ,   'Pragma'              => 'public'
        ];
        
        $list = Promocode::all()->toArray();
        array_unshift($list, array_keys($list[0]));
        $callback = function() use ($list) 
        {
            $FH = fopen('php://output', 'w');
            foreach ($list as $row) { 
                fputcsv($FH, $row);
            }
            fclose($FH);
        };
        return Response::stream($callback, 200, $headers);
    }else{
        return redirect()->back()->with('error','No data found to export');
    }
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
        $this->validate($request, [
            'quantity' => 'required',
            'type' => 'required',
            'discount' => 'required',
            'edate' => 'required',
            ]);
            // return $request->all();
       for ($i=0; $i < $request->quantity; $i++) { 
            $seed = str_split('abcdefghijklmnopqrstuvwxyz'
                     .'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                     .'0123456789'); // and any other characters
            shuffle($seed); // probably optional since array_is randomized; this may be redundant
            $rand = '';
            foreach (array_rand($seed, 6) as $k) $rand .= $seed[$k];

            $promoCode = new PromoCode();
            // $promoCode->promoCode = Str::random(6)->unique();
            $promoCode->promoCode = $rand;
            $promoCode->isFixed = $request->type;
            $promoCode->discount = $request->discount;
            $promoCode->edate = $request->edate;
            $promoCode->save();
        }
        return redirect()->back()->with('success', 'promocode created successfully');
    }

    public function customCode(Request $request)
    {
       $this->validate($request, [
            'pcode' => 'required',
            'type' => 'required',
            'discount' => 'required',
            'edate' => 'required',
            ]);
            $promoCode = new PromoCode();
            $promoCode->promoCode = $request->pcode;
            $promoCode->isFixed = $request->type;
            $promoCode->discount = $request->discount;
            $promoCode->edate = $request->edate;
            $promoCode->save();
            
        return redirect()->back()->with('success', 'promocode created successfully');
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
