<!DOCTYPE html>
<html>
<title>Administrator | School Policies</title>
<?php include 'GFSSIS_G_Head.php'; ?>

<body>
<section>
	<?php include 'GFSSIS_A_Header.php'; ?>
    <?php include 'GFSSIS_A_LeftNavigation.php';?>
    <?php include 'GFSSIS_G_Modals.php'; ?>


    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
        	<div class="row">
	            <div class="col-lg-12">
	                <section class="panel">
	                    <header class="panel-heading">
	                        Policies Setup
	                    </header>
	                    <div class="panel-body">
	                        <form class="form-horizontal bucket-form" method="get">
	                            <div class="form-group">
	                            	<div class="col-sm-1"></div>
	                                <div class="col-sm-10">
	                                    <textarea class="form-control" rows="20"></textarea>
	                                </div>
	                            </div>
	                            <div class="col-lg-7"></div>
				                    <div class="col-lg-5">
				                    	<a href="#saveModal" data-toggle="modal">
				                    		<button type="button" class="btn btn-success"><i class="fa fa-plus-square"></i> Save </button>
				                    	</a>
	                       				<button type="button" class="btn btn-info "><i class="fa fa-refresh"></i> Update</button>
	                       				<button type="button" class="btn btn-danger "><i class="fa fa-ban"></i> Cancel</button>
				                    </div>
	                        </form>
	                    </div>
	                </section>
	            </div>
        	</div>
        </section>
    </section>
</section>



<!-- Placed js at the end of the document so the pages load faster -->
<?php include 'GFSSIS_G_JScript.php';?>

</body>
</html>
