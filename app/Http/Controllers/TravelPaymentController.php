<?php

namespace App\Http\Controllers;

use App\Models\TravelPayment;
use App\Services\TravelPaymentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TravelPaymentController extends Controller
{
    private TravelPaymentService $travelPaymentService;

    /**
     * @param TravelPaymentService $travelPaymentService
     */
    public function __construct(TravelPaymentService $travelPaymentService)
    {
        $this->travelPaymentService = $travelPaymentService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json($this->travelPaymentService->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $payment = $this->travelPaymentService->create($request);

        return response()->json(['payment' => $payment, 'status' => 201, 'message' => 'Payment created']);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(TravelPayment $travelPayment): JsonResponse
    {
        return response()->json(compact('travelPayment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, TravelPayment $travelPayment): JsonResponse
    {
        $this->travelPaymentService->update($travelPayment, $request);

        return response()->json(['status' => 200, 'message' => 'Payment updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TravelPayment $travelPayment
     * @return JsonResponse
     */
    public function destroy(TravelPayment $travelPayment): JsonResponse
    {
        $this->travelPaymentService->delete($travelPayment);

        return response()->json(['status' => 200, 'message' => 'Payment deleted']);
    }
}
