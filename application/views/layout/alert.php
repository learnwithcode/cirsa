    <div style ="display:none;">
   <button type="button" class="btn btn-outline-success mr-1 mb-1" id="type-success1">
          Success
        </button>
		
		<button type="button" class="btn btn-outline-info mr-1 mb-1" id="type-info1">
          Info
        </button>
		
		<button type="button" class="btn btn-outline-warning mr-1 mb-1" id="type-warning1">
          Warning
        </button>
		
		<button type="button" class="btn btn-outline-danger mr-1 mb-1" id="type-error1">
          Error
        </button>
		
		<input type="text" id ="textReturn" value="ddddd">
 </div>
    <script src="<?php echo BASE_PATH;?>assets_new/vendors/js/vendors.min.js"></script> 
    <script src="<?php echo BASE_PATH;?>assets_new/vendors/js/extensions/sweetalert2.all.min.js"></script>
    <script src="<?php echo BASE_PATH;?>assets_new/vendors/js/extensions/polyfill.min.js"></script> 
    <script src="<?php echo BASE_PATH;?>assets_new/js/scripts/customizer.min.js"></script>    
    <script src="<?php echo BASE_PATH;?>assets_new/js/scripts/extensions/sweet-alerts.min.js"></script>
 
  <script>  
  
  $(document).ready((function(){

	 $("#type-success1").on("click",(function(){
	   var  getText = document.getElementById("textReturn").value;
	 Swal.fire({title:"Success",text:getText,type:"success",confirmButtonClass:"btn btn-success",buttonsStyling:!1})})) ,
	   
						   $("#type-info1").on("click",(function(){
						     var  getText = document.getElementById("textReturn").value;
						   Swal.fire({title:"Info!",text:getText,type:"info",confirmButtonClass:"btn btn-info",buttonsStyling:!1})})),
						   
						   $("#type-warning1").on("click",(function(){
						     var  getText = document.getElementById("textReturn").value;
						   Swal.fire({title:"Warning!",text:getText,type:"warning",confirmButtonClass:"btn btn-warning",buttonsStyling:!1})})),$("#type-error1").on("click",(function(){
						   
						     var  getText = document.getElementById("textReturn").value;
						   Swal.fire({title:"Error!",text:getText,type:"error",confirmButtonClass:"btn btn-danger",buttonsStyling:!1})}))
	 }));
	
	</script>