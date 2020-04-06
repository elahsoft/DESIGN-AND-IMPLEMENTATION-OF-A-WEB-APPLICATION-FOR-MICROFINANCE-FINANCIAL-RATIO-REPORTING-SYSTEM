    <div class="row footer-div">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <p id="footer"> Copyright © 2018 Alvana Microfinance Bank Limited. </p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <p id="app-author"> Powered by Elahsoft Systems </p>
        </div>
    </div>
</div>
</body>
<?php
    if (file_exists("js/jquery-3.3.1.min.js")) {
?>
        <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
<?php
    }
    else {
?>
        <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="../js/dataTables.bootstrap.min.js"></script>
        <script type="text/javascript" src="../js/datatables.js"></script>
        <script type="text/javascript" src="../js/updateStatus.js"></script>
        <script type="text/javascript" src="../js/deleteRecord.js"></script>
<?php
    }
?>
    
</html>