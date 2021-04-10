<?php
class CashShop extends Shop
{
    public $personInLine = 0;
    public $isWork = false;
    static public $MAX_PERSON = 5;

    static public function servedPerson()
    {
        for ($i = 0; $i < Shop::$MAX_CASH_BOX; $i++) {
            if (Shop::$workCashShop[$i]->isWork && Shop::$workCashShop[$i]->personInLine > 0) {
                Shop::$workCashShop[$i]->personInLine -= 1;
                if (Shop::$workCashShop[$i]->personInLine === 0) {
                    Shop::$workCashShop[$i]->isWork = false;
                }
            }
        }
    }
}