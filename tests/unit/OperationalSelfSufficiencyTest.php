<?php 
require_once 'models/OperationalSelfSufficiency.php'; 
class OperationalSelfSufficiencyTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    private $interest_earned_in_cash, $income_from_fees, $commissions,$interest_accrued_but_not_yet_earned = 0;
    private $interest_paid_in_cash, $fees_paid, $commissions_paid, $accrued_interest_but_not_yet_paid = 0;
    private $personnel_expense, $administrative_expense = 0;
    private  $loan_losses = 0;
    protected function _before()
    {
        $this->interest_earned_in_cash = 4000000;
        $this->income_from_fees = 10000000;
        $this->commissions = 20000000;
        $this->interest_accrued_but_not_yet_earned = 30000000;

        $this->interest_paid_in_cash = 100000;
        $this->fees_paid = 20000;
        $this->commissions_paid = 23000;
        $this->accrued_interest_but_not_yet_paid = 100000;

        $this->personnel_expense = 200000;
        $this->administrative_expense = 10000;

        $this->loan_losses = 500000;

    }

    protected function _after()
    {
        $this->interest_earned_in_cash = 0;
        $this->income_from_fees = 0;
        $this->commissions = 0;
        $this->interest_accrued_but_not_yet_earned = 0;

        $this->interest_paid_in_cash = 0;
        $this->fees_paid = 0;
        $this->commissions_paid = 0;
        $this->accrued_interest_but_not_yet_paid = 0;

        $this->personnel_expense = 0;
        $this->administrative_expense = 0;

        $this->loan_losses = 0;
    }

    // tests
    public function testFunctionsForComputations()
    {
        $operationalSelfSufficiency = new OperationalSelfSufficiency();
        $financial_revenue = $operationalSelfSufficiency->computeFinancialRevenue(
            $this->interest_earned_in_cash, $this->income_from_fees, $this->commissions,
            $this->interest_accrued_but_not_yet_earned );
        $this->tester->assertEquals(64000000, $financial_revenue, "The Function for Financial Revenue has an error");
        
        $financial_expense = $operationalSelfSufficiency->computeFinancialRevenue($this->interest_paid_in_cash,
        $this->fees_paid, $this->commissions_paid, $this->accrued_interest_but_not_yet_paid);
        $this->tester->assertEquals(243000, $financial_expense, "The Function for Financial Expense has an error");
        
        $operating_expense = $operationalSelfSufficiency->computeOperatingExpense($this->personnel_expense, 
        $this->administrative_expense);
        $this->tester->assertEquals(210000, $operating_expense, "The Function for Operating Expense has an error");

        $operational_self_sufficiency = $operationalSelfSufficiency->computeOperationalSelfSufficiency($financial_revenue, $financial_expense, $this->loan_losses, $operating_expense);
        $this->tester->assertEquals(67.1563483735572, $operational_self_sufficiency, "The Function for Operational Self Sufficiency has an error");
    }
}