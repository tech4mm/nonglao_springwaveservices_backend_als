<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\VisaDetail;

class VisaDetailController extends Controller
{
    //
    public function getVisaInfo()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $visaDetail = VisaDetail::where('user_id', $user->id)->first();

        if (!$visaDetail) {
            return response()->json(['message' => 'Visa information not found'], 404);
        }

        return response()->json($visaDetail);
    }
}
