<?php

namespace App\Policies;

use App\Models\Order;
use Illuminate\Contracts\Auth\Authenticatable;

class AddressPolicy
{
    protected $user;

    public function update(Authenticatable $user, Order $order)
    {
        return $user->id === $order->user_id;
    }

    public function show(Authenticatable $user, Order $order)
    {
        return $user->id === $order->user_id;
    }

    public function destroy(Authenticatable $user, Order $order)
    {
        return $user->id === $order->user_id;
    }

}
