<?php
require_once '../fpdf181/fpdf.php';
require_once '../models/FinancialSelfSufficiency.php';
require_once '../models/OperationalSelfSufficiency.php';
require_once '../models/AdjustedReturnOnAssets.php';
require_once '../models/AdjustedReturnOnEquity.php';
require_once '../models/YieldOnGrossPortfolio.php';
require_once '../models/PortfolioToAsset.php';
require_once '../models/CostOfFunds.php';
require_once '../models/DebtToEquity.php';
require_once '../models/LiquidityRatio.php';
require_once '../models/PortfolioAtRisk.php';
require_once '../models/WriteOffRatio.php';
require_once '../models/CostPerClient.php';
require_once '../models/ManagementReportPeriod.php';

class FinancialRatioGenerator extends fpdf {
    //OSS Variables
    private $financial_revenue, $financial_expense, $loan_losses, $operating_expense, $operational_self_sufficiency = 0;
    //FSS Variables
    private $adjusted_financial_expense, $net_loan_losses,$inflation_adjustment,$subsidized_cost_of_fund_adjustment,
        $financial_self_sufficiency = 0;
    //AROA Variables
    private $adjusted_net_operating_income, $taxes, $adjusted_average_assets, $adjusted_return_on_assets = 0;
    //AROE Variables
    private $adjusted_average_equity, $adjusted_return_on_equity = 0;
    //Yield on Gross Loan Portfolio Variables
    private $cash_from_gross_loan_portfolio, $average_gross_loan_portfolio, $yield_on_gross_portfolio = 0;
    //Portfolio To Assets Variables
    private $gross_loan_portfolio, $assets, $portfolio_to_asset = 0;
    //Cost of Funds Variables
    private $financial_expense_on_funding_liabilities, $average_deposit, $average_borrowings, $cost_of_funds = 0;
    //Debt to Equity Variables
    private $liabilities, $equity, $debt_to_equity = 0;
    //Liquidity Ratio Variables
    private $liquidity_ratio, $cash, $trade_investments, $demand_deposits, $short_term_time_deposits, $int_payable_funding_lia, $accounts_payable, $other_current_liabilities = 0;
    // Portfolio at Risk Variable
    private $principal_outstanding_on_all_past_due_loans, $renegotiated_loans, $portfolio_at_risk = 0;
    //Write-Off Ratio Variables
    private $write_off_ratio, $value_of_loans_written_off = 0;
    //Operating Expense Ratio Variables
    private $operating_expense_ratio = 0;
    //Cost Per Client Variables
    private $cost_per_client_ratio, $average_number_of_clients = 0;

    public $period;
    private $remark = "";
    public function __construct() {
        parent::__construct();
        $this->SetAutoPageBreak(true);
    }
    function pageBorder() {
        $this->SetDrawColor(34,177,76);
        $this->Rect(4,4, 200,290);
    }
    function Header() {     
        $this->pageBorder();
    }
    function SetPageHeading() {
        $this->SetFont('Arial','B',24);
        $this->Cell(190,10,'ALVANA MICROFINANCE BANK LIMITED', 0, 1,"C");
        $this->Image("../images/logo square.png",95, 18, 15, 15, "PNG");
        $this->SetFont('Arial','I',10);
        $this->Cell(190,30,'Along  Orlu Road, Alvan Ikoku Federal College Of Education', 0, 1,"C");
        $this->SetFont('Arial','BU',15);
        $this->Cell(190,0,'FINANCIAL RATIO REPORT FOR THE MONTH OF '.$this->period, 0, 1,"C");
    }
    function SetDocumentInformation() {
        $this->SetCreator("Alvana Microfinance Bank Ltd.");
        $this->SetAuthor("Alvana Microfinance Bank Ltd.");
        $this->SetKeywords("Financial Self Sufficiency, Operational Self Sufficiency, Return On Assets,
            Return On Equity, Sustainability and Profitability, Yield on Gross Portfolio, Portfolio to Asset,
            Cost of Funds, Debt to Equity, Liquidity Ratio, Asset and Liability Management Ratios,
            Portfolio Quality Ratios, Portfolio at Risk, Write-off Ratio, Efficiency Ratio,
            Operating Expense Ratio, Cost per Client");
        $this->SetSubject("Financial Ratio Report");
        $this->SetTitle("Financial Ratio Report");
    }
    function ComputeOperationalSelfSufficiency($period_id) {
        $operationalSelfSufficiency = new OperationalSelfSufficiency();
        $wherDataArray = array($period_id, 1);
        $wherFieldArray = array("period_id", "status");
        $logic = "AND";
        $operationalSelfSufficiencyRecord = $operationalSelfSufficiency->select($wherDataArray, 
            $wherFieldArray, $logic);
        
        //Compute Quantities
        if (@$operationalSelfSufficiencyRecord[0]) {
            $this->loan_losses = $operationalSelfSufficiencyRecord[0]['loan_losses_expense'];

            $this->financial_revenue = $operationalSelfSufficiency->computeFinancialRevenue($operationalSelfSufficiencyRecord[0]['interest_earned_in_cash'],
            $operationalSelfSufficiencyRecord[0]['income_from_fees'], $operationalSelfSufficiencyRecord[0]['commissions'],
            $operationalSelfSufficiencyRecord[0]['interest_accrued_but_not_yet_earned']);
            
            $this->financial_expense = $operationalSelfSufficiency->computeFinancialExpense(
                $operationalSelfSufficiencyRecord[0]['interest_paid_in_cash'], 
                                 $operationalSelfSufficiencyRecord[0]['fees_paid'],
                                    $operationalSelfSufficiencyRecord[0]['commissions_paid'],
                                    $operationalSelfSufficiencyRecord[0]['accrued_interest_but_not_yet_paid']);

            $this->operating_expense = $operationalSelfSufficiency->computeOperatingExpense(
                $operationalSelfSufficiencyRecord[0]['personnel_expense'],
                                        $operationalSelfSufficiencyRecord[0]['administrative_expense']);

            $this->operational_self_sufficiency = $operationalSelfSufficiency->computeOperationalSelfSufficiency(
                $this->financial_revenue, $this->financial_expense, $this->loan_losses, $this->operating_expense);
        } 
        
    }
    function SetOperationalSelfSufficiency($period_id) {
        $this->ComputeOperationalSelfSufficiency($period_id);
        //display the computed ratio and it's corresponding values
        $this->SetFont('Arial','',12);
        $this->Cell(10,10,'a.', 0, 0,"J");
        $this->SetFont('Arial','',12);
        $this->Cell(10,10,'Operational Self Sufficiency (OSS) = ', 0, 1,"J");

        $this->SetFont('Arial','U',12);
        //spaces are to create a division effect
        $this->Cell(150,5,'                             Financial Revenue                             ', 0, 1,"C");

        $this->SetFont('Arial','',12);
        $this->Cell(150,10,'(Financial Expense + Loan Losses + Operating Expenses)', 0, 1,"C");

        $this->Cell(150,5,'=', 0, 1,"C");

        $this->SetFont('Arial','U',12);
        $this->Cell(150,10,"           ".$this->financial_revenue."             ", 0, 1,"C");
        $this->SetFont('Arial','',12);
        $this->Cell(150,5,"(".$this->financial_expense."+".$this->loan_losses.
        "+".$this->operating_expense.")", 0, 1,"C");
        $this->Cell(150,5,'=', 0, 1,"C");
        $this->SetFont('Arial','U',12);
        $this->Cell(150,10,"           ".$this->financial_revenue."             ", 0, 1,"C");
        $this->SetFont('Arial','',12);
        $this->Cell(150, 5, $this->financial_expense + $this->loan_losses+
        $this->operating_expense, 0, 1,"C");
        $this->Cell(150,5,'=', 0, 1,"C");
        $this->SetFont('Arial','',12);
        $denominator = ($this->financial_expense + $this->loan_losses+
        $this->operating_expense);
        if ($denominator != 0)
            $this->operational_self_sufficiency = $this->financial_revenue/$denominator;
        else
            $this->operational_self_sufficiency = 0;

        if ($this->operational_self_sufficiency < 100) {
            $this->SetTextColor(237,28,36);
            $this->remark = "The Bank is not operationally self sufficient, try getting your operational self sufficiency to 100% or above 100%.";
        }
        else {
            $this->SetTextColor(34,177,76);
            $this->remark = "The Bank is operationally self sufficient, try keeping your operational self sufficiency to 100% or above 100%.";
        }
        $this->Cell(150, 5,$this->operational_self_sufficiency , 0, 1,"C");
        $this->Write(6, "NOTE: ".$this->remark);
    }
    
    function ComputeFinancialSelfSufficiency($period_id) {
        $financialSelfSufficiency = new FinancialSelfSufficiency();
        $wherDataArray = array($period_id, 1);
        $wherFieldArray = array("period_id", "status");
        $logic = "AND";
        $financialSelfSufficiencyRecord = $financialSelfSufficiency->select($wherDataArray, 
            $wherFieldArray, $logic);
        
        //Compute Quantities
        if (@$financialSelfSufficiencyRecord[0]) {
            $this->inflation_adjustment = $financialSelfSufficiency->computeInflationAdjustment(
                $financialSelfSufficiencyRecord[0]['average_equity'],
                $financialSelfSufficiencyRecord[0]['average_fixed_assets'],
                $financialSelfSufficiencyRecord[0]['inflation_rate']);

            $this->subsidized_cost_of_fund_adjustment = $financialSelfSufficiency->computeSubsidizedCostOfFundAdjustment(
                $financialSelfSufficiencyRecord[0]['average_funding_liabilities'], $financialSelfSufficiencyRecord[0]['commercial_rate_for_funds'],
                $financialSelfSufficiencyRecord[0]['interest_and_fees_expense']);

            $this->adjusted_financial_expense = $financialSelfSufficiency->computeAdjustedFinancialExpense(
                $this->inflation_adjustment, $this->subsidized_cost_of_fund_adjustment);

            $this->net_loan_losses = $financialSelfSufficiency->computeNetLoanLosses($financialSelfSufficiencyRecord[0]['gross_loan_losses'],
            $financialSelfSufficiencyRecord[0]['lost_interest_deductions'] );
            
            $this->financial_self_sufficiency = $financialSelfSufficiency->ComputeFinancialSelfSufficiency(
                $this->financial_revenue, $this->adjusted_financial_expense, $this->net_loan_losses, 
                $this->operating_expense );
        }
    }
    function SetFinancialSelfSufficiency($period_id) {
        $this->ComputeFinancialSelfSufficiency($period_id);

        $this->SetTextColor(0,0,0);

        //display the computed ratio and it's corresponding values
        $this->SetFont('Arial','',12);
        $this->ln();
        $this->Cell(5,10,'b.', 0, 0,"J");
        $this->SetFont('Arial','',12);
        $this->Cell(5,10,'Financial Self Sufficiency (FSS) = ', 0, 1,"J");

        $this->SetFont('Arial','U',12);
        //spaces are to create a division effect
        $this->Cell(150,5,'                             Financial Revenue                             ', 0, 1,"C");

        $this->SetFont('Arial','',12);
        $this->Cell(150,5,'(Adjusted Financial Expense + Net Loan Losses + Operating Expenses)', 0, 1,"C");

        $this->Cell(150,5,'=', 0, 1,"C");

        $this->SetFont('Arial','U',12);
        $this->Cell(150,5,"           ".$this->financial_revenue."             ", 0, 1,"C");
        $this->SetFont('Arial','',12);
        $this->Cell(150,5,"(".$this->adjusted_financial_expense."+".$this->net_loan_losses."+".
        $this->operating_expense.")", 0, 1,"C");
        $this->Cell(150,5,'=', 0, 1,"C");
        $this->SetFont('Arial','U',12);
        $this->Cell(150,5,"           ".$this->financial_revenue."             ", 0, 1,"C");
        $this->SetFont('Arial','',12);
        $this->Cell(150, 5, $this->adjusted_financial_expense + $this->net_loan_losses +
        $this->operating_expense, 0, 1,"C");
        $this->Cell(150,5,'=', 0, 1,"C");
        $this->SetFont('Arial','',12);

        if ($this->financial_self_sufficiency < 100) {
            $this->SetTextColor(237,28,36);
            $this->remark = "The Bank is not financially self sufficient, try getting your financial self sufficiency to 100% or above 100%.";
        }
        else {
            $this->SetTextColor(34,177,76);
            $this->remark = "The Bank is financially self sufficient, try keeping your financial self sufficiency at 100% or above 100%. Also note that an increasing FSS is positive.";
        }
        $this->Cell(150, 5,$this->financial_self_sufficiency , 0, 1,"C");
        $this->Write(6, "NOTE: ".$this->remark);
    }
    function ComputeAdjustedReturnOnAssets($period_id) {
        $adjustedReturnOnAssets = new AdjustedReturnOnAssets();
        $wherDataArray = array($period_id, 1);
        $wherFieldArray = array("period_id", "status");
        $logic = "AND";
        $adjustedReturnOnAssetsRecord = $adjustedReturnOnAssets->select($wherDataArray, 
            $wherFieldArray, $logic);
        
        //Compute Quantities
        if (@$adjustedReturnOnAssetsRecord[0]) {
            $this->adjusted_net_operating_income = $adjustedReturnOnAssetsRecord[0]['adjusted_net_operating_income'];
            $this->taxes = $adjustedReturnOnAssetsRecord[0]['taxes'];
            $this->adjusted_average_assets = $adjustedReturnOnAssetsRecord[0]['adjusted_average_assets'];
            if ($this->adjusted_average_assets)
                $this->adjusted_return_on_assets = $adjustedReturnOnAssets->computeAdjustedReturnOnAssets(
                    $this->adjusted_net_operating_income, $this->taxes, $this->adjusted_average_assets);
            else 
                $this->adjusted_return_on_assets = 0;
        }
    }
    function SetAdjustedReturnOnAssets($period_id) {
        $this->ComputeAdjustedReturnOnAssets($period_id);
        $this->SetTextColor(0,0,0);

        //display the computed ratio and it's corresponding values
        $this->SetFont('Arial','',12);
        $this->ln();
        $this->Cell(10,20,'c.', 0, 0,"J");
        $this->SetFont('Arial','',12);
        $this->Cell(10,20,'Adjusted Return On Assets (AROA) = ', 0, 1,"J");

        $this->SetFont('Arial','U',12);
        //spaces are to create a division effect
        $this->Cell(150,5,'    Adjusted Net Operating Income - Taxes    ', 0, 1,"C");

        $this->SetFont('Arial','',12);
        $this->Cell(150,10,'Adjusted Average Assets', 0, 1,"C");

        $this->Cell(150,5,'=', 0, 1,"C");

        $this->SetFont('Arial','U',12);
        $this->Cell(150,10,$this->adjusted_net_operating_income." - ".$this->taxes, 0, 1,"C");
        $this->SetFont('Arial','',12);
        $this->Cell(150,5, $this->adjusted_average_assets, 0, 1,"C");
        $this->Cell(150,5,'=', 0, 1,"C");
        $this->SetFont('Arial','U',12);
        $this->Cell(150,10,($this->adjusted_net_operating_income - $this->taxes), 0, 1,"C");
        $this->SetFont('Arial','',12);
        $this->Cell(150, 5, $this->adjusted_average_assets, 0, 1,"C");
        $this->Cell(150,5,'=', 0, 1,"C");
        $this->SetFont('Arial','',12);
        $this->Cell(150, 5,$this->adjusted_return_on_assets , 0, 1,"C");
        $this->SetTextColor(34,177,76);
        $this->remark = "An increasing AROA is positive.";
        $this->Write(6, "NOTE: ".$this->remark);
       
    }
    function ComputeAdjustedReturnOnEquity($period_id) {
        $adjustedReturnOnEquity = new AdjustedReturnOnEquity();
        $wherDataArray = array($period_id, 1);
        $wherFieldArray = array("period_id", "status");
        $logic = "AND";
        $adjustedReturnOnEquityRecord = $adjustedReturnOnEquity->select($wherDataArray, 
            $wherFieldArray, $logic);
        
        //Compute Quantities
        if (@$adjustedReturnOnEquityRecord[0] && $this->adjusted_net_operating_income && $this->taxes) {
            $this->adjusted_average_equity = $adjustedReturnOnEquityRecord[0]['adjusted_average_equity'];
                $this->adjusted_return_on_equity = $adjustedReturnOnEquity->computeAdjustedReturnOnEquity($this->adjusted_net_operating_income, 
                $this->taxes, $this->adjusted_average_equity);
        }
    }
    function SetAdjustedReturnOnEquity($period_id) {
        $this->ComputeAdjustedReturnOnEquity($period_id);
        $this->SetTextColor(0,0,0);

        //display the computed ratio and it's corresponding values
        $this->SetFont('Arial','',12);
        $this->ln();
        $this->Cell(10,20,'d.', 0, 0,"J");
        $this->SetFont('Arial','',12);
        $this->Cell(10,20,'Adjusted Return On Equity (AROE) = ', 0, 1,"J");

        $this->SetFont('Arial','U',12);
        //spaces are to create a division effect
        $this->Cell(150,5,'     Adjusted Net Operating Income - Taxes     ', 0, 1,"C");

        $this->SetFont('Arial','',12);
        $this->Cell(150,10,'Adjusted Average Equity', 0, 1,"C");

        $this->Cell(150,5,'=', 0, 1,"C");

        $this->SetFont('Arial','U',12);
        $this->Cell(150,10,$this->adjusted_net_operating_income." - ".$this->taxes, 0, 1,"C");
        $this->SetFont('Arial','',12);
        $this->Cell(150,5, $this->adjusted_average_equity, 0, 1,"C");
        $this->Cell(150,5,'=', 0, 1,"C");
        $this->SetFont('Arial','U',12);
        $this->Cell(150,10,($this->adjusted_net_operating_income - $this->taxes), 0, 1,"C");
        $this->SetFont('Arial','',12);
        $this->Cell(150, 5, $this->adjusted_average_equity, 0, 1,"C");
        $this->Cell(150,5,'=', 0, 1,"C");
        $this->SetFont('Arial','',12);
        $this->Cell(150, 5,$this->adjusted_return_on_equity , 0, 1,"C");
        $this->SetTextColor(34,177,76);
        $this->remark = "An increasing AROE is positive.";
        $this->Write(6, "NOTE: ".$this->remark);
       
    }
    function ComputeYieldOnGrossLoanPortfolio($period_id) {
        $yieldOnGrossPortfolio = new YieldOnGrossPortfolio();
        $wherDataArray = array($period_id, 1);
        $wherFieldArray = array("period_id", "status");
        $logic = "AND";
        $yieldOnGrossPortfolioRecord = $yieldOnGrossPortfolio->select($wherDataArray, 
            $wherFieldArray, $logic);
        
        //Compute Quantities
        if (@$yieldOnGrossPortfolioRecord[0]) {
            $this->cash_from_gross_loan_portfolio = $yieldOnGrossPortfolioRecord[0]['cash_from_gross_loan_portfolio'];
            $this->average_gross_loan_portfolio = $yieldOnGrossPortfolioRecord[0]['average_gross_loan_portfolio'];
            
            $this->yield_on_gross_portfolio = $yieldOnGrossPortfolio->computeYieldOnGrossPortfolio(
                    $this->cash_from_gross_loan_portfolio, $this->average_gross_loan_portfolio);
        }
    }
    function SetYieldOnGrossLoanPortfolio($period_id) {
        $this->ComputeYieldOnGrossLoanPortfolio($period_id);
        $this->SetTextColor(0,0,0);

        //display the computed ratio and it's corresponding values
        $this->SetFont('Arial','',12);
        $this->Cell(10,5,'a.', 0, 0,"J");
        $this->SetFont('Arial','',12);
        $this->Cell(10,5,'Yield on Gross Portfolio or Portfolio Yield  = ', 0, 1,"J");

        $this->SetFont('Arial','U',12);
        //spaces are to create a division effect
        $this->Cell(150,10,'Cash received from interest,fees and commisions on Loan Portfolio', 0, 1,"C");

        $this->SetFont('Arial','',12);
        $this->Cell(150,5,'Average Gross Loan Portfolio', 0, 1,"C");

        $this->Cell(150,5,'=', 0, 1,"C");

        $this->SetFont('Arial','U',12);
        $this->Cell(150,10,$this->cash_from_gross_loan_portfolio, 0, 1,"C");
        $this->SetFont('Arial','',12);
        $this->Cell(150,5, $this->average_gross_loan_portfolio, 0, 1,"C");
        $this->Cell(150,5,'=', 0, 1,"C");
        $this->SetFont('Arial','',12);
        $this->Cell(150, 5,$this->yield_on_gross_portfolio , 0, 1,"C");
        $this->SetTextColor(34,177,76);
        $this->remark = "Your Portfolio Yield should be compared against effective interest rate of loans; if your yield is significantly/consistently lower than the effective interest rate, it means your MFI has a problem with Loan collections. Also, an increasing yield is positive although it will level off as it nears the effective interest rate.";
        $this->Write(6, "NOTE: ".$this->remark);
       
    }
    function ComputePortfolioToAsset($period_id) {
        $portfolioToAsset = new PortfolioToAsset();
        $wherDataArray = array($period_id, 1);
        $wherFieldArray = array("period_id", "status");
        $logic = "AND";
        $portfolioToAssetRecord = $portfolioToAsset->select($wherDataArray, 
            $wherFieldArray, $logic);
        
        //Compute Quantities
        if (@$portfolioToAssetRecord[0]) {
            $this->gross_loan_portfolio = $portfolioToAssetRecord[0]['gross_loan_portfolio'];
            $this->assets = $portfolioToAssetRecord[0]['assets'];
            $this->portfolio_to_asset = $portfolioToAsset->computePortfolioToAsset($this->gross_loan_portfolio, 
                $this->assets);
        }
    }
    function SetPortfolioToAsset($period_id) {
        $this->ComputePortfolioToAsset($period_id);
        $this->SetTextColor(0,0,0);
        $this->ln();

        //display the computed ratio and it's corresponding values
        $this->SetFont('Arial','',12);
        $this->Cell(10,5,'b.', 0, 0,"J");
        $this->SetFont('Arial','',12);
        $this->Cell(10,5,'Portfolio to Assets = ', 0, 1,"J");

        $this->SetFont('Arial','U',12);
        //spaces are to create a division effect
        $this->Cell(150,10,'Gross Loan Portfolio', 0, 1,"C");

        $this->SetFont('Arial','',12);
        $this->Cell(150,5,'Assets', 0, 1,"C");

        $this->Cell(150,5,'=', 0, 1,"C");

        $this->SetFont('Arial','U',12);
        $this->Cell(150,10,$this->gross_loan_portfolio, 0, 1,"C");
        $this->SetFont('Arial','',12);
        $this->Cell(150,5, $this->assets, 0, 1,"C");
        $this->Cell(150,5,'=', 0, 1,"C");
        $this->SetFont('Arial','',12);
        $this->Cell(150, 5,$this->portfolio_to_asset , 0, 1,"C");
        $this->SetTextColor(34,177,76);
        $this->remark = "Your Portfolio to Assets indicates how well your MFI is allocating her assets to granting of loans to micro-entrepreneurs. Also, an increasing trend is positive.";
        $this->Write(6, "NOTE: ".$this->remark);
    }
    function ComputeCostOfFunds($period_id) {
        $costOfFunds = new CostOfFunds();
        $wherDataArray = array($period_id, 1);
        $wherFieldArray = array("period_id", "status");
        $logic = "AND";
        $costOfFundsRecord = $costOfFunds->select($wherDataArray, 
            $wherFieldArray, $logic);
        
        //Compute Quantities
        if (@$costOfFundsRecord[0]) {
            $this->financial_expense_on_funding_liabilities = $costOfFundsRecord[0]['financial_expense_on_funding_liabilities'];
            $this->average_deposit = $costOfFundsRecord[0]['average_deposit'];
            $this->average_borrowings = $costOfFundsRecord[0]['average_borrowings'];
    
            $this->cost_of_funds = $costOfFunds->computeCostOfFunds($this->financial_expense_on_funding_liabilities, 
                $this->average_deposit, $this->average_borrowings);
        }
    }
    function SetCostOfFunds($period_id) {
        $this->ComputeCostOfFunds($period_id);
        $this->SetTextColor(0,0,0);
        $this->ln();
        $this->ln();
        //display the computed ratio and it's corresponding values
        $this->SetFont('Arial','',12);
        $this->Cell(10,5,'c.', 0, 0,"J");
        $this->SetFont('Arial','',12);
        $this->Cell(10,5,'Cost of Funds = ', 0, 1,"J");

        $this->SetFont('Arial','U',12);
        //spaces are to create a division effect
        $this->Cell(150,10,'Financial Expense on Funding Liabilities', 0, 1,"C");

        $this->SetFont('Arial','',12);
        $this->Cell(150,5,'(Average Deposit + Average Borrowings)', 0, 1,"C");

        $this->Cell(150,5,'=', 0, 1,"C");

        $this->SetFont('Arial','U',12);
        $this->Cell(150,10,"           ".$this->financial_expense_on_funding_liabilities."         ", 0, 1,"C");
        $this->SetFont('Arial','',12);
        $this->Cell(150,5, $this->average_deposit." + ".$this->average_borrowings, 0, 1,"C");
        $this->Cell(150,5,'=', 0, 1,"C");
        $this->SetFont('Arial','U',12);
        $this->Cell(150,10,"   ".$this->financial_expense_on_funding_liabilities."    ", 0, 1,"C");
        $this->SetFont('Arial','',12);
        $this->Cell(150,5, ($this->average_deposit + $this->average_borrowings), 0, 1,"C");
        $this->Cell(150,5,'=', 0, 1,"C");
        $this->SetFont('Arial','',12);
        $this->Cell(150, 5,$this->cost_of_funds , 0, 1,"C");
        $this->SetTextColor(34,177,76);
        $this->remark = "A decreasing Cost of Funds ratio is generally positive. For a successful interest rate management determination, the portfolio yield is compared to the cost of funding the gross loan portfolio with borrowings. Cost of fund should always be less than the portfolio yield. Efforts should be made to minimize cost of funds and maximize portfolio yield. Comparing the cost of funds to the portfolio yield gives the MFI financial spread";
        $this->Write(6, "NOTE: ".$this->remark);
    }
    function ComputeDebtToEquity($period_id) {
        $debtToEquity = new DebtToEquity();
        $wherDataArray = array($period_id, 1);
        $wherFieldArray = array("period_id", "status");
        $logic = "AND";
        $debtToEquityRecord = $debtToEquity->select($wherDataArray, 
            $wherFieldArray, $logic);
        
        //Compute Quantities
        if (@$debtToEquityRecord[0]) {
            $this->liabilities = $debtToEquityRecord[0]['liabilities'];
            $this->equity = $debtToEquityRecord[0]['equity'];
            $this->debt_to_equity = $debtToEquity->computeDebtToEquity($this->liabilities, $this->equity);
        }
    }
    function SetDebtToEquityRatio($period_id) {
        $this->ComputeDebtToEquity($period_id);
        $this->SetTextColor(0,0,0);
        $this->ln();
        $this->ln();
        //display the computed ratio and it's corresponding values
        $this->SetFont('Arial','',12);
        $this->Cell(10,5,'d.', 0, 0,"J");
        $this->SetFont('Arial','',12);
        $this->Cell(10,5,'Debt to Equity / Leverage Ratio = ', 0, 1,"J");

        $this->SetFont('Arial','U',12);
        //spaces are to create a division effect
        $this->Cell(150,10,'Liabilties', 0, 1,"C");

        $this->SetFont('Arial','',12);
        $this->Cell(150,5,'Equity', 0, 1,"C");

        $this->Cell(150,5,'=', 0, 1,"C");

        $this->SetFont('Arial','U',12);
        $this->Cell(150,10,$this->liabilities, 0, 1,"C");
        $this->SetFont('Arial','',12);
        $this->Cell(150,5, $this->equity, 0, 1,"C");
        $this->Cell(150,5,'=', 0, 1,"C");
        $this->Cell(150, 5,$this->debt_to_equity , 0, 1,"C");
        if ($this->debt_to_equity <= 0.5) {
            $this->SetTextColor(34,177,76);
            $this->remark = "Your debt to Equity ratio is ok. This ratio shows safety cushion the bank has to absorb losses before creditors are at risk. It also shows how well the MFB is able to leverage its Equity to increase assets through borrowing. It is advisable not to have a leverage ratio that is not more than 1:2.";
        }
        else {
            $this->SetTextColor(237,28,36);
            $this->remark = "Your debt to Equity ratio is not ok. This ratio shows safety cushion the bank has to absorb losses before creditors are at risk. It also shows how well the MFB is able to leverage its Equity to increase assets through borrowing. It is advisable not to have a leverage ratio that is not more than 1:2.";
        }
        $this->Write(6, "NOTE: ".$this->remark);
    }
    function ComputeLiquidityRatio($period_id) {
        $liquidityRatio = new LiquidityRatio();
        $wherDataArray = array($period_id, 1);
        $wherFieldArray = array("period_id", "status");
        $logic = "AND";
        $liquidityRatioRecord = $liquidityRatio->select($wherDataArray, 
            $wherFieldArray, $logic);
        
        //Compute Quantities
        if (@$liquidityRatioRecord[0]) {
            $this->cash = $liquidityRatioRecord[0]['cash'];
            $this->trade_investments = $liquidityRatioRecord[0]['trade_investments'];
            $this->demand_deposits = $liquidityRatioRecord[0]['demand_deposits'];
            $this->short_term_time_deposits = $liquidityRatioRecord[0]['short_term_time_deposits'];
            $this->int_payable_funding_lia = $liquidityRatioRecord[0]['int_payable_funding_lia'];
            $this->accounts_payable = $liquidityRatioRecord[0]['accounts_payable'];
            $this->other_current_liabilities = $liquidityRatioRecord[0]['other_current_liabilities'];

            $this->liquidity_ratio = $liquidityRatio->computeLiquidityRatio($this->cash, $this->trade_investments,
            $this->demand_deposits, $this->short_term_time_deposits, $this->int_payable_funding_lia, $this->accounts_payable,
            $this->other_current_liabilities);
        }
    }
    function SetLiquidityRatio($period_id) {
        $this->ComputeLiquidityRatio($period_id);
        $this->SetTextColor(0,0,0);
        $this->ln();
        $this->ln();
        //display the computed ratio and it's corresponding values
        $this->SetFont('Arial','',12);
        $this->Cell(10,5,'e.', 0, 0,"J");
        $this->SetFont('Arial','',12);
        $this->Cell(10,5,'Liquidity Ratio = ', 0, 1,"J");

        $this->SetFont('Arial','U',9);
        //spaces are to create a division effect
        $this->Cell(150,10,'            Cash + Trade Investments             ', 0, 1,"C");

        $this->SetFont('Arial','',9);
        $this->Cell(185,5,'(Demand Deposits + Short-term Time Deposits + Interest Payable on Funding Liabilities + Accounts Payable + Other Current Liabilities)', 0, 1,"C");

        $this->Cell(150,5,'=', 0, 1,"C");

        $this->SetFont('Arial','U',12);
        $this->Cell(150,10,"           ".$this->cash." + ".$this->trade_investments."            ", 0, 1,"C");
        $this->SetFont('Arial','',12);
        $this->Cell(150,5, "( ".$this->demand_deposits." + ".$this->short_term_time_deposits." + ".$this->int_payable_funding_lia." + ".$this->accounts_payable." + ".$this->other_current_liabilities." )", 0, 1,"C");
        $this->Cell(150,5,'=', 0, 1,"C");

        $this->SetFont('Arial','U',12);
        $this->Cell(150,10,($this->cash + $this->trade_investments), 0, 1,"C");
        $this->SetFont('Arial','',12);
        $this->Cell(150,5, ($this->demand_deposits + $this->short_term_time_deposits + $this->int_payable_funding_lia + $this->accounts_payable + $this->other_current_liabilities), 0, 1,"C");
        $this->Cell(150,5,'=', 0, 1,"C");
        $this->Cell(150, 5,$this->liquidity_ratio , 0, 1,"C");
        
        $this->SetTextColor(34,177,76);
        $this->remark = "The liquidity Ratio is a measurement of the sufficiency of cash resources to pay the short-term obligations to depositors, lenders and other creditors.";
       
        $this->Write(6, "NOTE: ".$this->remark);
    }
    function ComputePortfolioAtRiskRatio($period_id) {
        $portfolioAtRisk = new PortfolioAtRisk();
        $wherDataArray = array($period_id, 1);
        $wherFieldArray = array("period_id", "status");
        $logic = "AND";
        $portfolioAtRiskRecord = $portfolioAtRisk->select($wherDataArray, 
            $wherFieldArray, $logic);
        
        //Compute Quantities
        if (@$portfolioAtRiskRecord[0]) {
            $this->principal_outstanding_on_all_past_due_loans = $portfolioAtRiskRecord[0]['principal_outstanding_on_all_past_due_loans'];
            $this->renegotiated_loans = $portfolioAtRiskRecord[0]['renegotiated_loans'];
            $this->portfolio_at_risk = $portfolioAtRisk->computePortfolioAtRisk($this->principal_outstanding_on_all_past_due_loans,
            $this->renegotiated_loans, $this->gross_loan_portfolio);
        }
    }
    function SetPortfolioAtRisk($period_id) {
        $this->ComputePortfolioAtRiskRatio($period_id);
        $this->SetTextColor(0,0,0);

        //display the computed ratio and it's corresponding values
        $this->SetFont('Arial','',12);
        $this->Cell(10,5,'a.', 0, 0,"J");
        $this->SetFont('Arial','',12);
        $this->Cell(10,5,'Portfolio at Risk (PAR) = ', 0, 1,"J");

        $this->SetFont('Arial','U',12);
        //spaces are to create a division effect
        $this->Cell(150,10,'Sum of principal outstanding on all past-due loans + Renegotiated Loans', 0, 1,"C");

        $this->SetFont('Arial','',12);
        $this->Cell(150,5,'Gross Loan Portfolio', 0, 1,"C");

        $this->Cell(150,5,'=', 0, 1,"C");

        $this->SetFont('Arial','U',12);
        $this->Cell(150,10,"     ".$this->principal_outstanding_on_all_past_due_loans." + ".$this->renegotiated_loans."      ", 0, 1,"C");
        $this->SetFont('Arial','',12);
        $this->Cell(150,5, $this->gross_loan_portfolio, 0, 1,"C");
        $this->Cell(150,5,'=', 0, 1,"C");

        $this->SetFont('Arial','U',12);
        $this->Cell(150,10,($this->principal_outstanding_on_all_past_due_loans + $this->renegotiated_loans), 0, 1,"C");
        $this->SetFont('Arial','',12);
        $this->Cell(150,5, $this->gross_loan_portfolio, 0, 1,"C");
        $this->Cell(150,5,'=', 0, 1,"C");
        $this->Cell(150, 5,$this->portfolio_at_risk , 0, 1,"C");
        
        if ($this->portfolio_at_risk <= 2.5) {
            $this->SetTextColor(34,177,76);
            $this->remark = "Your Portfolio at Risk ratio is ok. A decreasing Portfolio at Risk is positive.";
        }
        else {
            $this->SetTextColor(237,28,36);
            $this->remark = "Your Portfolio at Risk ratio is not ok. Best practice and regulatory threshold for Nigeria requires that the Portfolio at Risk for MFBs should not exceed 2.5%.";
        }
        $this->Write(6, "NOTE: ".$this->remark);
    }
    function ComputeWriteOffRatio($period_id) {
        $writeOffRatio = new WriteOffRatio();
        $wherDataArray = array($period_id, 1);
        $wherFieldArray = array("period_id", "status");
        $logic = "AND";
        $writeOffRatioRecord = $writeOffRatio->select($wherDataArray, 
            $wherFieldArray, $logic);
        
        //Compute Quantities
        if (@$writeOffRatioRecord[0]) {
            $this->value_of_loans_written_off = $writeOffRatioRecord[0]['value_of_loans_written_off'];
            
            $this->write_off_ratio = $writeOffRatio->computeWriteOffRatio($this->value_of_loans_written_off,
                $this->average_gross_loan_portfolio);
        }
    }
    function SetWriteOffRatio($period_id) {
        $this->ComputeWriteOffRatio($period_id);
        $this->SetTextColor(0,0,0);
        $this->ln();

        //display the computed ratio and it's corresponding values
        $this->SetFont('Arial','',12);
        $this->Cell(10,5,'b.', 0, 0,"J");
        $this->SetFont('Arial','',12);
        $this->Cell(10,5,'Write-Off Ratio = ', 0, 1,"J");

        $this->SetFont('Arial','U',12);
        //spaces are to create a division effect
        $this->Cell(150,10,'         Value of Loans Written off        ', 0, 1,"C");

        $this->SetFont('Arial','',12);
        $this->Cell(150,5,'Average Gross Loan Portfolio', 0, 1,"C");

        $this->Cell(150,5,'=', 0, 1,"C");

        $this->SetFont('Arial','U',12);
        $this->Cell(150,10,$this->value_of_loans_written_off, 0, 1,"C");
        $this->SetFont('Arial','',12);
        $this->Cell(150,5, $this->average_gross_loan_portfolio, 0, 1,"C");
        $this->Cell(150,5,'=', 0, 1,"C");
        $this->Cell(150, 5,$this->write_off_ratio , 0, 1,"C");
        
        $this->SetTextColor(34,177,76);
        $this->remark = "A decreasing Write-off Ratio is positive.";

        $this->Write(6, "NOTE: ".$this->remark);
    }
    function ComputeOperatingExpenseRatio() {
        if ($this->average_gross_loan_portfolio > 0)
            $this->operating_expense_ratio = $this->operating_expense / $this->average_gross_loan_portfolio;
        else 
            $this->operating_expense_ratio = 0;
    }
    function SetOperatingExpenseRatio() {
        $this->ComputeOperatingExpenseRatio();
        $this->SetTextColor(0,0,0);
        
        //display the computed ratio and it's corresponding values
        $this->SetFont('Arial','',12);
        $this->Cell(10,5,'a.', 0, 0,"J");
        $this->SetFont('Arial','',12);
        $this->Cell(10,5,'Operating Expense Ratio = ', 0, 1,"J");

        $this->SetFont('Arial','U',12);
        //spaces are to create a division effect
        $this->Cell(150,10,'         Operating Expense        ', 0, 1,"C");

        $this->SetFont('Arial','',12);
        $this->Cell(150,5,'Average Gross Loan Portfolio', 0, 1,"C");

        $this->Cell(150,5,'=', 0, 1,"C");

        $this->SetFont('Arial','U',12);
        $this->Cell(150,10,$this->operating_expense, 0, 1,"C");
        $this->SetFont('Arial','',12);
        $this->Cell(150,5, $this->average_gross_loan_portfolio, 0, 1,"C");
        $this->Cell(150,5,'=', 0, 1,"C");
        $this->Cell(150, 5,$this->operating_expense_ratio , 0, 1,"C");
        
        $this->SetTextColor(34,177,76);
        $this->remark = "The Operating Expense Ratio enables managers to quickly compare administrative and personnel expenses to the MFB yield on the Gross Loan Portfolio. The lower the operating expense ratio, the more efficient the MFB is.";

        $this->Write(6, "NOTE: ".$this->remark);
    }
    function ComputeCostPerClientRatio($period_id) {
        $costPerClient = new CostPerClient();
        $wherDataArray = array($period_id, 1);
        $wherFieldArray = array("period_id", "status");
        $logic = "AND";
        $costPerClientRecord = $costPerClient->select($wherDataArray, 
            $wherFieldArray, $logic);
        
        //Compute Quantities
        if (@$costPerClientRecord[0]) {
            $this->average_number_of_clients = $costPerClientRecord[0]['average_number_of_clients'];
            $this->cost_per_client_ratio = $costPerClient->computeCostPerClient($this->operating_expense,
                 $this->average_number_of_clients);
        }
    }
    function SetCostPerClient($period_id) {
        $this->ComputeCostPerClientRatio($period_id);
        $this->SetTextColor(0,0,0);
        $this->ln();
        //display the computed ratio and it's corresponding values
        $this->SetFont('Arial','',12);
        $this->Cell(10,5,'b.', 0, 0,"J");
        $this->SetFont('Arial','',12);
        $this->Cell(10,5,'Cost per Client Ratio = ', 0, 1,"J");

        $this->SetFont('Arial','U',12);
        //spaces are to create a division effect
        $this->Cell(150,10,'         Operating Expense        ', 0, 1,"C");

        $this->SetFont('Arial','',12);
        $this->Cell(150,5,'Average Number of Clients', 0, 1,"C");

        $this->Cell(150,5,'=', 0, 1,"C");

        $this->SetFont('Arial','U',12);
        $this->Cell(150,10,$this->operating_expense, 0, 1,"C");
        $this->SetFont('Arial','',12);
        $this->Cell(150,5, $this->average_number_of_clients, 0, 1,"C");
        $this->Cell(150,5,'=', 0, 1,"C");
        $this->Cell(150, 5,$this->cost_per_client_ratio , 0, 1,"C");
        
        $this->SetTextColor(34,177,76);
        $this->remark = "The Cost per Client Ratio indicates to an institution how much it currently spends in Personnel and Administrative Expenses to serve a single active client. It informs the MFI how much it must earn on average from each client to be profitable.";

        $this->Write(6, "NOTE: ".$this->remark);
    }
    function SetSustainabiltyAndProfitabilityRatios($period_id) {
        $this->SetFont('Arial','BU',14);
        $this->Cell(190,20,'Sustainability and Profitability', 0, 1,"C");
        $this->SetOperationalSelfSufficiency($period_id);
        $this->SetFinancialSelfSufficiency($period_id);
        $this->SetAdjustedReturnOnAssets($period_id);
        $this->SetAdjustedReturnOnEquity($period_id);
    }
    function SetAssetAndLiabilityManagementRatios($period_id) {
        $this->SetFont('Arial','BU',14);
        $this->SetTextColor(0,0,0);
        $this->Cell(190,20,'Asset And Liability Management', 0, 1,"C");
        $this->SetYieldOnGrossLoanPortfolio($period_id);
        $this->SetPortfolioToAsset($period_id);
        $this->SetCostOfFunds($period_id);
        $this->SetDebtToEquityRatio($period_id);
        $this->SetLiquidityRatio($period_id);
    }
    function SetPortfolioQualityRatios($period_id) {
        $this->SetFont('Arial','BU',14);
        $this->SetTextColor(0,0,0);
        $this->Cell(190,20,'Portfolio Quality Ratio', 0, 1,"C");
        $this->SetPortfolioAtRisk($period_id);
        $this->SetWriteOffRatio($period_id);
    }
    function SetEfficiencyRatios($period_id) {
        $this->SetFont('Arial','BU',14);
        $this->SetTextColor(0,0,0);
        $this->Cell(190,20,'Efficiency/Productivity Ratios', 0, 1,"C");
        $this->SetOperatingExpenseRatio();
        $this->SetCostPerClient($period_id);
    }
}

$financialRatioGenerator = new FinancialRatioGenerator();

//get the period that report should be generated for
$period_id = $_GET['period_id'];
$managementReportPeriod = new ManagementReportPeriod();
$whereDataArray = array($period_id);
$whereFieldArray = array("id");
$logic = "";
$managementReportPeriodRecords = $managementReportPeriod->select($whereDataArray, 
                                                     $whereFieldArray, $logic);
$period = $managementReportPeriodRecords[0]['from_date']." ". $managementReportPeriodRecords[0]['to_date'];

$financialRatioGenerator = new FinancialRatioGenerator();
$financialRatioGenerator->period = $period;
$financialRatioGenerator->SetDocumentInformation();

$financialRatioGenerator->AddPage();
$financialRatioGenerator->SetPageHeading();
$financialRatioGenerator->SetSustainabiltyAndProfitabilityRatios($period_id);
$financialRatioGenerator->ln();
$financialRatioGenerator->SetAssetAndLiabilityManagementRatios($period_id);
$financialRatioGenerator->ln();
$financialRatioGenerator->ln();
$financialRatioGenerator->SetPortfolioQualityRatios($period_id);
$financialRatioGenerator->ln();
$financialRatioGenerator->SetEfficiencyRatios($period_id);
try {
    $financialRatioGenerator->output();
    }
catch(Exception $e) {
    echo "Error: " . $e->getMessage();
}
//
?>