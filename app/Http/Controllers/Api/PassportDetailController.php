<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PassportDetail;

class PassportDetailController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        $passport = PassportDetail::where('user_id', $user->id)->first();

        if (!$passport) {
            return response()->json(['message' => 'No passport details found'], 404);
        }

        return response()->json($passport);
    }
}
