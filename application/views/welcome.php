<?php 
	$model = new OperationModel();

 
  $message = $this->session->flashdata('messageRegister');
    if ( is_array($message) and !empty ($message)) { 
        
        
                    $today_date       =             $message['today_date'];
                    $first_name       = $message['first_name'];
                    $user_id   =  $message['user_id'];
                    $user_password = $message['user_password'];
        // $this->session->unset_userdata('messageRegister');
    }
    else
    { 
       
        redirect(BASE_PATH.'sign-up');
    }
?>
 
  
  
  <html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
 	body {
		width: 100%;
		margin: 0;
		padding: 0;
		-webkit-font-smoothing: antialiased;
	}
	@media only screen and (max-width: 600px) {
		table[class="table-row"] {
			float: none !important;
			width: 98% !important;
			padding-left: 20px !important;
			padding-right: 20px !important;
		}
		table[class="table-row-fixed"] {
			float: none !important;
			width: 98% !important;
		}
		table[class="table-col"], table[class="table-col-border"] {
			float: none !important;
			width: 100% !important;
			padding-left: 0 !important;
			padding-right: 0 !important;
			table-layout: fixed;
		}
		td[class="table-col-td"] {
			width: 100% !important;
		}
		table[class="table-col-border"] + table[class="table-col-border"] {
			padding-top: 12px;
			margin-top: 12px;
			border-top: 1px solid #E8E8E8;
		}
		table[class="table-col"] + table[class="table-col"] {
			margin-top: 15px;
		}
		td[class="table-row-td"] {
			padding-left: 0 !important;
			padding-right: 0 !important;
		}
		table[class="navbar-row"] , td[class="navbar-row-td"] {
			width: 100% !important;
		}
		img {
			max-width: 100% !important;
			display: inline !important;
		}
		img[class="pull-right"] {
			float: right;
			margin-left: 11px;
            max-width: 125px !important;
			padding-bottom: 0 !important;
		}
		img[class="pull-left"] {
			float: left;
			margin-right: 11px;
			max-width: 125px !important;
			padding-bottom: 0 !important;
		}
		table[class="table-space"], table[class="header-row"] {
			float: none !important;
			width: 98% !important;
		}
		td[class="header-row-td"] {
			width: 100% !important;
		}
	}
	@media only screen and (max-width: 480px) {
		table[class="table-row"] {
			padding-left: 16px !important;
			padding-right: 16px !important;
		}
	}
	@media only screen and (max-width: 320px) {
		table[class="table-row"] {
			padding-left: 12px !important;
			padding-right: 12px !important;
		}
	}
	@media only screen and (max-width: 458px) {
		td[class="table-td-wrap"] {
			width: 100% !important;
		}
	}
	{
	       .brand-text{ position: relative;
    top: 2px;
    font-weight: 300;
    text-transform: uppercase;
	}
  </style>
</head>
<body style="font-family: Arial, sans-serif; font-size:13px; color: #fff; min-height: 200px;" bgcolor="#fff" leftmargin="0" topmargin="0" marginheight="0" marginwidth="0">
<table width="100%" height="100%" bgcolor="#fff" cellspacing="0" cellpadding="0" border="0">
  <tr>
    <td width="100%" align="center" valign="top" bgcolor="#fff" style="background-color:#fff; min-height: 200px;"><table>
        <tr>
          <td class="table-td-wrap" align="center" width="458"><table class="table-space" height="18" style="height: 18px; font-size: 0px; line-height: 0; width: 450px; background-color: #fff;" width="1000" bgcolor="#fff" cellspacing="0" cellpadding="0" border="0">
              <tbody>
                <tr>
                  <td class="table-space-td" valign="middle" height="18" style="height: 18px; width: 450px; background-color: #fff;" width="1000" bgcolor="#fff" align="left">&nbsp;</td>
                </tr>
              </tbody>
            </table>
            <table class="table-space" height="8" style="height: 8px; font-size: 0px; line-height: 0; width: 450px; background-color: #ffffff;" width="1000" bgcolor="#FFFFFF" cellspacing="0" cellpadding="0" border="0">
              <tbody>
                <tr>
                  <td class="table-space-td" valign="middle" height="8" style="height: 8px; width: 450px; background-color: #ffffff;" width="1000" bgcolor="#FFFFFF" align="left">&nbsp;</td>
                </tr>
              </tbody>
            </table><table class="table-row" width="1000" bgcolor="#FFFFFF" style="table-layout: fixed; background-color: #ffffff;" cellspacing="0" cellpadding="0" border="0">
              <tbody>
                <tr>
                  <td class="table-row-td" style="font-family: Arial, sans-serif; line-height: 19px; color: #fff; font-size: 13px; font-weight: normal; padding-left: 36px; padding-right: 36px;" valign="top" align="left"><table class="table-col" align="left" width="1000" cellspacing="0" cellpadding="0" border="0" style="table-layout: fixed;">
                      <tbody>
                        <tr>
                          <td class="table-col-td" style="background: #3c3838;" width="1000" style="font-family: Arial, sans-serif; line-height: 19px; color: #fff; font-size: 13px; font-weight: normal; width: 378px;" valign="top" align="left"><table class="header-row" width="1000" cellspacing="0" cellpadding="0" border="0" style="table-layout: fixed;">
                              <tbody>
                                <tr>
                                    
                                  <td class="header-row-td" width="1000" style="font-family: Arial, sans-serif; font-weight: normal; line-height: 19px; color: #478fca; margin: 0px; font-size: 18px; padding-bottom: 10px; padding-top: 15px;" valign="top" align="left">
								  <img src="<?php echo BASE_PATH.'/upload/system/'.$model->getValue("CONFIG_LOGO");?>" width="400" height="150"  /></td>
                                <td><span>X</span></td>
                                
                                </tr>
                              </tbody>
                            </table>
                            <div style="font-family: Arial, sans-serif; line-height: 20px; color: #fff; font-size: 13px;margin:10px">
<p>Date:  <?php echo $today_date;?> <br />To,

User Name:-  <?php echo  $first_name ;?> <br />
User Id:-  <?php echo  $user_id ;?> <br />

Subject: Welcome Letter & Ragistration Detail<br />

Dear  <?php echo  $first_name;?> ,<br />

I would like to welcome you to <?php echo $model->getValue("CONFIG_COMPANY_NAME"); ?> Company personally. It has been a pleasure to be able to talk to
you about our products and business plan.<br>It is a tremendous honor for us to be working with you.
We are looking forward to doing more business deals with you.
we discussed during our meeting,<br> it can be increased as per our need.
We are very happy to see you with us.<br />
your registration detail is here

<br />
<strong style="color:#92ff1a;">&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;Username:&nbsp;  <?php echo  $user_id;?><br /></strong>
<strong style="color:#92ff1a;">&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; Password:&nbsp;  <?php echo  $user_password;?><br /></strong>
<p style="color:white;">Login URL:- <?php echo $model->getValue("CONFIG_WEBSITE");?> </p>
<br />

Looking forward to a continuous and a fruitful business partnership with us.<br />

Regards,<br />
<?php echo $model->getValue("CONFIG_COMPANY_NAME") ;?> <br />
<p style="color:white;"><?php echo $model->getValue("CONFIG_CMP_EMAIL") ;?> <br /></p>
 <?php echo $model->getValue("CONFIG_MOBILE_NO");?>
</div></td>
                        </tr>
                      </tbody>
                    </table></td>
                </tr>
              </tbody>
            </table>
            
            
            
            
            </td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>