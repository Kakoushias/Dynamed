<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;


class CCDController extends Controller
{
    public function import(Request $request){

    	

    	$file = storage_path('epic_phr.xml');

    	

    	$xml = file_get_contents($file);



    	

    	$patient = Patient::import($xml);
	
    	return redirect()->route('home');
    }
}
