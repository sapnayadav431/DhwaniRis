<!-- jQuery  -->

<script src="<?php echo base_url(); ?>assets/plugins/angular/angular.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>	

<script src="<?php echo base_url(); ?>public/js/common.js"></script>	
<script src="<?php echo base_url(); ?>assets/js/detect.js"></script>
<script src="<?php echo base_url(); ?>assets/js/fastclick.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.slimscroll.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.blockUI.js"></script>
<script src="<?php echo base_url(); ?>assets/js/waves.js"></script>
<script src="<?php echo base_url(); ?>assets/js/wow.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.nicescroll.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.scrollTo.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.core.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.app.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2-new.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweet-alert.init.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/magnific-popup/js/jquery.magnific-popup.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/parsleyjs/parsley.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>  

<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>  
<script src="<?php echo base_url(); ?>assets/plugins/clockpicker/js/bootstrap-clockpicker.min.js"></script>
<script src="<?php echo BASE_URL  ?>/public/theme/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dataTables.responsive.min.js" type="text/javascript"></script>  
<script src="<?php echo BASE_URL  ?>/public/theme/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script src="<?php echo base_url(); ?>assets/plugins/select2/js/select2.min.js"></script>
<div id="notifi"></div>


<?php
if (!empty($transform_url)) {
    echo '<script>window.history.pushState("","","' .$transform_url. '");</script>'; //change url after delete current storage
}
if (!empty($error_msg_key)) {
    echo '<script>taskFailed("","' . $error_msg_key . '");</script>';
}
if (!empty($success_msg_key)) {
    echo '<script>taskSuccess("","' . $success_msg_key . '");</script>';
}
?>

<script>
    //set limit order wise
    $(document).ready(function () {
        // choose target dropdown
        var select = $('#limit');
        select.html(select.find('option').sort(function (x, y) {
            // to change to descending order switch "<" for ">"

            return parseInt($(x).val()) > parseInt($(y).val()) ? 1 : -1;
        }));

        $("#limit option").each(function ($index)
        {
            if (typeof ($(this).attr('selected')) != 'undefined') {
                $(this).prop('selected', true);
            }
            // Add $(this).val() to your list
        });


    });

</script>