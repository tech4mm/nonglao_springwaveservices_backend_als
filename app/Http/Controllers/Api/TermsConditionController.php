<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TermsConditionResource;
use App\Models\TermsCondition;
use Illuminate\Http\Request;

class TermsConditionController extends Controller
{
    //
    public function index()
    {
        return TermsConditionResource::collection(TermsCondition::all());
    }
}
