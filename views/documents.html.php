<div id="wrapper">
    <div id="left">
        <div id="status">
            <div class="auth__row">
                <input class="auth__text" type="text" id="userttn" value="">
                <i class="auth__error auth__error_hide">Not valid ttn (14 digits)</i>
                <p><?= $error ? $error : '' ?></p>
            </div>
            <div class="auth__row">
                <button type="button" id="sendbtn" class="auth__btn">Get status TTN</button>
            </div>
        </div>
        <div id="rezult"></div>
    </div>
    <div id="right">
        <h4>History</h3>
        <ul></ul>
    </div>
</div>
<script src="documents.js"></script>
<script src="get_documents.js"></script>