<?php 
require_once 'models/LiquidityRatio.php';
class LiquidityRatioTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    private $cash,  $trade_investments,
    $demand_deposits, $short_term_time_deposits, $int_payable_funding_lia, $accounts_payable,
    $other_current_liabilities = 0;
    protected function _before()
    {
        $this->cash = 70000000;
        $this->trade_investments = 30000000;
        $this->demand_deposits = 2000000;
        $this->short_term_time_deposits = 40000000;
        $this->int_payable_funding_lia = 10000000;
        $this->accounts_payable = 12000000;
        $this->other_current_liabilities = 3000000;
    }

    protected function _after()
    {
        $this->cash = 0;
        $this->trade_investments = 0;
        $this->demand_deposits = 0;
        $this->short_term_time_deposits = 0;
        $this->int_payable_funding_lia = 0;
        $this->accounts_payable = 0;
        $this->other_current_liabilities = 0;
    }

    // tests
    public function testLiquidityRatioFunctions()
    {
        $liquidityRatio = new LiquidityRatio();

        $liquidity_ratio = $liquidityRatio->computeLiquidityRatio($this->cash,  $this->trade_investments, 
        $this->demand_deposits, $this->short_term_time_deposits, 
        $this->int_payable_funding_lia, $this->accounts_payable, $this->other_current_liabilities);

        $this->tester->assertEquals(1.4925373134328, $liquidity_ratio, "The Function for Liquidity Ratio has an error"); 
    }
}