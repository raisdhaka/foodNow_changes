<?php

namespace Modules\MobileApps\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;

class Main extends Controller
{
    /**
     * Display the mobile apps page.
     * @return Response
     */
    public function index()
    {
        $vendorAppAndroidLink = config('mobileapps.vendor_app_android_link');
        $vendorAppIosLink = config('mobileapps.vendor_app_ios_link');
        
        $driverAppAndroidLink = config('mobileapps.driver_app_android_link');
        $driverAppIosLink = config('mobileapps.driver_app_ios_link');
        
        $clientAppAndroidLink = config('mobileapps.client_app_android_link');
        $clientAppIosLink = config('mobileapps.client_app_ios_link');
        
        return view('mobileapps::index', compact(
            'vendorAppAndroidLink',
            'vendorAppIosLink',
            'driverAppAndroidLink',
            'driverAppIosLink',
            'clientAppAndroidLink',
            'clientAppIosLink'
        ));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('mobile-apps::create');
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
        return view('mobile-apps::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('mobile-apps::edit');
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
