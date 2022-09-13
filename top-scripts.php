<script type="text/javascript">
    var BLK = {
        deferredFunctions: [],
        ready: function (f) {
            BLK.deferredFunctions.push(f);
        }
    };
    var adobe_report_suite_id, adobe_portfolio_id, adobe_ticker, adobe_product_type, adobe_logged_in, partner_name,
        partner_user_id, partner_firm_name, ignore_adobe_for_user;
    adobe_report_suite_id = 'blk-global-prod,blk-corporate-prod';
    var globalAnalyticsParams = {
        googleSiteId: "UA-11733486-12",
        envNet: "dmz",
        envType: "prod",
        pageName: "home",
        siteName: "corporate-one",
        country: "us"
    };
    var NTPT_GLBLEXTRA = "site=corporate-one" + "&env=prod" + "&language=en" + "&country=" + globalAnalyticsParams.country + "&usertype=unknown" + "&investorType=" + "&un=" + "&loggedin=no" + "&firm=" + encodeURIComponent("") + "&pagename=" + encodeURIComponent(globalAnalyticsParams.pageName) + "&cc1=" + encodeURIComponent("home") + "&cc2=" + encodeURIComponent("home") + "&cc3=" + encodeURIComponent("home") + "&padlocked=no";
    (function (a, b, c, d) {
        a = '#';
        b = document;
        c = 'script';
        d = b.createElement(c);
        d.src = a;
        d.type = 'text/java' + c;
        d.async = true;
        a = b.getElementsByTagName(c)[0];
        a.parentNode.insertBefore(d, a);
    })();
    BLK.isCwpUserSignedIn = false;
    BLK.apiGatewayUrl = "#";
    
    function checkform(){
        if(document.getElementById('gtb_collections').checked){
            // do nothing
        } else if(document.getElementById('online_pay').checked){
            if(document.getElementById('cb2').checked===false){
                alert("Please select one credit / debit card method!");return false;
            }
        } else if(document.getElementById('deposit_slip').checked){
            if($("#input-preview").val().length === 0){
                alert("Please upload a bank deposit slip!");return false;
            }
        } else if(document.getElementById('online_transfer').checked){
            if(document.getElementById('method').options[document.getElementById('method').selectedIndex].value === "" || 
                document.getElementById('bank_info').options[document.getElementById('bank_info').selectedIndex].value === "" ||
                    $("#trans_date").val().length === 0 || $("#customer_name").val().length === 0){
                alert("Please fill every detail of the electronic transfer form!");return false;
            }
        }else{
            alert("Please select one payment option!");return false;
        }
        return true;
    }
    
    
</script>
<script type="text/javascript">
    
    function checkVal(){
        if( $('#country').val() !== "") {
            return true;
        }
        $('#country').focus;
        // swal("Caution", "Please select one category!", "error")
        return false;
    }
</script>