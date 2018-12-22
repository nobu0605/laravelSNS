<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Content;
use Illuminate\Support\Facades\DB;

class ContentController extends Controller
{
    public function index(Request $request)
    {
    	$contents =DB::table('contents')->get();
    	$count = DB::table('contents')->count();

		for ($i=0; $i < $count; $i++) { 
    		$contents_array[] = get_object_vars($contents[$i]);
		}
        return view('/index',['contents_array' => $contents_array]);
    }
}
