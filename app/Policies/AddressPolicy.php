<?php

namespace App\Policies;

use App\Models\Address;
use Illuminate\Contracts\Auth\Authenticatable;

class AddressPolicy
{
    protected $user;

    public function update(Authenticatable $user, Address $address)
    {
        return $user->id === $address->user_id;
    }

    public function show(Authenticatable $user, Address $address)
    {
        return $user->id === $address->user_id;
    }

    public function destroy(Authenticatable $user, Address $address)
    {
        return $user->id === $address->user_id;
    }

}
