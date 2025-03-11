<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BannerText;
use App\Http\Resources\BannerTextResource;

class BannerTextController extends Controller
{
    //
    public function index()
    {
        return BannerTextResource::collection(BannerText::all());
    }
}
