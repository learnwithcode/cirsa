
  <?php  $model = new OperationModel();
  	$member_id = $this->session->userdata('mem_id');
   $segment = $this->uri->segment(2);
 $memberdetail   = $model->getMemberdetail($member_id); 
 $a2 = $this->uri->segment(2);
$a3 = $this->uri->segment(3); 
  //PRintR($segment);
  ?>  
  
  

        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="#" target="_blank"><?php echo $model->getValue("CONFIG_COMPANY_NAME"); ?></a> 2025</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

		<!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    
    
    
      <script src="<?php echo BASE_PATH; ?>userassets/vendor/global/global.min.js"></script>
	<script src="<?php echo BASE_PATH; ?>userassets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
	<script src="<?php echo BASE_PATH; ?>userassets/vendor/chart-js/chart.bundle.min.js"></script>
     <script src="<?php echo BASE_PATH; ?>userassets/js/custom.min.js"></script>
	<script src="<?php echo BASE_PATH; ?>userassets/js/deznav-init.js"></script>
	<script src="<?php echo BASE_PATH; ?>userassets/vendor/bootstrap-datetimepicker/js/moment.js"></script>
	<script src="<?php echo BASE_PATH; ?>userassets/vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
	<!-- Chart piety plugin files -->
       <script src="<?php echo BASE_PATH; ?>userassets/vendor/peity/jquery.peity.min.js"></script>
	
	<!-- Apex Chart -->
	<script src="<?php echo BASE_PATH; ?>userassets/vendor/apexchart/apexchart.js"></script>
	
	<!-- Dashboard 1 -->
	<script src="<?php echo BASE_PATH; ?>userassets/js/dashboard/dashboard-1.js"></script>
	<script>
		$(function () {
			$('#datetimepicker1').datetimepicker({
				inline: true,
			});
		});
	</script>
	
	
</body>

</html>         