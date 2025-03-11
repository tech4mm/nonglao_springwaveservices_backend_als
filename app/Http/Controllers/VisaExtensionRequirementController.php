<?php

namespace App\Http\Controllers;

use App\Http\Resources\VisaExtensionRequirementResource;
use App\Models\VisaExtensionRequirement;
use Illuminate\Http\Request;

class VisaExtensionRequirementController extends Controller
{
    //
    public function index(){
        return VisaExtensionRequirementResource::collection(VisaExtensionRequirement::all());
    }
}
