<?php // $invoicePage = $this->uri->segment(3);if($invoicePage !='invoice'){?>

 <div class="pageheader">

                       
                        <div class="page-bar">

                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="#"><i class="fa fa-home"></i> Home</a>
                                </li>
                                <li>
                                    <a href="#"><?php echo $this->router->fetch_method(); ?></a>
                                </li>
                            </ul>

                            <div class="page-toolbar">
                                <a role="button" tabindex="0" class="btn btn-lightred no-border pickDate">
                                    <i class="fa fa-calendar"></i>&nbsp;&nbsp;<span></span>&nbsp;&nbsp;<i class="fa fa-angle-down"></i>
                                </a>
                            </div>

                        </div>

                    </div>
 <?php //} ?>


