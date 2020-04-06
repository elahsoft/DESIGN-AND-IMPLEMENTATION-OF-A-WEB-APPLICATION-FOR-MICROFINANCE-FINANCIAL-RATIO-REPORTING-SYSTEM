<?php 

class AdjustedReturnOnAssetsListCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function adjustedReturnOnAssetsTest(AcceptanceTester $I)
    {
        $I->amOnPage('/index.php?page=index');
        $I->fillField('username','elahsoft');
        $I->fillField('password','alvanaMFB2018*');
        $I->click('sub-signin');
        //test adjusted return on assets list
        $I->amOnPage('/admin/index.php?page=adjusted_return_on_assets_list');
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
        $I->seeLink('Adjusted Return On Assets List');
        $I->seeLink('Adjusted Return On Assets');
        $I->see('This Module assists you to document and prepare your Return on Assets. Return On Assets shows how efficiently the assets of the bank are used to generate profits relative to inflation. Net Operating Income and Average assets are adjusted by the inflation rate. Adjusted Return On Assets is Return On Assets adjusted by inflation. It should be positive.');
        $I->see('ADJUSTED NET OPERATING INCOME');
        $I->see('TAXES');
        $I->see('ADJUSTED AVERAGE ASSETS');
        $I->see('ADJUSTED RETURN ON ASSETS');
        $I->see('STATUS');
        $I->see('DATE');
        $I->see('PERIOD');
        //checks to ensure that on creation of any record that the status field is 1 which implies 'checked'
        $I->canSeeCheckboxIsChecked("#status1");
        $I->click('#status1');
    }
}
