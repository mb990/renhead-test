<?php

namespace App\Services;

use App\Models\Payment;

class ReportService
{
    private UserService $userService;
    private PaymentService $paymentService;
    private TravelPaymentService $travelPaymentService;
    private PaymentApprovalService $paymentApprovalService;

    /**
     * @param UserService $userService
     * @param PaymentService $paymentService
     * @param TravelPaymentService $travelPaymentService
     * @param PaymentApprovalService $paymentApprovalService
     */
    public function __construct(UserService            $userService,
                                PaymentService         $paymentService,
                                TravelPaymentService   $travelPaymentService,
                                PaymentApprovalService $paymentApprovalService)
    {
        $this->userService = $userService;
        $this->paymentService = $paymentService;
        $this->travelPaymentService = $travelPaymentService;
        $this->paymentApprovalService = $paymentApprovalService;
    }

    /**
     * @return array
     */
    public function generateReport(): array
    {
        $reportData = [];

        $approvers = $this->userService->allApprovers();

        $paymentApprovals = $this->paymentApprovalService->all();

        foreach ($paymentApprovals as $paymentApproval) {

            if ($paymentApproval->payment_type === "App\Models\Payment") {
                $amount = $this->paymentService->find($paymentApproval->payment_id)->total_amount;
            }
            else {
                $amount = $this->travelPaymentService->find($paymentApproval->payment_id)->amount;
            }

            // approve payment
            foreach ($approvers as $approver) {
                if ($approver->type === 'approver') {
                    if (isset($reportData[$approver->first_name . ' ' . $approver->last_name]['totalApprovedSum'])) {
                        $reportData[$approver->first_name . ' ' . $approver->last_name]['totalApprovedSum'][0] += $amount;
                    }
                    else {
                        $reportData[$approver->first_name . ' ' . $approver->last_name]['totalApprovedSum'][] = $amount;
                    }

                    // if all approvers have voted
                    if (next($approvers) !== true) {
                        $paymentApproval->status = 'approved';
                    }
                }
            }
        }

        return $reportData;
    }
}
