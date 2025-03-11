<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyDetailsResource;
use App\Models\CompanyDetails;
use Illuminate\Http\Request;

class CompanyDetailsController extends Controller
{
    //
    public function index(){
        return CompanyDetailsResource::collection(CompanyDetails::all());
    }
}
