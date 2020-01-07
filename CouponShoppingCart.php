<?php

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

$a = new CouponShoppingCart();

$a->addItem("a", 2, 5);
$a->addItem("b", 2, 15);
$a->addItem("c", 2, 10);
print_r($a->calculateNetTotal());
print_r("net total" . $a->netTotal);
echo "<br><br>";
print_r($a->calculateDeliveryFee());
echo "<br><br>";
print_r("Total Deliveryfee" . $a->deliveryFee);
echo "<br><br>";
print_r("GrossTotal" . $a->grossTotal);
print_r($a->calculateGrossTotal());
print_r($a->grossTotal);
echo "<br><br>";
print_r($a->checkout(180));