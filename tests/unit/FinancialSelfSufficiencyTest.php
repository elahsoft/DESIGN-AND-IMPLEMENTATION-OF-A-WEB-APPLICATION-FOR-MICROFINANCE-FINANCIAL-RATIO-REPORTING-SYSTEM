<?php 
require_once 'models/FinancialSelfSufficiency.php';
class FinancialSelfSufficiencyTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    private $average_equity, $average_fixed_assets, $inflation_rate = 0;
    private $average_funding_liabilities, $commercial_rate_for_funds, $interest_and_fees_expense = 0;
    private $gross_loan_losses, $lost_interest_deductions = 0;
    
    protected function _before()
    {
        $this->average_equity = 200000;
        $this->average_fixed_assets = 30000;
        $this->inflation_rate = 0.2;

        $this->average_funding_liabilities = 500;
        $this->commercial_rate_for_funds = 200;
        $this->interest_and_fees_expense = 200;

        $this->gross_loan_losses = 100;
        $this->lost_interest_deductions = 20;

        $this->financial_revenue = 64000000;
        $this->operating_expense = 210000;
    }

    protected function _after()
    {
        $this->average_equity = 0;
        $this->average_fixed_assets = 0;
        $this->inflation_rate = 0;

        $this->average_funding_liabilities = 0;
        $this->commercial_rate_for_funds = 0;
        $this->interest_and_fees_expense = 0;

        $this->gross_loan_losses = 0;
        $this->lost_interest_deductions = 0;

        $this->financial_revenue = 0;
        $this->operating_expense = 0;
    }

    // tests
    public function testFinancialSelfSufficiencyFunctions()
    {
        $financialSelfSufficiency = new FinancialSelfSufficiency();

        $inflation_adjustment = $financialSelfSufficiency->computeInflationAdjustment($this->average_equity, 
        $this->average_fixed_assets, $this->inflation_rate);
        $this->tester->assertEquals(194000, $inflation_adjustment, "The Function for Inflation Adjustment has an error");
        
        $subsidized_cost_of_fund_adjustment = $financialSelfSufficiency->computeSubsidizedCostOfFundAdjustment(
            $this->average_funding_liabilities, $this->commercial_rate_for_funds, $this->interest_and_fees_expense);
        $this->tester->assertEquals(99800, $subsidized_cost_of_fund_adjustment, "The Function for Subsidized Cost of Fund Adjustment has an error");
        
        $adjusted_financial_expense = $financialSelfSufficiency->computeAdjustedFinancialExpense(
            $inflation_adjustment, $subsidized_cost_of_fund_adjustment);
            $this->tester->assertEquals(293800, $adjusted_financial_expense, "The Function for Adjusted Financial Expense has an error");
        
        $net_loan_losses = $financialSelfSufficiency->computeNetLoanLosses($this->gross_loan_losses, $this->lost_interest_deductions);
        $this->tester->assertEquals(80, $net_loan_losses, "The Function for Adjusted Financial Expense has an error");
        
        $financial_self_sufficiency = $financialSelfSufficiency->ComputeFinancialSelfSufficiency($this->financial_revenue, 
        $adjusted_financial_expense, $net_loan_losses, $this->operating_expense );
        $this->tester->assertEquals(127.01436850044, $financial_self_sufficiency, "The Function for Financial Self Sufficiency has an error");

    }
}