<?php 

class FinancialSelfSufficiencyCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function financialSelfSufficiencyTest(AcceptanceTester $I)
    {
        //test Financial Self Sufficiency
        $I->amOnPage('/index.php?page=index');
        $I->fillField('username','elahsoft');
        $I->fillField('password','alvanaMFB2018*');
        $I->click('sub-signin');
        $I->amOnPage('/admin/index.php?page=financial_self_sufficiency');
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
        $I->see('This Module assists you to document and prepare your Financial Self Sufficiency Ratio. Financial Self Sufficiency Ratio helps you to determine whether or not the income of the MFB is able to cover the costs - both direct and indirect. The Bank is financially self sufficient if FSS is equal to or greater than 100%.');
        $I->seeLink('Financial Self Sufficiency');
        $I->seeLink('Financial Self Sufficiency List');
        $I->selectOption('period_id','2020-01-01 to 2020-03-31');
        $I->fillField('average_equity','60000000');
        $I->fillField('average_fixed_assets','50000000');
        $I->fillField('inflation_rate','0.2');
        $I->fillField('average_funding_liabilities','100000');
        $I->fillField('commercial_rate_for_funds','0.1');
        $I->fillField('interest_and_fees_expense','2000000');
        $I->fillField('gross_loan_losses','1000000');
        $I->fillField('lost_interest_deductions','500000');
        //$I->click('sub-financial-self-sufficiency');
        //$I->see('Operation successful!');
        $I->click('#financial_self_sufficiency_list');
        $I->see('Financial Self Sufficiency List');
    }
}
