<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PassportExtensionRequirementResource;
use App\Models\PassportExtensionRequirement;
use Illuminate\Http\Request;

class PassportExtensionRequirementController extends Controller
{
    //
    public function index(){
        return PassportExtensionRequirementResource::collection(PassportExtensionRequirement::all());
    }
}
