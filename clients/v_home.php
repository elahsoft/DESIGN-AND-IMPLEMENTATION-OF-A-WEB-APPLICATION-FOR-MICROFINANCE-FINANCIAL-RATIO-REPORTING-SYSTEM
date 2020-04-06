<div class="row" id="home">
    <div class="col-lg-2 col-md-2 col-sm-2" id="home-label">
        <h2>Home</h2>
    </div>
    <div class="col-lg-10 col-md-10 col-sm-10" id="welcome-text">
        <p> Welcome! Alvana Financial Ratio Computation Suite makes it easy for the 
        account officer to prepare Management Financial Ratios report. </p>
    </div>
</div>
<?php
    if (@!$_SESSION['logged-in'])
        require_once 'v_signin.php';
    ?>
</div>