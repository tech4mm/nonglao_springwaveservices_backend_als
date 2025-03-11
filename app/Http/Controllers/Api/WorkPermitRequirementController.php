<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WorkPermitRequirementResource;
use App\Models\WorkPermitRequirement;
use Illuminate\Http\Request;

class WorkPermitRequirementController extends Controller
{
    //
    public function index(){
        return WorkPermitRequirementResource::collection(WorkPermitRequirement::all());
    }
}
