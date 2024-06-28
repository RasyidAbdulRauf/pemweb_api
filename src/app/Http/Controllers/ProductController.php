<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = DB::connection('mysql')->table('products')->get();
        return response()->json($query, 200);
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
            'nama' => 'required|string'
        ]);

        $product = DB::connection('mysql')->table('products')->insert([
            'nama' => $request['nama'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return response()->json(
            [
                'success' => true, 
                'message' => 'product created successfully ' . $request->nama
            ]
            , 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = DB::connection('mysql')->table('products')->where('id', $id)->first();
        $responstrue = [
            'success' => true,
            'message' => 'product founded',
            'data' => $product
        ];

        $responsfalse = [
            'success' => false,
            'message' => 'product notfounded',
        ];
        if(is_null($product)){
            return response()->json($responsfalse, 404);
        } else {
            return response()->json($responstrue, 201);
        }
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
        $this->validate($request, [
            'nama' => 'required|string'
        ]);

        $product = DB::connection('mysql')->table('products')->where('id', $id)->first();

        $responsfalse = [
            'success' => false,
            'message' => 'product notfounded',
        ];
        if(is_null($product)){
            return response()->json($responsfalse, 404);
        } else {
            $dataproduct = [
                'nama' => $request->input(['nama']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
            $product = DB::connection('mysql')->table('products')->update($dataproduct);
            $dataupdate = DB::connection('mysql')->table('products')->where('id', $id)->first();
            $responstrue = [
                'success' => true,
                'message' => 'product founded',
                'data' => $dataupdate
            ];
            return response()->json($responstrue, 201);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = DB::connection('mysql')->table('products')->where('id', $id)->first();
        $responstrue = [
            'success' => true,
            'message' => 'product success delete',
        ];

        $responsfalse = [
            'success' => false,
            'message' => 'product notfounded',
        ];
        if(is_null($product)){
            return response()->json($responsfalse, 404);
        } else {
            DB::connection('mysql')->table('products')->where('id', $id)->delete();
            return response()->json($responstrue, 201);
        }
    }
}
