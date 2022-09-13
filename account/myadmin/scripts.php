<script data-cfasync="false" src="/cdn-cgi/scripts/d07b1474/cloudflare-static/email-decode.min.js"></script><script src="assets\plugins\jQuery\jquery-1.12.4.min.js"></script>
<script src="assets\plugins\jquery-ui-1.12.1\jquery-ui.min.js"></script>
<script src="assets\bootstrap\js\bootstrap.min.js"></script>
<script src="assets\plugins\metisMenu\metisMenu.min.js"></script>
<script src="assets\plugins\lobipanel\lobipanel.min.js"></script>
<script src="assets\plugins\animsition\js\animsition.min.js"></script>
<script src="assets\plugins\fastclick\fastclick.min.js"></script>
<script src="assets\plugins\slimScroll\jquery.slimscroll.min.js"></script>
<script src="assets\plugins\toastr\toastr.min.js"></script>
<script src="assets\plugins\sparkline\sparkline.min.js"></script>
<script src="assets\plugins\counterup\jquery.counterup.min.js"></script>
<script src="assets\plugins\counterup\waypoints.js"></script>
<script src="assets\plugins\emojionearea\emojionearea.min.js"></script>
<script src="assets\plugins\monthly\monthly.min.js"></script>
<script src="assets\plugins\amcharts\amcharts.js"></script>
<script src="assets\plugins\amcharts\ammap.js"></script>
<script src="assets\plugins\amcharts\worldLow.js"></script>
<script src="assets\plugins\amcharts\serial.js"></script>
<script src="assets\plugins\amcharts\export.min.js"></script>
<script src="assets\plugins\amcharts\dark.js"></script>
<script src="assets\plugins\amcharts\pie.js"></script>
<script src="assets\dist\js\app.min.js"></script>
<script src="assets\dist\js\page\dashboard_dark.js"></script>
<script src="assets\dist\js\jQuery.style.switcher.min.js"></script>
<!-- STRAT PAGE LABEL PLUGINS -->
<script src="assets\plugins\modals\classie.js" type="text/javascript"></script>
<script src="assets\plugins\modals\modalEffects.js" type="text/javascript"></script>
<script src="assets\plugins\datatables\dataTables.min.js" type="text/javascript"></script>
<script src="assets\plugins\summernote\summernote.js" type="text/javascript"></script>

<!-- START THEME LABEL SCRIPT -->
<script src="assets\dist\js\app.min.js" type="text/javascript"></script>
<script src="assets\dist\js\jQuery.style.switcher.min.js" type="text/javascript"></script>
<script src="assets\plugins\sweetalert\sweetalert.min.js" type="text/javascript"></script>

<script type="text/javascript">

	$(document).ready(function () {

        "use strict"; // Start of use strict


        $("#user_table").DataTable({
            dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            buttons: [
                {extend: 'copy', className: 'btn-sm'},
                {extend: 'csv', title: 'ExampleFile', className: 'btn-sm'},
                {extend: 'excel', title: 'ExampleFile', className: 'btn-sm'},
                {extend: 'pdf', title: 'ExampleFile', className: 'btn-sm'},
                {extend: 'print', className: 'btn-sm'}
            ]
        });

        $("#earnings_table").DataTable({
            dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            buttons: [
                {extend: 'copy', className: 'btn-sm'},
                {extend: 'csv', title: 'ExampleFile', className: 'btn-sm'},
                {extend: 'excel', title: 'ExampleFile', className: 'btn-sm'},
                {extend: 'pdf', title: 'ExampleFile', className: 'btn-sm'},
                {extend: 'print', className: 'btn-sm'}
            ]
        });

        $("#earnings_table2").DataTable({
            dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            buttons: [
                {extend: 'copy', className: 'btn-sm'},
                {extend: 'csv', title: 'ExampleFile', className: 'btn-sm'},
                {extend: 'excel', title: 'ExampleFile', className: 'btn-sm'},
                {extend: 'pdf', title: 'ExampleFile', className: 'btn-sm'},
                {extend: 'print', className: 'btn-sm'}
            ]
        });

        $("#earnings_table3").DataTable({
            dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            buttons: [
                {extend: 'copy', className: 'btn-sm'},
                {extend: 'csv', title: 'ExampleFile', className: 'btn-sm'},
                {extend: 'excel', title: 'ExampleFile', className: 'btn-sm'},
                {extend: 'pdf', title: 'ExampleFile', className: 'btn-sm'},
                {extend: 'print', className: 'btn-sm'}
            ]
        });

        //summernote
        $('#summernote').summernote({
            height: 200, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            // focus: true,                  // set focus to editable area after initializing summernote
            toolbar: [
                [ 'style', [ 'style' ] ],
                [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
                [ 'fontname', [ 'fontname' ] ],
                [ 'fontsize', [ 'fontsize' ] ],
                [ 'color', [ 'color' ] ],
                [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
                [ 'table', [ 'table' ] ],
                [ 'insert', [ 'link'] ],
                [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
            ]
        });

        //summernote
        $('#summernote2').summernote({
            height: 200, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            // focus: true,                  // set focus to editable area after initializing summernote
            toolbar: [
                [ 'style', [ 'style' ] ],
                [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
                [ 'fontname', [ 'fontname' ] ],
                [ 'fontsize', [ 'fontsize' ] ],
                [ 'color', [ 'color' ] ],
                [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
                [ 'table', [ 'table' ] ],
                [ 'insert', [ 'link'] ],
                [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
            ]
        });

        //summernote
        $('#summernote3').summernote({
            height: 200, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            // focus: true,                  // set focus to editable area after initializing summernote
            toolbar: [
                [ 'style', [ 'style' ] ],
                [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
                [ 'fontname', [ 'fontname' ] ],
                [ 'fontsize', [ 'fontsize' ] ],
                [ 'color', [ 'color' ] ],
                [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
                [ 'table', [ 'table' ] ],
                [ 'insert', [ 'link'] ],
                [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
            ]
        });
    });

    
    function checkStatus(id){
        if( document.getElementById("status"+id).value !== "0") {
            if( document.getElementById("status"+id).value == "2" && document.getElementById("remarks"+id).value == "") {
                document.getElementById("remarks"+id).focus();
                alert("Please provide reason for declining!");
                return false;
            }
            confirm("Confirm transaction?");
            return true;
        }
        document.getElementById("status"+id).focus();
        alert("Please update status");
        return false;
    }

    function checkPayment(){
        if(document.getElementById('payment_type').options[document.getElementById('payment_type').selectedIndex].value === ""){
            alert("Please select an option!");
            document.getElementById('payment_type').focus();
            return false;
        }
        confirm("Confirm transaction?");
        return true;
    }

    function checkBank(){
        if(document.getElementById('account_type').options[document.getElementById('account_type').selectedIndex].value === ""){
            alert("Please select an option!");
            document.getElementById('account_type').focus();
            return false;
        }
        return true;
    }

    function checkColor(){
        if(document.getElementById('color').options[document.getElementById('color').selectedIndex].value === ""){
            alert("Please select an option!");
            document.getElementById('color').focus();
            return false;
        }
        return true;
    }

    function logout() {
        event.preventDefault(); // prevent form submit
                swal({
          title: 'Are you sure you want to logout?',
          text: '',
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#DD6B55',
          confirmButtonText: 'Yes!'
        },
        function(){
            swal("Success!", "You have been logged out.", "success");
            setTimeout(function() {
                window.location.href = 'logout.php';
            }, 1500);
            
        });
    }


</script>



