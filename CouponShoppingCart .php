<?php

class CouponShoppingCart extends ShoppingCart
{
    const SUPERMART_DEV = 1000;

    public function checkout($paid_amount)
    {
        $amountToBePaid = $this->grossTotal -  self::SUPERMART_DEV;
        if ($paid_amount < $amountToBePaid) {
            return  "insufficient funds";
        } else {
            $this->items = [];
            return $paid_amount - $amountToBePaid;
        }
    }
}
