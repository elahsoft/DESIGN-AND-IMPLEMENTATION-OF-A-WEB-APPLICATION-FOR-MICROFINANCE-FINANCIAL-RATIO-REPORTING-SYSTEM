<?php 
require_once 'models/CostOfFunds.php';
class CostOfFundsTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    private $financial_expense_on_funding_liabilities, $average_deposit, $average_borrowings = 0;
    protected function _before()
    {
        $this->financial_expense_on_funding_liabilities = 4000000;
        $this->average_deposit = 10000000;
        $this->average_borrowings = 5000000;
    }

    protected function _after()
    {
        $this->financial_expense_on_funding_liabilities = 0;
        $this->average_deposit = 0;
        $this->average_borrowings = 0;
    }

    // tests
    public function testCostOfFundsFunction()
    {
        $costOfFunds = new CostOfFunds();
        $cost_of_funds = $costOfFunds->computeCostOfFunds($this->financial_expense_on_funding_liabilities, 
        $this->average_deposit, $this->average_borrowings);
        $this->tester->assertEquals(0.26666666666667, $cost_of_funds, "The Function for Cost of Funds has an error"); 
    }
}