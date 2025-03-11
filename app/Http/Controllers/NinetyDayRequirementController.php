<?php

namespace App\Http\Controllers;

use App\Http\Resources\NinetyDayRequirementResource;
use App\Models\NinetyDayRequirement;
use Illuminate\Http\Request;

class NinetyDayRequirementController extends Controller
{
    //
    public function index(){
        return NinetyDayRequirementResource::collection(NinetyDayRequirement::all());
    }
}
