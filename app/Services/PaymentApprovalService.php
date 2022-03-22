<?php

namespace App\Services;

use App\Models\Payment;
use App\Models\PaymentApproval;
use App\Models\TravelPayment;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PaymentApprovalService
{
    private PaymentService $paymentService;
    private TravelPaymentService $travelPaymentService;

    /**
     * @param PaymentService $paymentService
     * @param TravelPaymentService $travelPaymentService
     */
    public function __construct(PaymentService $paymentService, TravelPaymentService $travelPaymentService)
    {
        $this->paymentService = $paymentService;
        $this->travelPaymentService = $travelPaymentService;
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return PaymentApproval::all();
    }

    /**
     * @param Model $payment
     * @return PaymentApproval
     */
    public function create(Model $payment): PaymentApproval
    {
        $data = $this->prepareApproveData($payment);

        return $this->store($data);
    }

    /**
     * @param array $data
     * @return PaymentApproval
     */
    public function store(array $data): PaymentApproval
    {
        return PaymentApproval::create($data);
    }

    /**
     * @param Model $payment
     * @return array
     */
    public function prepareApproveData(Model $payment): array
    {
        $data = [];

        /**
         * since it is an abstract test, we will take a random user
         */
        $user = User::inRandomOrder()->first();
        $data['user_id'] = $user->id;
        $data['payment_id'] = $payment->id;
        if ($payment instanceof (Payment::class)) {
            $data['payment_type'] = Payment::class;
        } else {
            $data['payment_type'] = TravelPayment::class;
        }
        $data['status'] = 'disapproved';
        return $data;
    }

    /**
     * Make payment approvals for all type of payments with disapproved status
     *
     * @return bool
     */
    public function storeAll(): bool
    {
        $payments = $this->paymentService->all();
        $travelPayments = $this->travelPaymentService->all();

        $allPayments = $payments->merge($travelPayments);

        foreach ($allPayments as $payment) {
            $this->create($payment);
        }

        return true;
    }
}
