<script type="text/javascript">
	var BASE_PATH = "<?php echo BASE_PATH ?>";
</script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="<?php echo BASE_PATH; ?>theme/js/jquery1.12.4.jquery.min.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script type="text/javascript"
        src="http://maps.google.com/maps/api/js?key=AIzaSyAOBKD6V47-g_3opmidcmFapb3kSNAR70U"></script> 
 
<script type="text/javascript" src="<?php echo BASE_PATH; ?>theme/js/jquery.themepunch.tools.min.js?rev=5.0"></script> 
<script type="text/javascript" src="<?php echo BASE_PATH; ?>theme/js/jquery.themepunch.revolution.min.js?rev=5.0"></script> 
<script type="text/javascript" src="<?php echo BASE_PATH; ?>theme/js/revolution.extension.layeranimation.min.js"></script> 
<script type="text/javascript" src="<?php echo BASE_PATH; ?>theme/js/revolution.extension.navigation.min.js"></script> 
<script type="text/javascript" src="<?php echo BASE_PATH; ?>theme/js/revolution.extension.parallax.min.js"></script> 
<script type="text/javascript" src="<?php echo BASE_PATH; ?>theme/js/revolution.extension.slideanims.min.js"></script> 
<script type="text/javascript" src="<?php echo BASE_PATH; ?>theme/js/revolution.extension.video.min.js"></script> 
<script type="text/javascript" src="<?php echo BASE_PATH; ?>theme/js/revolution.extension.actions.min.js"></script> 
<script src="<?php echo BASE_PATH; ?>theme/js/bootstrap.min.js"></script> 
<script src="<?php echo BASE_PATH; ?>theme/js/jquery.responsiveTabs.min.js"></script> 
<script src="<?php echo BASE_PATH; ?>theme/js/owl.carousel.min.js"></script> 
<script src="<?php echo BASE_PATH; ?>theme/js/jquery.fancybox.pack.js"></script> 
<script src="<?php echo BASE_PATH; ?>theme/js/jquery.fancybox-thumbs.js"></script> 
<script src="<?php echo BASE_PATH; ?>theme/js/wow.js"></script> 
<script src="<?php echo BASE_PATH; ?>theme/js/script.js"></script> 
<?php jquery_validation(); ?> 
<script>
// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
        document.getElementById("myBtn").style.display = "block";
    } else {
        document.getElementById("myBtn").style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
$(function(){
	$(".contact-form").validationEngine();
	$("#form-signin").validationEngine(
		{onValidationComplete: function(form, valid){
            if (valid) {
				$("#register_button").hide();
				$("#ajax_loading").html('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i> Processing please wait....');
				
				var URL_EEGISTER = "<?php echo generateForm("user","registerajax",""); ?>";
				$.getJSON(URL_EEGISTER,$("#form-signin").serialize(),function(JsonEval){
					if(JsonEval){
					
						if(JsonEval.ErrorMsg!=''){
						
							switch(JsonEval.ErrorMsg){
								case "success":
								
								//	$("#register_message").html('processing...');
									 // $("#mem_id").html(JsonEval.mem_id);
									  //$("#pass").html(JsonEval.pass);
									 alert("New User Added successfully ! ");
										$("#register_message").show();
										$("#register_message").html(JsonEval.ErrorDtl);
											$("#ajax_loading").hide();
				window.location.href='<?php echo BASE_PATH; ?>sign-up';
									//  $('#rset').trigger('click');
								break;
								case "warning":
								
									$("#register_message").show();
										$("#register_message").show();
									$("#register_message").html(JsonEval.ErrorDtl);
									$("#ajax_loading").html('');
									$("#register_button").show();
								break;
							}
						}
						else{
						
							$("#register_message").show();
							$("#register_message").html('Please enter all valid fields');
							$("#ajax_loading").html('');
							$("#register_button").show();
						}
					}else{
					
						$("#register_message").show();
						$("#register_message").html('Please enter all valid fields');
						$("#ajax_loading").html('');
						$("#register_button").show();
					}
				});
            }
        }}
	);
	
	
	
	$("#spr_user_id").on('blur',function(){
			var URL_SPR = "<?php echo BASE_PATH; ?>json/jsonhandler";
			var spr_user_id = $("#spr_user_id").val();
			$.getJSON(URL_SPR,{switch_type:"CHECKUSR",spr_user_id:spr_user_id},function(JsonEval){
				if(JsonEval){
					if(JsonEval.member_id>0){
						$("#spr_full_name").val(JsonEval.full_name);
						$("#ajax_loading").html('<div class="alert alert-success"> Sponsor validated ! </div>');
					}else{
						$("#spr_full_name").val('');
						$("#ajax_loading").html('<div class="alert alert-warning"> Invalid sponsor ! </div>');
						return  false;
					}
				}else{
					$("#spr_full_name").val('');
					$("#ajax_loading").html('<div class="alert alert-warning"> Invalid sponsor ! </div>');
					return false;
				}
			});
	});

});
</script>