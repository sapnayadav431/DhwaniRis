<div class="col-md-12 padding-0 " style="padding:10px 0px 0px 10px !important">
		<h3 class="pageHeading"> 
			<?php echo $_SESSION['module_action_title']; ?>
		</h3>
</div>
<br>

<?php
if($this->session->flashdata('dup_msg')){
?>

<div class="col-xs-12">
<br>   
   <div class="alert alert-<?php echo empty($hasError)?'success':'danger'; ?>">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        <ul class="margin-bottom-none padding-0" style="list-style-position:inside;">
            <?php           
                echo '<li>'.$this->session->flashdata('dup_msg').'</li>';            
            ?>
        </ul>
        
      </div>
  </div>
  <?php } ?>
