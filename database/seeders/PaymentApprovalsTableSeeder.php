<?php

namespace Database\Seeders;

use App\Services\PaymentApprovalService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentApprovalsTableSeeder extends Seeder
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
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->paymentApprovalService->storeAll();
    }
}
