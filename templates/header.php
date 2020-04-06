<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>ALVANA MICROFINANCE BANK LTD.</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="Keywords" content=""/>
    <meta name="Description" content="All about Alvana Microfinance Bank, contact info, products & services, staff members, careers & opportunity"/>
    <?php
        if(file_exists("images/favicon.png")) {

    ?>
        <link rel="icon" href="images/favicon.png" type="image/x-icon"/>
        <link rel="stylesheet" href="css/font-awesome.min.css"/>
        <link rel="stylesheet" href="css/bootstrap.min.css"/>
        <link rel="stylesheet" href="css/style.css"/>
    <?php
        }
        else {
    ?>
        <link rel="icon" href="../images/favicon.png" type="image/x-icon"/>
        <link rel="stylesheet" href="../css/font-awesome.min.css"/>
        <link rel="stylesheet" href="../css/bootstrap.min.css"/>
        <link rel="stylesheet" href="../css/dataTables.bootstrap.min.css"/>
        <link rel="stylesheet" href="../css/style.css"/>
    <?php
        }
    ?>
</head>
<body>
<div class="section" id="start">
    <div class="row header">
        <div class="col-lg-2 col-md-2 col-sm-2" id="logo-div">
        <?php
            if(file_exists("images/logo square.png")) {
        ?>
                <img src="images/logo square.png" id="logo" />
        <?php
            }
            else {
        ?>
                <img src="../images/logo square.png" id="logo" />
        <?php
            }
        ?>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-10">
            <h1> ALMFB LTD. FINANCIAL RATIO SUITE </h1>
        </div>
    </div>
    <div class="row" id="menu">
        <div class="col-lg-1 col-md-1 col-sm-1">
            <a href="index.php?page=index">Home</a>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2">
            <a id="sustainability_profitability" href="index.php?page=sustainability_profitability">Sustainability/Profitability</a>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2">
            <a id="asset_liability_management" href="index.php?page=asset_liability_management">Asset/Liability Management</a>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2">
            <a id="portfolio_quality" href="index.php?page=portfolio_quality">Portfolio Quality</a>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2">
            <a id="efficiency_ratio" href="index.php?page=efficiency_ratio">Efficiency Ratio</a>
        </div>
        <?php
            if (@$_SESSION['logged-in']) {
        ?>
                <div class="col-lg-2 col-md-2 col-sm-2">
                    <a id='generate_report' href="index.php?page=generate_report">Generate Report</a>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1">
                    <a id="Logout" href="signout.php">Logout</a>
                </div>
        <?php
            }
        ?>            
    </div>