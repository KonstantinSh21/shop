<?php

class Shop
{
    static public $MAX_CASH_BOX = 3;
    static public $personInShop = 0;
    static public $startShop = false;
    static public $workCashShop = [];

    static public function createRandomPerson()
    {
        $amountRandomPerson = rand(0, 3);
        print_r("Пользователей зашло в магазин  " . $amountRandomPerson . "  ");

        for ($i = 0; $i < $amountRandomPerson; $i++) {
            $newPerson = new Person();
            $newPerson->visitShop($amountRandomPerson);
        }
        Person::searchCashShop($amountRandomPerson);
    }

    public function startShop()
    {
        self::$startShop = true;
        for ($i = 0; $i < self::$MAX_CASH_BOX; $i++) {
            $newCashShop = new CashShop();
            array_push(Shop::$workCashShop, $newCashShop);
        }
    }

    static public function startCashShop($i)
    {
        Shop::$workCashShop[$i++]->isWork = true;
    }

    static public function addPersonInLine($i, $amountRandomPerson)
    {
        Shop::$workCashShop[$i++]->personInLine += $amountRandomPerson;
    }
}