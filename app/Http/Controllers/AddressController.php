<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\StoreAddressRequest;
use App\Http\Requests\Api\UpdateAddressRequest;
use Illuminate\Http\JsonResponse;
use App\Models\Address;

class AddressController extends Controller
{
    protected $address;

    public function __construct(Address $address)
    {
        $this->address = $address;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $user_id = auth()->id();

        $address = $this->address->where('user_id', $user_id)->get();

        return response()->json($address, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAddressRequest $request): JsonResponse
    {
        return response()->json($this->address->create($request->all()), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $address): JsonResponse
    {
        $address = $this->address->find($address);
        if($address === null) {
            return response()->json(['message' => 'Address not found'], 404);
        }
        if($address->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        return response()->json($address, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAddressRequest $request, int $address): JsonResponse
    {
        $address = $this->address->find($address);
        if($address === null) {
            return response()->json(['message' => 'Address not found'], 404);
        }
        if($address->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $address->update($request->all());
        
        return response()->json($address, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $address): JsonResponse
    {
        $address = $this->address->find($address);
        if($address === null) {
            return response()->json(['message' => 'Address not found'], 404);
        }
        if($address->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $address->delete();
        return response()->json(['message' => 'Address was removed'], 200);
    }
}
