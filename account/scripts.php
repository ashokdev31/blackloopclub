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
<script src="assets\plugins\sweetalert\sweetalert.min.js" type="text/javascript"></script>

<script type="text/javascript">

	$(document).ready(function () {

        "use strict"; // Start of use strict

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

        
        $('.toastr2').on("click", function () {
            toastr.success('Link has been copied to clipboard!');
        });

        $('#file_button').click(function(){
	        var file_link = $('#file_button').val();

	        $.ajax({
	            url: 'ajax-actions.php',
	            type: 'post',
	            data: {file_link:file_link},
	            success: function(response){
	            	document.location = response;
	            }
	        });
	    });


        $('#notify_button').click(function(){
	        var row_id = $('#notify_button').val();
	        
	        $.ajax({
	            url: 'ajax-actions.php',
	            type: 'post',
	            data: {row_id:row_id},
	            success: function(response){
	            	$("#notice"+row_id).css("background","#2c3136");
	            }
	        });
	    });

	    $('#mark_all').click(function(){
	        
	        var marked=[];
	        var i = 0;
			$("input:checkbox").each(function(){
			    var $this = $(this);

			    if($this.is(":checked")){
			        marked[i++] = $this.attr("id");
			    }
			});


			$.ajax({
	            url: 'ajax-actions.php',
	            type: 'post',
	            data: {'marked' : marked},
	            success: function(response){
	            	marked.forEach(function(v) {
					    $("#notice"+v).css("background","#2c3136");
					    $("#"+v).prop('checked', false);
					});
	            	
	            }
	        });

	    });

	    $('#unMark_all').click(function(){
	        
	        var unmarked=[];
	        var i = 0;
			$("input:checkbox").each(function(){
			    var $this = $(this);

			    if($this.is(":checked")){
			        unmarked[i++] = $this.attr("id");
			    }
			});


			$.ajax({
	            url: 'ajax-actions.php',
	            type: 'post',
	            data: {'unmarked' : unmarked},
	            success: function(response){
	            	unmarked.forEach(function(v) {
					    $("#notice"+v).css("background","#33383e");
					    $("#"+v).prop('checked', false);
					});
	            	
	            }
	        });

	    });

	    $('#delete_all').click(function(){
	        
	        var deleted =[];
	        var i = 0;
			$("input:checkbox").each(function(){
			    var $this = $(this);

			    if($this.is(":checked")){
			        deleted[i++] = $this.attr("id");
			    }
			});


			$.ajax({
	            url: 'ajax-actions.php',
	            type: 'post',
	            data: {'deleted' : deleted},
	            success: function(response){
	            	deleted.forEach(function(v) {
					    $("#notice"+v).hide();
					    $("#"+v).hide();
					});
	            	
	            }
	        });

	    });

	   
	    // Load more data
	    $('.load-more').click(function(){
	        var row = Number($('#row').val());
	        var allcount = Number($('#all').val());
	        var rowperpage = Number($('#perpage').val());
	        var user_id = $('#user_id').val();
	        row = row + rowperpage;

	        if(row <= allcount){
	            $("#row").val(row);
	            
	            $.ajax({
	                url: 'ajax-actions.php',
	                type: 'post',
	                data: {row:row,rowperpage:rowperpage,user_id:user_id},
	                beforeSend:function(){
	                    $(".load-more").text("Loading...");
	                },
	                success: function(response){

	                    // Setting little delay while displaying new content
	                    setTimeout(function() {
	                        // appending posts after last post with class="post"
	                        $(".post:last").after(response).show().fadeIn("slow");

	                        var rowno = row + rowperpage;

	                        // checking row value is greater than allcount or not
	                        if(rowno > allcount){

	                            // Change the text and background => text("Hide")
	                            $('.load-more').hide();
	                            //$('.load-more').css("background","red");
	                        }else{
	                            $(".load-more").text("Load more");
	                        }
	                    }, 10);

	                }
	            });
	        }

	    });


    });


	function addAmount(){
		document.getElementById("modalAmount").value = document.getElementById('amount').value;
		document.getElementById("modalPin").value = document.getElementById('trans_pin').value;
	}

	function copyRef(){
		var copyText = document.getElementById("refCode");
	  	copyText.select();
	  	document.execCommand("Copy");

	}

	function copyRef2(){
		var copyText = document.getElementById("refCode2");
	  	copyText.select();
	  	document.execCommand("Copy");

	}

	function markRead(message_id){
    	document.getElementById("notify_button").value = message_id;
    	document.getElementById("notify_button").click();
    }

    function downloadFile(file_link){
    	document.getElementById("file_button").value = file_link;
    	document.getElementById("file_button").click();
    }

    function checkType(){
        if( document.getElementById("type").value !== "Select Option") {
            return true;
        }
        document.getElementById("type").focus();
        alert("Please select type");
        return false;
    }

    function checkAccount(){
        if(document.getElementById('bank_info').options[document.getElementById('bank_info').selectedIndex].value === ""){
            alert("Please select an option!");
            document.getElementById('bank_info').focus();
            return false;
        }
        confirm("Confirm transaction?");
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



