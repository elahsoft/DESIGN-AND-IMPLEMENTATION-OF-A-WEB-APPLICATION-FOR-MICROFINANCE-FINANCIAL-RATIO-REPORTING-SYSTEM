<?php 
require_once 'models/DebtToEquity.php';
class DebtToEquityTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    private $liabilities, $equity = 0;
    protected function _before()
    {
        $this->liabilities = 2000000;
        $this->equity = 4000000;
    }

    protected function _after()
    {
        $this->liabilities = 0;
        $this->equity = 0;
    }

    // tests
    public function testDebtToEquityFunction()
    {
        $debtToEquity = new DebtToEquity();
        $debt_to_equity = $debtToEquity->computeDebtToEquity($this->liabilities, $this->equity);
        $this->tester->assertEquals(0.5, $debt_to_equity, "The Function for Debt to Equity has an error");    
    }
}