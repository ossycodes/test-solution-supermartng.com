<?php

class ShoppingCart
{

    public $items = [];

    public $deliveryFee = 50;

    public $netTotal;

    public $grossTotal;

    public function addItem($name, $quantity, $value)
    {
        $this->items[$name][$value] = $quantity;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function removeItem($name, $quantity, $value)
    {
        unset($this->items[$name][$value]);
        if (!$this->items[$name]) {
            unset($this->items[$name]);
        }
    }

    public function calculateNetTotal()
    {
        foreach ($this->items as $quantity) {
            $values = array_keys($quantity);
            foreach ($values as $price) {
                $this->netTotal += $price;
            }
        }
    }

    public function calculateGrossTotal()
    {
        $this->grossTotal = $this->netTotal + $this->deliveryFee;
    }

    public function calculateDeliveryFee()
    {
        $this->deliveryFee =  count($this->items) * $this->deliveryFee;
    }

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
    const SUPERMART_DEV = 30;

    public function checkout($paid_amount)
    {
        $amountToBePaid = $this->grossTotal - self::SUPERMART_DEV;
        if ($paid_amount < $amountToBePaid) {
            return  "insufficient funds";
        } else {
            $this->items = [];
            return $paid_amount - $amountToBePaid;
        }
    }
}
