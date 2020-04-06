<?php
    require_once 'templates/header.php';

    $page = @$_GET['page'];
    if($page == "index" || $page == "")
        require_once 'clients/v_home.php';
    else if($page == "sustainability_profitability")
        require_once 'clients/v_sustainability_profitability.php';
    else if($page == "asset_liability_management")
        require_once 'clients/v_asset_liability_management.php';
    else if($page == "portfolio_quality")
        require_once 'clients/v_portfolio_quality.php';
    else if($page == "efficiency_ratio")
        require_once 'clients/v_efficiency_ratio.php';
        
    else 
        require_once 'clients/v_home.php';

    require_once 'templates/footer.php';
?>