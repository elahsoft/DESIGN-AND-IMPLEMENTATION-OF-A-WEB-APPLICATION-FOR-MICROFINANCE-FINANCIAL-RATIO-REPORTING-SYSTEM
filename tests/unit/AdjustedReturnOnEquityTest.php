<?php 
require_once 'models/AdjustedReturnOnEquity.php';
class AdjustedReturnOnEquityTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    private $adjusted_net_operating_income, $taxes, $adjusted_average_equity = 0;
    protected function _before()
    {
        $this->adjusted_net_operating_income = 70000000;
        $this->taxes =2000000;
        $this->adjusted_average_equity = 1000000;
    }

    protected function _after()
    {
        $this->adjusted_net_operating_income = 0;
        $this->taxes = 0;
        $this->adjusted_average_equity = 0;
    }

    // tests
    public function testAdjustedReturnOnEquityFunction() {
        $adjustedReturnOnEquity = new AdjustedReturnOnEquity();
        $adjusted_return_on_equity = $adjustedReturnOnEquity->computeAdjustedReturnOnEquity($this->adjusted_net_operating_income, 
        $this->taxes, $this->adjusted_average_equity);
        $this->tester->assertEquals(68, $adjusted_return_on_equity, "The Function for Adjusted Return on Equity has an error");

    }
}