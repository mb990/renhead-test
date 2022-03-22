<?php

namespace App\Services;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class PaymentService
{
    private UserService $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return Payment::all();
    }

    /**
     * @param int $id
     * @return Payment
     */
    public function find(int $id): Payment
    {
        return Payment::find($id);
    }

    /**
     * @param Request $request
     * @return Payment
     */
    public function create(Request $request): Payment
    {
        return Payment::create($request->all());
    }

    /**
     * @param Payment $payment
     * @param Request $request
     * @return void
     */
    public function update(Payment $payment, Request $request): void
    {
        $payment->update($request->all());
    }

    /**
     * @param int $id
     */
    public function delete(int $id): void
    {
        $this->find($id)->delete();
    }

    public function paymentApproval(array $payments)
    {
        $approvers = $this->userService->allApprovers();

        foreach ($approvers as $approver) {



        }
    }
}
