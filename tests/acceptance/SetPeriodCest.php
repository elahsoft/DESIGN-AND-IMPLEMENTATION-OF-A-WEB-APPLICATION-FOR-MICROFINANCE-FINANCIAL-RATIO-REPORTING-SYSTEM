<?php 

class SetPeriodCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function setPeriodTest(AcceptanceTester $I)
    {
        //test set period
        $I->amOnPage('/index.php?page=index');
        $I->fillField('username','elahsoft');
        $I->fillField('password','alvanaMFB2018*');
        $I->click('sub-signin');
        $I->amOnPage('/admin/index.php?page=set_period');
        //test header
        $I->see('ALMFB LTD. FINANCIAL RATIO SUITE');
        $I->seeLink('Home');
        $I->seeLink('Sustainability & Profitability');
        $I->seeLink('Asset & Liability Management');
        $I->seeLink('Portfolio Quality');
        $I->seeLink('Efficiency Ratio');
        $I->seeLink('Generate Report');
        $I->seeLink('Logout');
        //test footer
        $I->see('Copyright © 2018 Alvana Microfinance Bank Limited.');
        $I->see('Powered by Elahsoft Systems');
        //test body
        $I->see('This Module assists you to manage the period for which the management financial ratios are computed for. ');
        $I->seeLink('Set Period');
        $I->seeLink('Period List');
        $I->fillField('from','01/01/2020');
        $I->fillField('to','31/01/2020');
        //$I->click('sub-set_period');
        //$I->see('Operation successful!');
        $I->click('#period_list');
        $I->see('Management Report Period List');


    }
}
