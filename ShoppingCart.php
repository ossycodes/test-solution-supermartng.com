<?php

class ShoppingCart
{
    //collection of cart item
    public $items = [];

    // value of delivery fee, 50 Naira per cart item
    public $deliveryFee = 50;

    //total amount of item in the cart
    public $netTotal;

    // total amount of everything, price of item and delivery fee
    public $grossTotal;

    //add item to shopping cart
    public function addItem($name, $quantity, $value)
    {
        $this->items[$name][$value] = $quantity;
    }

    //retrieves all items in the cart
    public function getItems()
    {
        return $this->items;
    }

    //removes item from shopping cart
    public function removeItem($name, $quantity, $value)
    {
        unset($this->items[$name][$value]);
        if (!$this->items[$name]) {
            unset($this->items[$name]);
        }
    }

    //calculates the total amount of item in the cart and stores it in the $netTotal variable
    public function calculateNetTotal()
    {
        foreach ($this->items as $quantity) {
            $values = array_keys($quantity);
            foreach ($values as $price) {
                $this->netTotal += $price;
            }
        }
    }

    // calculates total amount of everything, price of item and delivery fee and stores in the $grossTotal variable
    public function calculateGrossTotal()
    {
        $this->grossTotal = $this->netTotal + $this->deliveryFee;
    }

    // returns calculated delivery fee based on items
    public function calculateDeliveryFee()
    {
        return $this->deliveryFee =  count($this->items) * $this->deliveryFee;
    }


    //checkout
    public function checkout($paid_amount)
    {
        if ($paid_amount < $this->grossTotal) {
            return  "insufficient funds";
        } else {
            $this->items = [];
            return $paid_amount -  $this->grossTotal;
        }
    }
}

class CouponShoppingCart extends ShoppingCart
{
    // Coupon 
    const SUPERMART_DEV = 1000;

    //overides the checkout method in the parents class (ShoppingCart)
    public function checkout($paid_amount)
    {
        $amountToBePaid = $this->grossTotal - self::SUPERMART_DEV;
        if ($paid_amount < $amountToBePaid) {
            return  "insufficient funds";
        } else {
            //clear cart
            $this->items = [];
            //return balance
            return $paid_amount - $amountToBePaid;
        }
    }
}
