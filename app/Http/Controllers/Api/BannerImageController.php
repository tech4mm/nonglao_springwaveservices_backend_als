<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\BannerImageResource;
use App\Models\BannerImage;

class BannerImageController extends Controller
{
    //
    public function index(){
        return BannerImageResource::collection(BannerImage::all());
    }
}
