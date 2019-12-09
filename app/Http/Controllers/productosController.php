<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\productos;
use App\Busquedas;
use App\busquedas_view;
class productosController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id=0)
    {
        
        if($id == '0'){
            $productos= productos::all();
            return response()->json($productos);
        }else{
            $productos= productos::where("titulo","like","%".$id."%")->get();
            if(count($productos)>0){
                foreach($productos as $v){
                    $bus=new busquedas();
                    $bus->bus_text=$id;
                    $bus->bus_pro_id=$v->id;
                    $bus->bus_fecha=date('Y-m-d h:i:s');
                    $bus->save();
                }
                return response()->json($productos);
            }
        }
    }

    public function getBusquedas(){
        DB::select('call refresh_bsuquedas_view;');

        $busquedas= busquedas_view::all();
        $data=array(); $dataf=[];
        foreach($busquedas as $v){
            if(!array_key_exists($v->titulo,$data))
            $data[$v->titulo]=$v->bus_text."(".$v->total.")";
            else{
            if(count($data[$v->titulo])<5)    
            $data[$v->titulo]=$data[$v->titulo].",".$v->bus_text."(".$v->total.")";
            }

        }

        foreach($data as $key => $v){
            array_push($dataf,["titulo"=>$key,"valor"=>$v] );
        }

        return response()->json($dataf);
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
