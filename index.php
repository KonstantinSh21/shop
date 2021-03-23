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
}

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

class Person
{
    public function visitShop($amountRandomPerson)
    {
        Shop::$personInShop += $amountRandomPerson;
    }

    static public function searchCashShop($amountRandomPerson)
    {
        for ($i = 0; $i < Shop::$MAX_CASH_BOX; $i++) {
            if (Shop::$workCashShop[$i]->personInLine > CashShop::$MAX_PERSON - 1){
                continue;
            }

            if (Shop::$workCashShop[$i]->isWork) {
                if (Shop::$workCashShop[$i]->personInLine < CashShop::$MAX_PERSON - 1) {
                    Shop::$workCashShop[$i]->personInLine += $amountRandomPerson;
                    break;
                    //Если много пользователей нужно добавить перенос пользователей
//                    if (Shop::$workCashShop[$i]->personInLine + CashShop::$MAX_PERSON - 1) {
//                        if (Shop::$workCashShop[$i]->personInLine > )
//                    } else {
//                        Shop::$workCashShop[$i]->personInLine += $amountRandomPerson;
//                    }
                } else {
                    //Добавить проверку на то что в магазине не закончились кассы
                    Shop::$workCashShop[$i++]->isWork = true;
                    Shop::$workCashShop[$i++]->personInLine += $amountRandomPerson;
                }
            } else {
                Shop::$workCashShop[$i]->isWork = true;
                Shop::$workCashShop[$i]->personInLine += $amountRandomPerson;
                break;
            }
        }
    }
}

$openShop = new Shop();
$openShop->startShop();

while (Shop::$startShop) {
    print_r("///");
    Shop::createRandomPerson();
    for ($i = 0; $i < Shop::$MAX_CASH_BOX; $i++) {
        print(Shop::$workCashShop[$i]->personInLine . " из " . CashShop::$MAX_PERSON . "     ");
    }
    sleep(5);
    CashShop::servedPerson();
}