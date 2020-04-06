<?php 

class DashboardCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function dashboardTest(AcceptanceTester $I)
    {
        $I->amOnPage('/index.php?page=index');
        $I->fillField('username','elahsoft');
        $I->fillField('password','alvanaMFB2018*');
        $I->click('sub-signin');
        $I->see('Set Period');
        $I->see('Sustainability & Profitability');
        $I->see('Asset & Liability Management');
        $I->see('Portfolio Quality');
        $I->see('Efficiency Ratio');
        $I->see('Generate Report');
        $I->see('Logout');
        //makes the url to bear admin while redirecting to index.
        $I->amOnPage('/admin/index.php?page=dashboard');
        $I->click('#set_period');
        $I->see('Set Management Report Period');
        $I->seeLink('Set Period');
        $I->seeLink('Period List');

        $I->click('#sustainability_profitability');
        $I->see('Sustainability Ratios');
        $I->seeLink('Operational Self Sufficiency');
        $I->seeLink('Financial Self Sufficiency');
        $I->seeLink('Return On Assets');
        $I->seeLink('Return On Equity');
        $I->see('Copyright © 2018 Alvana Microfinance Bank Limited.');
        $I->see('Powered by Elahsoft Systems');

        $I->click('#asset_liability_management');
        $I->see('Asset & Liability Management Ratios');
        $I->seeLink('Yield on Gross Portfolio');
        $I->seeLink('Cost of Funds');
        $I->seeLink('Debt to Equity');
        $I->seeLink('Liquidity Ratio');
        $I->see('Copyright © 2018 Alvana Microfinance Bank Limited.');
        $I->see('Powered by Elahsoft Systems');

        $I->click('#portfolio_quality');
        $I->see('Portfolio Quality Ratio');
        $I->seeLink('Portfolio at Risk');
        $I->seeLink('Write-off Ratio');
        $I->see('Copyright © 2018 Alvana Microfinance Bank Limited.');
        $I->see('Powered by Elahsoft Systems');

        $I->click('#efficiency_ratio');
        $I->see('Efficiency Ratios');
        $I->seeLink('Operating Expense Ratio');
        $I->seeLink('Cost per Client');
        $I->see('Copyright © 2018 Alvana Microfinance Bank Limited.');
        $I->see('Powered by Elahsoft Systems');

        $I->click('#generate_report');
        $I->seeLink('Generate Report');
        $I->see('Copyright © 2018 Alvana Microfinance Bank Limited.');
        $I->see('Powered by Elahsoft Systems');

        $I->click('#Logout');
        $I->seeLink('Home');
        $I->see('Copyright © 2018 Alvana Microfinance Bank Limited.');
        $I->see('Powered by Elahsoft Systems');




    }
}
