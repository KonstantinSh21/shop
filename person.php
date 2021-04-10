<?php
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
                    Shop::addPersonInLine($i++, $amountRandomPerson);
                    break;
                    //Если много пользователей нужно добавить перенос пользователей
//                    if (Shop::$workCashShop[$i]->personInLine + CashShop::$MAX_PERSON - 1) {
//                        if (Shop::$workCashShop[$i]->personInLine > )
//                    } else {
//                        Shop::$workCashShop[$i]->personInLine += $amountRandomPerson;
//                    }
                } else {
                    //Добавить проверку на то что в магазине не закончились кассы
                    Shop::startCashShop($i);
                    Shop::addPersonInLine($i++, $amountRandomPerson);
                    break;
                }
            } else {
                Shop::startCashShop($i);
                Shop::addPersonInLine($i++, $amountRandomPerson);
                break;
            }
        }
    }
}