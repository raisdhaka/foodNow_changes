<?php

namespace Modules\Themeswitcher\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class MenuDesignController extends Controller
{
    /**
     * Display the menu design page.
     * 
     * @return Response
     */
    public function index()
    {
        $restaurant = Auth::user()->restorant;
        
        if ($restaurant) {
        $currentTemplate = $restaurant->getConfig('menu_template', 'defaulttemplate');


        
        // Get the URL to the vendor's public page
        $urlToVendor = $restaurant->getLinkAttribute();    
        }else{
            $restaurant='';
            $currentTemplate='';
            $urlToVendor='';
        }
        
        

        
        return view('themeswitcher::menu_design', [
            'restaurant' => $restaurant,
            'currentTemplate' => $currentTemplate,
            'urlToVendor' => $urlToVendor
        ]);
    }

    /**
     * Update the menu template for the restaurant.
     * 
     * @param Request $request
     * @return Response
     */
    public function updateTemplate(Request $request)
    {
        $restaurant = Auth::user()->restorant;
        $template = $request->input('template');
        // Update the restaurant config
        $restaurant->setConfig('menu_template', $template);
        
        
        return redirect()->route('themeswitcher.menu_design')
            ->with('success', 'Menu template updated successfully');
    }
} 