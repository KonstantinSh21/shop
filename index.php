<?php

class Shop
{
    protected $MAX_CASH_BOX = 5;
    static public $personInShop = 0;
    static public $startShop = false;
    static public $workCashShop = 0;

    public function startOrCloseShop()
    {
        self::$startShop = !self::$startShop;
    }
}

class CashShop extends Shop
{
    static public $personInLine = 0;
    public $MAX_PERSON = 3;

    public function openCashShop()
    {
        Shop::$workCashShop += 1;
    }
}

class Person
{
    public function visitShop()
    {
        Shop::$personInShop += 1;
    }

    public function searchCashShop()
    {
        if (CashShop::$workCashShop === 0) {
            $newCashShop = new CashShop;
            $newCashShop->openCashShop();
        } else {
            $newCashShop = new CashShop;
            if (CashShop::$personInLine <= $newCashShop->MAX_PERSON) {

            }
        }
    }

    public function getInLine () {

    }

}
//------------------------------
    class CashShop extends Shop
    {
        static public $personInLine = [];
        public $MAX_PERSON = 3;
    }

    class FactoryCashShop extends CashShop
    {
        public function addPersonInLine()
        {
            if (count(Shop::$workCashShop) === 0) {
                $newCashShop = new CashShop();
                CashShop::$personInLine = Shop::$personInShop;
                array(Shop::$workCashShop, $newCashShop);

            } else if (count(Shop::$personInShop) <= 5) {
                array(CashShop::$personInLine, Shop::$personInShop);
            } else{
                var_dump('Нужна новая касса');
            }
        }
    }

    class Person
    {
        public $id = null;
        public $standingInLine = false;
        public $shopTime = 3;
    }

    class FactoryPerson extends Person
    {
        public function setInterval()
        {
            while (Shop::$startShop) {
                $newPerson = new Person();
                //кидаю новых персонов которые в магазине
                $newPerson->standingInLine = !$newPerson->standingInLine;
                array_push(Shop::$personInShop, $newPerson);
                sleep(1);
                $newCashShop = new FactoryCashShop();
                $newCashShop->addPersonInline();
                array_push(Shop::$workCashShop, $newCashShop);
            }
        }
    }


    $setInterval = new FactoryPerson();
    $setInterval->setInterval();