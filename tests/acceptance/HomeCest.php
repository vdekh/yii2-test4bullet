<?php

use yii\helpers\Url;

class HomeCest
{
    public function ensureThatHomePageWorks(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/index'));
        $I->see('Привет!');
        
        $I->seeLink('Вставить свои реквизиты');
        $I->click('Вставить свои реквизиты');
        $I->wait(2); // wait for page to be opened
        
        $I->see('Введите свои реквизиты');
    }
}
