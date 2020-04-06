<?php 
require_once 'models/YieldOnGrossPortfolio.php';
class YieldOnGrossPortfolioTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    private $cash_from_gross_loan_portfolio, $average_gross_loan_portfolio = 0;
    protected function _before()
    {
        $this->cash_from_gross_loan_portfolio = 20000000;
        $this->average_gross_loan_portfolio = 15000000;
    }

    protected function _after()
    {
        $this->cash_from_gross_loan_portfolio = 0;
        $this->average_gross_loan_portfolio = 0;
    }

    // tests
    public function testYieldOnGrossPortfolio()
    {
        $yieldOnGrossPortfolio = new YieldOnGrossPortfolio();
        $yield_on_gross_portfolio = $yieldOnGrossPortfolio->computeYieldOnGrossPortfolio($this->cash_from_gross_loan_portfolio, 
        $this->average_gross_loan_portfolio);
        $this->tester->assertEquals(1.3333333333333, $yield_on_gross_portfolio, "The Function for Yield on Gross Portfolio has an error");
    }
}