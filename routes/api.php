<?php

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\Api\BannerImageController;
use App\Http\Controllers\Api\BannerTextController;
use App\Http\Controllers\Api\PrivacyPolicyController;
use App\Http\Controllers\Api\TermsConditionController;

Route::post("register", [ApiController:: class, "register"]);
Route::post("login", [ApiController::class, "login"]);

Route::get('/banner_image', [BannerImageController::class, 'index']);
Route::get('/banner_text', [BannerTextController::class, 'index']);
Route::get('/terms_condition', [TermsConditionController::class, 'index']);
Route::get('/privacy_policy', [PrivacyPolicyController::class, 'index']);

Route::group(["middleware" => ["auth:sanctum"]], function(){
    Route::get("profile", [ApiController::class, "profile"]);
    Route::get("logout", [ApiController::class, "logout"]);
});
// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
