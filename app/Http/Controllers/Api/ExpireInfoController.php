<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpireInfoController extends Controller
{
    //
    public function getExpireDates(Request $request)
    {
        $user = Auth::user();

        return response()->json([
            'passport_expire_date' => optional($user->passportDetail)->passport_expire_date,
            'visa_expire_date' => optional($user->visaDetail)->visa_expire_date,
            'work_permit_expire_date' => optional($user->workPermitDetail)->work_permit_expire_date,
            'ninety_day_expire_date' => optional($user->ninetyDayInfo)->expire_date,
        ]);
    }
}
