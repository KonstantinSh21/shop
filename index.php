<?php
include_once 'shop.php';
include_once 'cashShop.php';
include_once 'person.php';

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