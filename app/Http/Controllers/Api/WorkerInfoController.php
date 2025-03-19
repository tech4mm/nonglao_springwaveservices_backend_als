<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WorkerInfo;

class WorkerInfoController extends Controller
{
    //
    public function getWorkerInfo()
    {
        // Get authenticated user
        $user = Auth::user();

        // Fetch worker info with user details
        $workerInfo = WorkerInfo::where('user_id', $user->id)->first();

        if (!$workerInfo) {
            return response()->json([
                'message' => 'Worker info not found'
            ], 404);
        }

        return response()->json([
            'user_id'          => $user->id,
            'user_picture'     => $user->user_picture,
            'name'             => $user->name,
            'other_name'       => $workerInfo->other_name ?? null,
            'gender'           => $workerInfo->gender ?? null,
            'date_of_birth'    => $workerInfo->date_of_birth ?? null,
            'passport_no'      => $workerInfo->passport_no,
            'date_of_issue'    => $workerInfo->date_of_issue,
            'place_of_issue'   => $workerInfo->place_of_issue,
            'company_name'     => $workerInfo->company_name,
            'thai_phone_no'    => $workerInfo->thai_phone_no ?? null,
            'myan_phone_no'    => $workerInfo->myan_phone_no ?? null,
            'thai_address'     => $workerInfo->thai_address ?? null,
            'myan_address'     => $workerInfo->myan_address ?? null,
            'work_place_address' => $workerInfo->work_place_address ?? null,
        ], 200);
    }
}
