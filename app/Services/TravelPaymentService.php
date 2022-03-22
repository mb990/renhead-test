<?php

namespace App\Services;

use App\Models\TravelPayment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class TravelPaymentService
{
    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return TravelPayment::all();
    }

    /**
     * @param int $id
     * @return TravelPayment
     */
    public function find(int $id): TravelPayment
    {
        return TravelPayment::find($id);
    }

    /**
     * @param Request $request
     * @return TravelPayment
     */
    public function create(Request $request): TravelPayment
    {
        return TravelPayment::create($request->all());
    }

    /**
     * @param TravelPayment $travelPayment
     * @param Request $request
     * @return void
     */
    public function update(TravelPayment $travelPayment, Request $request): void
    {
        $travelPayment->update($request->all());
    }

    /**
     * @param TravelPayment $travelPayment
     */
    public function delete(TravelPayment $travelPayment): void
    {
        $travelPayment->delete();
    }
}
