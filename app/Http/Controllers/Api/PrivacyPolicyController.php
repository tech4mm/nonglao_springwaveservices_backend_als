<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\PrivacyPolicyResource;
use App\Models\PrivacyPolicy;


class PrivacyPolicyController extends Controller
{
    //
    public function index(){
        return PrivacyPolicyResource::collection(PrivacyPolicy::all());
    }
}
