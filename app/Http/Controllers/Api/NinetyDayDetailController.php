<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NinetyDayInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WorkPermitDetail;

class NinetyDayDetailController extends Controller
{
    //
    public function getNinetyDayInfo()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $ninetyDayInfo = NinetyDayInfo::where('user_id', $user->id)->first();

        if (!$ninetyDayInfo) {
            return response()->json(['message' => 'Ninety Day Info not found'], 404);
        }

        return response()->json($ninetyDayInfo);
    }
}
