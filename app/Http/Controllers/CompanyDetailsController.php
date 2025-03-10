<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyDetails;

class CompanyDetailsController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'application_details' => 'nullable|string',
            'company_address' => 'nullable|string',
            'company_bank_details' => 'nullable|string',
            'bank_payment_qr' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle file upload
        $bankPaymentQrPath = null;
        if ($request->hasFile('bank_payment_qr')) {
            $bankPaymentQrPath = $request->file('bank_payment_qr')->store('qr_codes', 'public');
        }

        // Save data
        $companyDetails = CompanyDetails::create([
            'application_details' => $request->input('application_details'),
            'company_address' => $request->input('company_address'),
            'company_bank_details' => $request->input('company_bank_details'),
            'bank_payment_qr' => $bankPaymentQrPath,
        ]);

        return response()->json([
            'message' => 'Company details saved successfully!',
            'data' => $companyDetails
        ], 201);
    }
}
