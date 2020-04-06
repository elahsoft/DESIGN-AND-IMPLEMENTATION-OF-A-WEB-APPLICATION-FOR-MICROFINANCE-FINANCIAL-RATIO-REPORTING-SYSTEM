<?php 
use \Codeception\Util\Locator;
class SigninCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    // tests
    public function signinTest(AcceptanceTester $I)
    {
        $I->amOnPage('/index.php?page=index');
        //Test links that they are properly linked
        $I->see('Sustainability/Profitability');
        $I->click('#sustainability_profitability');
        $I->see('Sustainability & Profitability Ratios');
        $I->see('This Module assists you to document and prepare your sustainability or profitability ratios which include: ');
        $I->see('Sign In');
        $I->see('Copyright © 2018 Alvana Microfinance Bank Limited.');
        $I->see('Powered by Elahsoft Systems');

        $I->see('Asset/Liability Management');
        $I->click('#asset_liability_management');
        $I->see('Asset/Liability Management Ratios');
        $I->see('This Module assists you to document and prepare your asset and liability ratios which include:');
        $I->see('Sign In');
        $I->see('Copyright © 2018 Alvana Microfinance Bank Limited.');
        $I->see('Powered by Elahsoft Systems');

        $I->see('Portfolio Quality');
        $I->click('#portfolio_quality');
        $I->see('Portfolio Quality Ratios');
        $I->see('This Module assists you to document and prepare your portfolio quality ratios which include:');
        $I->see('Sign In');
        $I->see('Copyright © 2018 Alvana Microfinance Bank Limited.');
        $I->see('Powered by Elahsoft Systems');

        $I->see(' Efficiency Ratio');
        $I->click('#efficiency_ratio');
        $I->see('Efficiency Ratios');
        $I->see('This Module assists you to document and prepare your efficiency or productivity ratios which include:');
        $I->see('Sign In');
        $I->see('Copyright © 2018 Alvana Microfinance Bank Limited.');
        $I->see('Powered by Elahsoft Systems');


        $I->fillField('username','elahsoft');
        $I->fillField('password','alvanaMFB2018*');
        $I->click('sub-signin');
        $I->see('Welcome to your dashboard. We are currently in the quarter.');
        $I->see('Set Period');
        $I->see('Logout');
        $I->click('#Logout');
        $I->see('Home');
        $I->see('Copyright © 2018 Alvana Microfinance Bank Limited.');
        $I->see('Powered by Elahsoft Systems');

        //checks that Logout is seen when user is signed in but through the browser url field goes to the root index
        $I->amOnPage('/index.php?page=index');
        $I->see('Logout');
        
        
    }
}
