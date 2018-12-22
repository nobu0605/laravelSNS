<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Image;
use Illuminate\Http\UploadedFile;

class ProfileMiddleware
{
  public function handle($request, Closure $next)
  {   
    $response = $next($request);
    $file = $request->image;
    $image = Image::make(file_get_contents($file->getRealPath()));
    $filePath = 'public/img/';
    $image->save(public_path().'/img/'.$file->hashName());
    
    return $response;
  }
}
