<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MarriageCertificateRequirementResource;
use App\Models\MarriageCertificateRequirement;
use Illuminate\Http\Request;

class MarriageCertificateRequirementController extends Controller
{
    //
    public function index(){
        return MarriageCertificateRequirementResource::collection(MarriageCertificateRequirement::all());
    }
}
