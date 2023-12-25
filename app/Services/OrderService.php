<?php

namespace App\Services;

use App\Models\Affiliate;
use App\Models\Merchant;
use App\Models\Order;
use App\Models\User;

class OrderService
{
    public function __construct(
        protected AffiliateService $affiliateService
    ) {}

    /**
     * Process an order and log any commissions.
     * This should create a new affiliate if the customer_email is not already associated with one.
     * This method should also ignore duplicates based on order_id.
     *
     * @param  array{order_id: string, subtotal_price: float, merchant_domain: string, discount_code: string, customer_email: string, customer_name: string} $data
     * @return void
     */
    public function processOrder(array $data)
    {
        /**
         * Because this method is depend of afiliateservice register  method so again it is confusing.
         * if afiliate method will be clear the rest of thing will be clear  what exactly we want  to achive.
        */

        // $this->affiliateService->register($customerEmail, $customerName);
  
        if (!orderExists($data['order_id'])) {
            Order::create([
                'order_id' => $data['order_id'],
                'subtotal_price' => $data['subtotal_price'],
                'merchant_domain' => $data['merchant_domain'],
                'discount_code' => $data['discount_code'],
                'customer_email' => $data['customer_email'],
                'customer_name' => $data['customer_name'],
                'affiliate_id' => $affiliate->id,
            ]);
        }

 }


 protected function orderExists(string $orderId): bool
 {
     return Order::where('order_id', $orderId)->exists();
 }
}
