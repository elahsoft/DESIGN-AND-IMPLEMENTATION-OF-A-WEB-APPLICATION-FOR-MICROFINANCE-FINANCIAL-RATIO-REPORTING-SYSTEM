<?php 

class AdjustedReturnOnAssetsCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function adjustedReturnOnAssetsTest(AcceptanceTester $I)
    {
        //test Adjusted Return On Assets
        $I->wantTo('Test Adjusted Return On Assets Page');
        $I->amOnPage('/index.php?page=index');
        $I->fillField('username','elahsoft');
        $I->fillField('password','alvanaMFB2018*');
        $I->click('sub-signin');
        $I->amOnPage('/admin/index.php?page=adjusted_return_on_assets');
        //test header
        $I->wantTo('Test the header links on the page');
        $I->see('ALMFB LTD. FINANCIAL RATIO SUITE');
        $I->seeLink('Home');
        $I->seeLink('Sustainability & Profitability');
        $I->seeLink('Asset & Liability Management');
        $I->seeLink('Portfolio Quality');
        $I->seeLink('Efficiency Ratio');
        $I->seeLink('Generate Report');
        $I->see('Logout');
        //test footer
        $I->wantTo('Test that the footer is present');
        $I->see('Copyright © 2018 Alvana Microfinance Bank Limited.');
        $I->see('Powered by Elahsoft Systems');
        //test body
        $I->see('This Module assists you to document and prepare your Return on Assets. Return On Assets shows how efficiently the assets of the bank are used to generate profits relative to inflation. Net Operating Income and Average assets are adjusted by the inflation rate. Adjusted Return On Assets is Return On Assets adjusted by inflation. It should be positive.');
        $I->seeLink('Adjusted Return On Assets');
        $I->seeLink('Adjusted Return On Assets List');
        $I->selectOption('period_id','2020-01-01 to 2020-03-31');
        $I->fillField('adjusted_net_operating_income','60000000');
        $I->fillField('taxes','50000');
        $I->fillField('adjusted_average_assets','30000000');
        //$I->click('sub-adjusted-return-assets');
        //$I->see('Operation successful!');
        $I->click('#adjusted_return_on_assets_list');
        $I->see('Adjusted Return On Assets List');
    }
}
