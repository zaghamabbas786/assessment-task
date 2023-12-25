<?php

namespace App\Http\Controllers;

use App\Services\AffiliateService;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function __construct(
        protected OrderService $orderService
    ) {}

    /**
     * Pass the necessary data to the process order method
     * 
     * @param  Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $orderData = [
            'order_id' => $request->input('order_id'),
            'subtotal_price' => $request->input('subtotal_price'),
            'merchant_domain' => $request->input('merchant_domain'),
            'discount_code' => $request->input('discount_code'),
            'customer_email' => $request->input('customer_email'),
            'customer_name' => $request->input('customer_name'),
        ];

        // Call the processOrder method from the OrderService
        $this->orderService->processOrder($orderData);

        // Return a JSON response indicating success
        return response()->json(['message' => 'Order processed successfully']);
       }
}
