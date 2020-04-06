<?php 

class Operational_Self_SufficiencyCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function operationalSelfSufficiencyTest(AcceptanceTester $I)
    {
        //test Operational Self Sufficiency
        $I->amOnPage('/index.php?page=index');
        $I->fillField('username','elahsoft');
        $I->fillField('password','alvanaMFB2018*');
        $I->click('sub-signin');
        $I->amOnPage('/admin/index.php?page=operational_self_sufficiency');
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
        $I->see('This Module assists you to document and prepare your Operational Self Sufficiency Ratio. Operational Self Sufficiency Ratio indicates whether revenues from operations are sufficient to cover all operating expenses. It is ok if the calculation gives a 100%.');
        $I->seeLink('Operational Self Sufficiency');
        $I->seeLink('Operational Self Sufficiency List');
        $I->selectOption('period_id','2020-01-01 to 2020-03-31');
        $I->fillField('interest_earned_in_cash','60000000');
        $I->fillField('income_from_fees','50000000');
        $I->fillField('commissions','130000000');
        $I->fillField('interest_accrued_but_not_yet_earned','7000000');
        $I->fillField('interest_paid_in_cash','3000000');
        $I->fillField('fees_paid','2000000');
        $I->fillField('commissions_paid','1000000');
        $I->fillField('accrued_interest_but_not_yet_paid','500000');
        $I->fillField('loan_losses_expense','3000000');
        $I->fillField('personnel_expense','2000000');
        $I->fillField('administrative_expense','500000');
        //$I->click('sub-operational-self-sufficiency');
        //$I->see('Operation successful!');
        $I->click('#operational_self_sufficiency_list');
        $I->see('Operational Self Sufficiency List');
    }
}
