<?php 

class OperationalSelfSufficiencyListCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function operationalSelfSufficiencyListTest(AcceptanceTester $I)
    {
        $I->amOnPage('/index.php?page=index');
        $I->fillField('username','elahsoft');
        $I->fillField('password','alvanaMFB2018*');
        $I->click('sub-signin');
        //test operational self sufficiency list
        $I->amOnPage('/admin/index.php?page=operational_self_sufficiency_list');
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
        $I->seeLink('Operational Self Sufficiency List');
        $I->seeLink('Operational Self Sufficiency');
        $I->see('This Module assists you to document and prepare your Operational Self Sufficiency Ratio. Operational Self Sufficiency Ratio indicates whether revenues from operations are sufficient to cover all operating expenses. It is ok if the calculation gives a 100%.');
        $I->see('FINANCIAL REVENUE');
        $I->see('FINANCIAL EXPENSE');
        $I->see('LOAN LOSSES');
        $I->see('OPERATING EXPENSE');
        $I->see('OPERATIONAL SELF SUFFICIENCY');
        $I->see('STATUS');
        $I->see('DATE');
        $I->see('PERIOD');
        //checks to ensure that on creation of any record that the status field is 1 which implies 'checked'
        $I->canSeeCheckboxIsChecked("#status1");
        $I->click('#status1');
    }
}
