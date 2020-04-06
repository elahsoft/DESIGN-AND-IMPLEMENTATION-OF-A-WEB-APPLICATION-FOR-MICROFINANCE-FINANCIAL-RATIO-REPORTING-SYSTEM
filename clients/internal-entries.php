<?php
    require_once '../templates/header_v2.php';
?>
<div class="row" id="internal">
    <div class="col-lg-2 col-md-2 col-sm-2" id="internal-label">
        <h2>Internal Entry</h2>
    </div>
    <div class="col-lg-10 col-md-10 col-sm-10" id="internal-entry-text">
        <p> You prepare your Internal Entries here & also view past entries. Please,
            note the auto-generated Last Closing Bal. and contra note numbers for reversal. It can also be 
        seen in the contra notes. </p>
    </div>
</div>
<div class="row" id="form-menu-section">
    <div class="col-lg-4 col-md-4 col-sm-4" id="side-menu">
        <p> <a href="#"> Archives </a></p>
        <p> <a href="#"> New Entry </a></p>
        <p> <a href="#"> Most Recent Entry </a></p>
    </div>

    <div class="col-lg-8 col-md-8 col-sm-8"  id="internal-entry-form">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                <label for="Bank Account Name">Bank Account Name - GL Number</label>
                <select name="bank-name" class="form-control">
                    <option value="first-bank-mbano">First Bank Mbano - 10040009</option>
                    <option value="Diamond-Bank">Diamond Bank - 10040004</option>
                    <option value="ecobank">EcoBank - 10040005</option>
                    <option value="UBA">UBA - 10040003</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                <label for="Last Closing Balance">Last Closing Balance:</label>
                <input type="text" name="last-closing-balance" id="last-closing-balance" 
                disabled="disabled" class="form-control"/>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                <label for="Contra Note Number">Contra Note Number</label>
                <input type="text" name="contra-note-number" id="contra-note-number" class="form-control" />
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                <label for="Date of Transaction">Date of Transaction:</label>
                <input type="date" name="date-of-transaction" id="date-of-transaction" class="form-control"/>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                <label for="Narration">Narration</label>
                <textarea name="narration" id="narration" cols="20" rows="5" class="form-control"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                <label for="Amount">Amount:</label>
                <input type="text" name="amount" id="amount" class="form-control"/>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                <label for="Operation Type">Operation</label>
                <input type="radio" name="operation" value="debit" > Debit
                <input type="radio" name="operation" value="credit" > Credit
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                <label for="Account to Debit or Credit">Account to Debit/Credit:</label>
                <input type="text" name="account-to-debit-or-credit" id="account-to-debit-or-credit" class="form-control"/>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                <label for="New Closing Balance">New Closing Balance</label>
                <input type="text" name="new-closing-balance" id="new-closing-balance" disabled="disabled" class="form-control"/>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                <input type="submit" name="sub-new-internal" id="sub-new-internal" />
            </div>
        </div>

    </div>

</div>
<?php
    require_once '../templates/footer_v2.php';
?>