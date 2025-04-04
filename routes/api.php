<?php

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\Api\BannerImageController;
use App\Http\Controllers\Api\BannerTextController;
use App\Http\Controllers\Api\CompanyDetailsController;
use App\Http\Controllers\Api\ContactUsController;
use App\Http\Controllers\Api\MarriageCertificateRequirementController;
use App\Http\Controllers\Api\PassportExtensionRequirementController;
use App\Http\Controllers\Api\PrivacyPolicyController;
use App\Http\Controllers\Api\SocialController;
use App\Http\Controllers\Api\TermsConditionController;
use App\Http\Controllers\Api\WorkPermitRequirementController;
use App\Http\Controllers\NinetyDayRequirementController;
use App\Http\Controllers\VisaExtensionRequirementController;
use App\Http\Controllers\Api\NinetyDayDetailController;
use App\Http\Controllers\Api\VisaDetailController;
use App\Http\Controllers\Api\WorkerInfoController;
use App\Http\Controllers\Api\PassportDetailController;
use App\Http\Controllers\Api\WorkPermitDetailController;
use App\Http\Controllers\Api\MarriageCertificateController;
use App\Http\Controllers\Api\FcmTokenController;
use App\Http\Controllers\Api\ExpireInfoController;
use App\Http\Controllers\AdminNotificationController;
use App\Http\Controllers\MessageFileController;
use App\Http\Controllers\Api\ChatController;
use App\Models\ReportLiveInThRequirement;
use App\Models\RecommendationLetterBanner;
use App\Models\CertOfNVToOpenBankAccRequirement;
use App\Models\CertificateOfAddressVerification;
use App\Models\PassportDeclaration;
use App\Models\BeingSingle;
use App\Models\DependencyRelative;
use App\Models\OtherCertificate;

Route::post("register", [ApiController:: class, "register"]);
Route::post('otp_register', [ApiController::class, 'otp_register']);
Route::post("login", [ApiController::class, "login"]);

Route::get('/banner_image', [BannerImageController::class, 'index']);
Route::get('/banner_text', [BannerTextController::class, 'index']);
Route::get('/terms_condition', [TermsConditionController::class, 'index']);
Route::get('/privacy_policy', [PrivacyPolicyController::class, 'index']);
Route::get('/company_details', [CompanyDetailsController::class, 'index']);
Route::get('/contact_us', [ContactUsController::class, 'index']);
Route::get('/social', [SocialController::class, 'index']);
Route::get('/work_permit_requirements', [WorkPermitRequirementController::class, 'index']);
Route::get('/visa_extension_requirements', [VisaExtensionRequirementController::class, 'index']);
Route::get('/passport_extension_requirements', [PassportExtensionRequirementController::class, 'index']);
Route::get('/marriage_certificate_requirements', [MarriageCertificateRequirementController::class, 'index']);
Route::get('/ninety_day_requirements', [NinetyDayRequirementController::class, 'index']);

Route::post('/forgot_password', [ApiController::class, 'forgot_password']);
Route::post('/otp_forgot_password', [ApiController::class, 'otp_forgot_password']);

Route::get('/report_live_in_th_requirement', function () {
    return ReportLiveInThRequirement::all();
});

Route::get('/recommendation_letter_banner', function () {
    return RecommendationLetterBanner::all();
});

Route::get('/cert-nv-bank-requirements', function () {
    return CertOfNVToOpenBankAccRequirement::all();
});

Route::get('/certificate-of-address-verification', function () {
    return CertificateOfAddressVerification::all();
});

Route::get('/passport-declaration', function () {
    return PassportDeclaration::all();
});

Route::get('/being-single', function () {
    return BeingSingle::all();
});

Route::get('/dependency-relative', function () {
    return DependencyRelative::all();
});

Route::get('/other-certificates', function () {
    return OtherCertificate::all();
});

Route::group(["middleware" => ["auth:sanctum"]], function(){
    Route::get("profile", [ApiController::class, "profile"]);
    Route::get("logout", [ApiController::class, "logout"]);
    Route::get("worker_info", [WorkerInfoController::class, "getWorkerInfo"]);
    Route::get('/passport_info', [PassportDetailController::class, 'show']);
    Route::get('/visa_info', [VisaDetailController::class, 'getVisaInfo']);
    Route::get('/work_permit_info', [WorkPermitDetailController::class, 'getWorkPermitInfo']);
    Route::get('/ninety_day_info', [NinetyDayDetailController::class, 'getNinetyDayInfo']);
    Route::get('/marriage_info', [MarriageCertificateController::class, 'getMarriageCertificateInfo']);

    Route::post('/update_profile', [ApiController::class, 'update_profile']);

    Route::post('/store-fcm-token', [FcmTokenController::class, 'store']);

    Route::get('/register-info', [ApiController::class, 'get_register_info']);
    Route::get('/get_household_reg', [ApiController::class, 'get_household_reg']);
    Route::get('/get_uid_req', [ApiController::class,'get_uid_req']);
    Route::get('/get_tax_payer_number', [ApiController::class, 'get_tax_payer_number']);
    Route::post('/set_tax_payer_number', [ApiController::class, 'set_tax_payer_number']);

    Route::get('/get_tax_list', [ApiController::class, 'get_tax_list']);
    Route::get('/get_owic_req', [ApiController::class, 'get_owic_req']);
    Route::get('/get_expire', [ExpireInfoController::class, 'getExpireDates']);

    Route::get('/notifications', [AdminNotificationController::class, 'index']);
    Route::get('/notifications/{id}', [AdminNotificationController::class, 'show']);

    Route::delete('/delete-account', [ApiController::class, 'deleteAccount']);

    Route::post('/change-password', [ApiController::class, 'changePassword']);

    Route::post('/chat/send', [ChatController::class, 'sendMessage']);
    Route::get('/chat/messages', [ChatController::class, 'getMessages']);

    Route::post('/upload-message-file', [MessageFileController::class, 'upload']);
});
