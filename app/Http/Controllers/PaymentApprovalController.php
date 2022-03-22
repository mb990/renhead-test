<?php

namespace App\Http\Controllers;

use App\Services\PaymentApprovalService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PaymentApprovalController extends Controller
{
    private PaymentApprovalService $paymentApprovalService;

    /**
     * @param PaymentApprovalService $paymentApprovalService
     */
    public function __construct(PaymentApprovalService $paymentApprovalService)
    {
        $this->paymentApprovalService = $paymentApprovalService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $this->paymentApprovalService->storeAll();

        return response()->json(['status' => 201, 'message' => 'Payment approvals stored']);
    }
}
