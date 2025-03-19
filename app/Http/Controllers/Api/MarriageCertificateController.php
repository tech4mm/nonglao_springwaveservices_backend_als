<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MarriageCertificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MarriageCertificateController extends Controller
{
    //
    public function getMarriageCertificateInfo()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $marriageCertificate = MarriageCertificate::where('user_id', $user->id)->first();

        if (!$marriageCertificate) {
            return response()->json(['message' => 'Marriage Certificate not found'], 404);
        }

        return response()->json($marriageCertificate);
    }
}
