<?php

namespace Modules\Qrgen\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

require __DIR__.'/../../vendor/autoload.php';

use SimpleSoftwareIO\QrCode\Facades\QrCode;



class Main extends Controller
{
   
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index($name)
    {
        $filename=$name;
        if (!extension_loaded('imagick')) {
            $filename=str_replace(".png",".svg",$filename);
            $headers = ['Content-Type: image/svg'];
            QrCode::size(512)->generate($_GET['data'],public_path('uploads/restorants/'). $filename);
        }else{
            $headers = ['Content-Type: image/png'];
            QrCode::size(512)->format('png')->generate($_GET['data'],public_path('uploads/restorants/'). $filename);
        }
       
        $file = public_path('uploads/restorants/'). $filename;
       
        return \Response::download($file, $filename, $headers);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('qrgen::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('qrgen::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('qrgen::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
