<?php 
require_once 'models/PortfolioToAsset.php';
class PortfolioToAssetTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    private $gross_loan_portfolio, $assets =  0;
    protected function _before()
    {
        $this->gross_loan_portfolio = 80000000;
        $this->assets = 30000000;
    }

    protected function _after()
    {
        $this->gross_loan_portfolio = 0;
        $this->assets = 0;
    }

    // tests
    public function testPortfolioToAssetFunction()
    {
        $portfolioToAsset = new PortfolioToAsset();
        $portfolio_to_asset = $portfolioToAsset->computePortfolioToAsset($this->gross_loan_portfolio, $this->assets);
        $this->tester->assertEquals(2.6666666666667, $portfolio_to_asset, "The Function for Portfolio to Asset has an error");
    }
}