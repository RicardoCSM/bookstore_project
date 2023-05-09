<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\StoreOrderRequest;
use App\Http\Requests\Api\UpdateOrderRequest;
use Illuminate\Http\JsonResponse;
use App\Models\Order;

class OrderController extends Controller
{
    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $user_id = auth()->id();

        $orders = $this->order->with('book', 'address')->where('user_id', $user_id)->paginate(6);

        return response()->json($orders, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request): JsonResponse
    {
        return response()->json($this->order->create($request->all()), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $order): JsonResponse
    {
        $order = $this->order->with('book', 'address')->find($order);
        if($order === null) {
            return response()->json(['message' => 'Order not found'], 404);
        }
        if($order->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        return response()->json($order, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, int $order): JsonResponse
    {
        $order = $this->order->find($order);
        if($order === null) {
            return response()->json(['message' => 'Order not found'], 404);
        }
        if($order->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $order->update($request->all());
        
        return response()->json($order, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $order): JsonResponse
    {
        $order = $this->order->find($order);
        if($order === null) {
            return response()->json(['message' => 'Order not found'], 404);
        }
        if($order->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $order->delete();
        return response()->json(['message' => 'Order was removed'], 200);
    }
}
