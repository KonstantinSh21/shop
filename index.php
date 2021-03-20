<?php

class Shop
{
    static public $MAX_CASH_BOX = 3;
    static public $personInShop = 0;
    static public $startShop = false;
    static public $workCashShop = [];

    public function startShop()
    {
        self::$startShop = true;
        for ($i = 0; $i < self::$MAX_CASH_BOX; $i++) {
            $newCashShop = new CashShop();
            array_push(Shop::$workCashShop, $newCashShop);
        }
    }
}

class CashShop extends Shop
{
    public $personInLine = 0;
    public $isWork = false;
    static public $MAX_PERSON = 5;
}

class Person
{
    public function visitShop()
    {
        Shop::$personInShop += 1;
    }

    public function searchCashShop()
    {
        for ($i = 0; $i < Shop::$MAX_CASH_BOX; $i++) {
            //search valid cash shop and add person on line valid cash shop
            if (Shop::$workCashShop[$i]->isWork) {

                if (Shop::$workCashShop[$i]->personInLine < CashShop::$MAX_PERSON - 1) {
                    Shop::$workCashShop[$i]->personInLine += 1;
                    var_dump(Shop::$workCashShop[$i]);
                    break;
                } else {
                    foreach (Shop::$workCashShop as $item) {

                        //проверить если в 3 кассах забита очередь, или добавить в след кассу
                        var_dump($item->isWork);
                    }
                }

            } else {
                Shop::$workCashShop[$i]->isWork = true;
                Shop::$workCashShop[$i]->personInLine += 1;
                var_dump(Shop::$workCashShop[$i]);
                break;
            }
        }
    }
}

$openShop = new Shop();
$openShop->startShop();

while (Shop::$startShop) {
    $newPerson = new Person();
    $newPerson->visitShop();
    $newPerson->searchCashShop();
    sleep(3);
}

//------------------------------
//        class CashShop extends Shop
//        {
//            static public $personInLine = [];
//            public $MAX_PERSON = 3;
//        }
//
//        class FactoryCashShop extends CashShop
//        {
//            public function addPersonInLine()
//            {
//                if (count(Shop::$workCashShop) === 0) {
//                    $newCashShop = new CashShop();
//                    CashShop::$personInLine = Shop::$personInShop;
//                    array(Shop::$workCashShop, $newCashShop);
//
//                } else if (count(Shop::$personInShop) <= 5) {
//                    array(CashShop::$personInLine, Shop::$personInShop);
//                } else{
//                    var_dump('Нужна новая касса');
//                }
//            }
//        }
//
//        class Person
//        {
//            public $id = null;
//            public $standingInLine = false;
//            public $shopTime = 3;
//        }
//
//        class FactoryPerson extends Person
//        {
//            public function setInterval()
//            {
//                while (Shop::$startShop) {
//                    $newPerson = new Person();
//                    //кидаю новых персонов которые в магазине
//                    $newPerson->standingInLine = !$newPerson->standingInLine;
//                    array_push(Shop::$personInShop, $newPerson);
//                    sleep(1);
//                    $newCashShop = new FactoryCashShop();
//                    $newCashShop->addPersonInline();
//                    array_push(Shop::$workCashShop, $newCashShop);
//                }
//            }
//        }
//
//
//        $setInterval = new FactoryPerson();
//        $setInterval->setInterval();