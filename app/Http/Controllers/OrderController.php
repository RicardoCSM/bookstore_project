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

        $orders = $this->order->where('user_id', $user_id)->get();

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
        $order = $this->order->find($order);
        if($order === null) {
            return response()->json(['message' => 'Order not found'], 404);
        }
        $this->authorize('show', $order);
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
        $this->authorize('update', $order);

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
        $this->authorize('destroy', $order);
        $order->delete();
        return response()->json(['message' => 'Order was removed'], 200);
    }
}
