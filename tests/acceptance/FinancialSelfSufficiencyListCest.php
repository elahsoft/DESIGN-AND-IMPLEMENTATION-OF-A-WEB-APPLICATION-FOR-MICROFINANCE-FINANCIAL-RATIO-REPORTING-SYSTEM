<?php 

class FinancialSelfSufficiencyListCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function financialSelfSufficiencyTest(AcceptanceTester $I)
    {
        $I->amOnPage('/index.php?page=index');
        $I->fillField('username','elahsoft');
        $I->fillField('password','alvanaMFB2018*');
        $I->click('sub-signin');
        //test financial self sufficiency list
        $I->amOnPage('/admin/index.php?page=financial_self_sufficiency_list');
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
        $I->see('Financial Self Sufficiency List');
        $I->see('Financial Self Sufficiency');
        $I->see('This Module assists you to document and prepare your Financial Self Sufficiency Ratio. Financial Self Sufficiency Ratio helps you to determine whether or not the income of the MFB is able to cover the costs - both direct and indirect. The Bank is financially self sufficient if FSS is equal to or greater than 100%.');
        $I->see('FINANCIAL REVENUE');
        $I->see('ADJUSTED FINANCIAL EXPENSE');
        $I->see('NET LOAN LOSSES');
        $I->see('OPERATING EXPENSES');
        $I->see('FINANCIAL SELF SUFFICIENCY');
        $I->see('STATUS');
        $I->see('DATE');
        $I->see('PERIOD');
        //checks to ensure that on creation of any record that the status field is 1 which implies 'checked'
        $I->canSeeCheckboxIsChecked("#status1");
        $I->click('#status1');
    }
}
