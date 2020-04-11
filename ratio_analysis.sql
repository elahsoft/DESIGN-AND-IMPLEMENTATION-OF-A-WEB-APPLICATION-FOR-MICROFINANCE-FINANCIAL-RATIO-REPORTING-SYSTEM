-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2020 at 08:36 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ratio_analysis`
--

-- --------------------------------------------------------

--
-- Table structure for table `ra_adjusted_return_on_assets`
--

CREATE TABLE `ra_adjusted_return_on_assets` (
  `id` int(11) NOT NULL,
  `period_id` int(11) NOT NULL,
  `adjusted_net_operating_income` varchar(100) NOT NULL,
  `taxes` varchar(100) NOT NULL,
  `adjusted_average_assets` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ra_adjusted_return_on_assets`
--

INSERT INTO `ra_adjusted_return_on_assets` (`id`, `period_id`, `adjusted_net_operating_income`, `taxes`, `adjusted_average_assets`, `date`, `status`) VALUES
(1, 1, '70000000', '2000000', '500000', '03/09/20', 1),
(2, 1, '60000000', '50000', '30000000', '03/29/20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ra_adjusted_return_on_equity`
--

CREATE TABLE `ra_adjusted_return_on_equity` (
  `id` int(11) NOT NULL,
  `period_id` int(11) NOT NULL,
  `adjusted_average_equity` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ra_adjusted_return_on_equity`
--

INSERT INTO `ra_adjusted_return_on_equity` (`id`, `period_id`, `adjusted_average_equity`, `date`, `status`) VALUES
(1, 1, '1000000', '03/09/20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ra_cost_of_funds`
--

CREATE TABLE `ra_cost_of_funds` (
  `id` int(11) NOT NULL,
  `period_id` int(11) NOT NULL,
  `financial_expense_on_funding_liabilities` varchar(100) NOT NULL,
  `average_deposit` varchar(100) NOT NULL,
  `average_borrowings` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ra_cost_of_funds`
--

INSERT INTO `ra_cost_of_funds` (`id`, `period_id`, `financial_expense_on_funding_liabilities`, `average_deposit`, `average_borrowings`, `date`, `status`) VALUES
(1, 1, '4000000', '10000000', '5000000', '03/10/20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ra_cost_per_client`
--

CREATE TABLE `ra_cost_per_client` (
  `id` int(11) NOT NULL,
  `period_id` int(11) NOT NULL,
  `average_number_of_clients` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ra_cost_per_client`
--

INSERT INTO `ra_cost_per_client` (`id`, `period_id`, `average_number_of_clients`, `date`, `status`) VALUES
(1, 1, '700', '03/12/20', 1),
(2, 2, '300', '03/12/20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ra_debt_to_equity`
--

CREATE TABLE `ra_debt_to_equity` (
  `id` int(11) NOT NULL,
  `period_id` int(11) NOT NULL,
  `liabilities` varchar(100) NOT NULL,
  `equity` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ra_debt_to_equity`
--

INSERT INTO `ra_debt_to_equity` (`id`, `period_id`, `liabilities`, `equity`, `date`, `status`) VALUES
(1, 1, '2000000', '4000000', '03/11/20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ra_financial_self_sufficiency`
--

CREATE TABLE `ra_financial_self_sufficiency` (
  `id` int(11) NOT NULL,
  `period_id` int(11) NOT NULL,
  `average_equity` varchar(100) NOT NULL,
  `average_fixed_assets` varchar(100) NOT NULL,
  `inflation_rate` varchar(100) NOT NULL,
  `average_funding_liabilities` varchar(100) NOT NULL,
  `commercial_rate_for_funds` varchar(100) NOT NULL,
  `interest_and_fees_expense` varchar(100) NOT NULL,
  `gross_loan_losses` varchar(100) NOT NULL,
  `lost_interest_deductions` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ra_financial_self_sufficiency`
--

INSERT INTO `ra_financial_self_sufficiency` (`id`, `period_id`, `average_equity`, `average_fixed_assets`, `inflation_rate`, `average_funding_liabilities`, `commercial_rate_for_funds`, `interest_and_fees_expense`, `gross_loan_losses`, `lost_interest_deductions`, `date`, `status`) VALUES
(1, 1, '200000', '30000', '0.2', '500', '200', '200', '100', '20', '03/09/20', 1),
(2, 1, '60000000', '50000000', '0.2', '100000', '0.1', '2000000', '1000000', '500000', '03/29/20', 1),
(3, 1, '60000000', '50000000', '0.2', '100000', '0.1', '2000000', '1000000', '500000', '03/29/20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ra_liquidity_ratio`
--

CREATE TABLE `ra_liquidity_ratio` (
  `id` int(11) NOT NULL,
  `period_id` int(11) NOT NULL,
  `cash` varchar(100) NOT NULL,
  `trade_investments` varchar(100) NOT NULL,
  `demand_deposits` varchar(100) NOT NULL,
  `short_term_time_deposits` varchar(100) NOT NULL,
  `int_payable_funding_lia` varchar(100) NOT NULL,
  `accounts_payable` varchar(100) NOT NULL,
  `other_current_liabilities` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ra_liquidity_ratio`
--

INSERT INTO `ra_liquidity_ratio` (`id`, `period_id`, `cash`, `trade_investments`, `demand_deposits`, `short_term_time_deposits`, `int_payable_funding_lia`, `accounts_payable`, `other_current_liabilities`, `date`, `status`) VALUES
(1, 1, '70000000', '30000000', '2000000', '40000000', '10000000', '12000000', '3000000', '03/11/20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ra_management_report_period`
--

CREATE TABLE `ra_management_report_period` (
  `id` int(11) NOT NULL,
  `from_date` varchar(100) NOT NULL,
  `to_date` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ra_management_report_period`
--

INSERT INTO `ra_management_report_period` (`id`, `from_date`, `to_date`, `date`, `status`) VALUES
(1, '2020-01-01', '2020-03-31', '03/04/20', 1),
(2, '2019-10-01', '2019-12-31', '03/05/20', 1),
(3, '2020-03-01', '2020-03-31', '03/18/20', 1),
(6, '01/01/2020', '31/01/2020', '03/28/20', 1),
(7, '01/01/2020', '31/01/2020', '03/28/20', 1),
(8, '01/01/2020', '31/01/2020', '03/28/20', 1),
(9, '01/01/2020', '31/01/2020', '03/28/20', 1),
(10, '01/01/2020', '31/01/2020', '03/28/20', 1),
(11, '01/01/2020', '31/01/2020', '03/28/20', 1),
(12, '01/01/2020', '31/01/2020', '03/28/20', 1),
(13, '01/01/2020', '31/01/2020', '03/28/20', 1),
(14, '01/01/2020', '31/01/2020', '03/28/20', 1),
(15, '01/01/2020', '31/01/2020', '03/28/20', 1),
(16, '01/01/2020', '31/01/2020', '03/28/20', 1),
(17, '01/01/2020', '31/01/2020', '03/28/20', 1),
(18, '01/01/2020', '31/01/2020', '03/28/20', 1),
(19, '01/01/2020', '31/01/2020', '03/28/20', 1),
(20, '01/01/2020', '31/01/2020', '03/28/20', 1),
(21, '01/01/2020', '31/01/2020', '03/28/20', 1),
(22, '01/01/2020', '31/01/2020', '03/28/20', 1),
(23, '01/01/2020', '31/01/2020', '03/28/20', 1),
(24, '01/01/2020', '31/01/2020', '03/28/20', 1),
(25, '01/01/2020', '31/01/2020', '03/28/20', 1),
(26, '01/01/2020', '31/01/2020', '03/28/20', 1),
(27, '01/01/2020', '31/01/2020', '03/28/20', 1),
(28, '01/01/2020', '31/01/2020', '03/28/20', 1),
(29, '01/01/2020', '31/01/2020', '03/28/20', 1),
(30, '01/01/2020', '31/01/2020', '03/28/20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ra_operational_self_sufficiency`
--

CREATE TABLE `ra_operational_self_sufficiency` (
  `id` int(11) NOT NULL,
  `period_id` int(11) NOT NULL,
  `interest_earned_in_cash` varchar(100) NOT NULL,
  `income_from_fees` varchar(100) NOT NULL,
  `commissions` varchar(100) NOT NULL,
  `interest_accrued_but_not_yet_earned` varchar(100) NOT NULL,
  `interest_paid_in_cash` varchar(100) NOT NULL,
  `fees_paid` varchar(100) NOT NULL,
  `commissions_paid` varchar(100) NOT NULL,
  `accrued_interest_but_not_yet_paid` varchar(100) NOT NULL,
  `loan_losses_expense` varchar(100) NOT NULL,
  `personnel_expense` varchar(100) NOT NULL,
  `administrative_expense` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ra_operational_self_sufficiency`
--

INSERT INTO `ra_operational_self_sufficiency` (`id`, `period_id`, `interest_earned_in_cash`, `income_from_fees`, `commissions`, `interest_accrued_but_not_yet_earned`, `interest_paid_in_cash`, `fees_paid`, `commissions_paid`, `accrued_interest_but_not_yet_paid`, `loan_losses_expense`, `personnel_expense`, `administrative_expense`, `date`, `status`) VALUES
(1, 1, '4000000', '10000000', '20000000', '30000000', '100000', '20000', '23000', '100000', '500000', '200000', '10000', '03/09/20', 1),
(2, 1, '20000000', '10000000', '30000000', '4000000', '3000000', '2000000', '1000000', '500000', '3000000', '2000000', '500000', '03/28/20', 1),
(6, 1, '60000000', '50000000', '130000000', '7000000', '3000000', '2000000', '1000000', '500000', '3000000', '2000000', '500000', '03/29/20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ra_portfolio_at_risk`
--

CREATE TABLE `ra_portfolio_at_risk` (
  `id` int(11) NOT NULL,
  `period_id` int(11) NOT NULL,
  `principal_outstanding_on_all_past_due_loans` varchar(100) NOT NULL,
  `renegotiated_loans` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ra_portfolio_at_risk`
--

INSERT INTO `ra_portfolio_at_risk` (`id`, `period_id`, `principal_outstanding_on_all_past_due_loans`, `renegotiated_loans`, `date`, `status`) VALUES
(1, 1, '20000000', '40000000', '03/12/20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ra_portfolio_to_asset`
--

CREATE TABLE `ra_portfolio_to_asset` (
  `id` int(11) NOT NULL,
  `period_id` int(11) NOT NULL,
  `gross_loan_portfolio` varchar(100) NOT NULL,
  `assets` varchar(100) NOT NULL,
  `date` varchar(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ra_portfolio_to_asset`
--

INSERT INTO `ra_portfolio_to_asset` (`id`, `period_id`, `gross_loan_portfolio`, `assets`, `date`, `status`) VALUES
(1, 1, '80000000', '30000000', '03/10/20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ra_users`
--

CREATE TABLE `ra_users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `date` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ra_users`
--

INSERT INTO `ra_users` (`id`, `username`, `password`, `date`, `status`) VALUES
(1, 'elahsoft', 'YWx2YW5hTUZCMjAxOCo=', '27/02/2020', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ra_write_off_ratio`
--

CREATE TABLE `ra_write_off_ratio` (
  `id` int(11) NOT NULL,
  `period_id` int(11) NOT NULL,
  `value_of_loans_written_off` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ra_write_off_ratio`
--

INSERT INTO `ra_write_off_ratio` (`id`, `period_id`, `value_of_loans_written_off`, `date`, `status`) VALUES
(1, 1, '10000000', '03/12/20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ra_yield_on_gross_portfolio`
--

CREATE TABLE `ra_yield_on_gross_portfolio` (
  `id` int(11) NOT NULL,
  `period_id` int(11) NOT NULL,
  `cash_from_gross_loan_portfolio` varchar(100) NOT NULL,
  `average_gross_loan_portfolio` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ra_yield_on_gross_portfolio`
--

INSERT INTO `ra_yield_on_gross_portfolio` (`id`, `period_id`, `cash_from_gross_loan_portfolio`, `average_gross_loan_portfolio`, `date`, `status`) VALUES
(1, 1, '20000000', '15000000', '03/10/20', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ra_adjusted_return_on_assets`
--
ALTER TABLE `ra_adjusted_return_on_assets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `period_id` (`period_id`),
  ADD KEY `adjusted_net_operating_income` (`adjusted_net_operating_income`),
  ADD KEY `taxes` (`taxes`),
  ADD KEY `adjusted_average_assets` (`adjusted_average_assets`),
  ADD KEY `date` (`date`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `ra_adjusted_return_on_equity`
--
ALTER TABLE `ra_adjusted_return_on_equity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `period_id` (`period_id`),
  ADD KEY `adjusted_average_equity` (`adjusted_average_equity`),
  ADD KEY `date` (`date`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `ra_cost_of_funds`
--
ALTER TABLE `ra_cost_of_funds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `period_id` (`period_id`),
  ADD KEY `financial_expense_on_funding_liabilities` (`financial_expense_on_funding_liabilities`),
  ADD KEY `average_deposit` (`average_deposit`),
  ADD KEY `average_borrowings` (`average_borrowings`),
  ADD KEY `date` (`date`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `ra_cost_per_client`
--
ALTER TABLE `ra_cost_per_client`
  ADD PRIMARY KEY (`id`),
  ADD KEY `period_id` (`period_id`),
  ADD KEY `average_number_of_clients` (`average_number_of_clients`),
  ADD KEY `date` (`date`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `ra_debt_to_equity`
--
ALTER TABLE `ra_debt_to_equity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `period_id` (`period_id`),
  ADD KEY `liabilities` (`liabilities`),
  ADD KEY `equity` (`equity`),
  ADD KEY `date` (`date`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `ra_financial_self_sufficiency`
--
ALTER TABLE `ra_financial_self_sufficiency`
  ADD PRIMARY KEY (`id`),
  ADD KEY `period` (`period_id`),
  ADD KEY `average_equity` (`average_equity`),
  ADD KEY `average_fixed_assets` (`average_fixed_assets`),
  ADD KEY `inflation_rate` (`inflation_rate`),
  ADD KEY `average_funding_liabilities` (`average_funding_liabilities`),
  ADD KEY `commercial_rate_for_funds` (`commercial_rate_for_funds`),
  ADD KEY `interest_and_fees_expense` (`interest_and_fees_expense`),
  ADD KEY `gross_loan_losses` (`gross_loan_losses`),
  ADD KEY `lost_interest_deductions` (`lost_interest_deductions`),
  ADD KEY `date` (`date`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `ra_liquidity_ratio`
--
ALTER TABLE `ra_liquidity_ratio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `period_id` (`period_id`),
  ADD KEY `cash` (`cash`),
  ADD KEY `trade_investments` (`trade_investments`),
  ADD KEY `demand_deposits` (`demand_deposits`),
  ADD KEY `short_term_time_deposits` (`short_term_time_deposits`),
  ADD KEY `int_payable_funding_lia` (`int_payable_funding_lia`),
  ADD KEY `accounts_payable` (`accounts_payable`),
  ADD KEY `other_current_liabilities` (`other_current_liabilities`),
  ADD KEY `date` (`date`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `ra_management_report_period`
--
ALTER TABLE `ra_management_report_period`
  ADD PRIMARY KEY (`id`),
  ADD KEY `from_date` (`from_date`),
  ADD KEY `to_date` (`to_date`),
  ADD KEY `date` (`date`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `ra_operational_self_sufficiency`
--
ALTER TABLE `ra_operational_self_sufficiency`
  ADD PRIMARY KEY (`id`),
  ADD KEY `interest_earned_in_cash` (`interest_earned_in_cash`),
  ADD KEY `income_from_fees` (`income_from_fees`),
  ADD KEY `commissions` (`commissions`),
  ADD KEY `interest_accrued_but_not_yet_earned` (`interest_accrued_but_not_yet_earned`),
  ADD KEY `interest_paid_in_cash` (`interest_paid_in_cash`),
  ADD KEY `fees_paid` (`fees_paid`),
  ADD KEY `commissions_paid` (`commissions_paid`),
  ADD KEY `accrued_interest_but_not_yet_paid` (`accrued_interest_but_not_yet_paid`),
  ADD KEY `loan_losses_expense` (`loan_losses_expense`),
  ADD KEY `personnel_expense` (`personnel_expense`),
  ADD KEY `administrative_expense` (`administrative_expense`),
  ADD KEY `date` (`date`),
  ADD KEY `status` (`status`),
  ADD KEY `period` (`period_id`) USING BTREE;

--
-- Indexes for table `ra_portfolio_at_risk`
--
ALTER TABLE `ra_portfolio_at_risk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `period_id` (`period_id`),
  ADD KEY `principal_outstanding_on_all_past_due_loans` (`principal_outstanding_on_all_past_due_loans`),
  ADD KEY `renegotiated_loans` (`renegotiated_loans`),
  ADD KEY `date` (`date`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `ra_portfolio_to_asset`
--
ALTER TABLE `ra_portfolio_to_asset`
  ADD PRIMARY KEY (`id`),
  ADD KEY `period_id` (`period_id`),
  ADD KEY `gross_loan_portfolio` (`gross_loan_portfolio`),
  ADD KEY `assets` (`assets`),
  ADD KEY `date` (`date`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `ra_users`
--
ALTER TABLE `ra_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `password` (`password`),
  ADD KEY `date` (`date`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `ra_write_off_ratio`
--
ALTER TABLE `ra_write_off_ratio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `period_id` (`period_id`),
  ADD KEY `value_of_loans_written_of` (`value_of_loans_written_off`),
  ADD KEY `date` (`date`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `ra_yield_on_gross_portfolio`
--
ALTER TABLE `ra_yield_on_gross_portfolio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `period_id` (`period_id`),
  ADD KEY `cash_from_gross_loan_portfolio` (`cash_from_gross_loan_portfolio`),
  ADD KEY `average_gross_loan_portfolio` (`average_gross_loan_portfolio`),
  ADD KEY `date` (`date`),
  ADD KEY `status` (`status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ra_adjusted_return_on_assets`
--
ALTER TABLE `ra_adjusted_return_on_assets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ra_adjusted_return_on_equity`
--
ALTER TABLE `ra_adjusted_return_on_equity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ra_cost_of_funds`
--
ALTER TABLE `ra_cost_of_funds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ra_cost_per_client`
--
ALTER TABLE `ra_cost_per_client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ra_debt_to_equity`
--
ALTER TABLE `ra_debt_to_equity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ra_financial_self_sufficiency`
--
ALTER TABLE `ra_financial_self_sufficiency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ra_liquidity_ratio`
--
ALTER TABLE `ra_liquidity_ratio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ra_management_report_period`
--
ALTER TABLE `ra_management_report_period`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `ra_operational_self_sufficiency`
--
ALTER TABLE `ra_operational_self_sufficiency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ra_portfolio_at_risk`
--
ALTER TABLE `ra_portfolio_at_risk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ra_portfolio_to_asset`
--
ALTER TABLE `ra_portfolio_to_asset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ra_users`
--
ALTER TABLE `ra_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ra_write_off_ratio`
--
ALTER TABLE `ra_write_off_ratio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ra_yield_on_gross_portfolio`
--
ALTER TABLE `ra_yield_on_gross_portfolio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
