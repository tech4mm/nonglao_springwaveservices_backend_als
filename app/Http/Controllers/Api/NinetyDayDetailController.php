<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

        $workPermitDetail = WorkPermitDetail::where('user_id', $user->id)->first();

        if (!$workPermitDetail) {
            return response()->json(['message' => 'Work Permit information not found'], 404);
        }

        return response()->json($workPermitDetail);
    }
}
