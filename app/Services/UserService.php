<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    /**
     * @return Collection
     */
    public function allApprovers(): Collection
    {
        return User::where('type', 'approver')
            ->get();
    }

    /**
     * @param int $id
     * @return User
     */
    public function find(int $id): User
    {
        return User::find($id);
    }
}
