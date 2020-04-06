<?php 

class PeriodListTestCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function periodListTest(AcceptanceTester $I)
    {
        $I->amOnPage('/index.php?page=index');
        $I->fillField('username','elahsoft');
        $I->fillField('password','alvanaMFB2018*');
        $I->click('sub-signin');
        //test period list
        $I->amOnPage('/admin/index.php?page=period_list');
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
        $I->see('Management Report Period List');
        $I->seeLink('Set Period');
        $I->seeLink('Period List');
        $I->see('ACTION');
        $I->see('STATUS');
        $I->see('DATE');
        $I->see('PERIOD');
        //checks to ensure that on creation of any record that the status field is 1 which implies 'checked'
        $I->canSeeCheckboxIsChecked("#status1");
        $I->click('#button1');
        $I->click('#status1');
    }
}
