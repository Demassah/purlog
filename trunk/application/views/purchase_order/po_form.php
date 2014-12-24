<script>
	// search text combo
		$(document).ready(function(){
			$(".select").select2();
		});
</script>
<?php date_default_timezone_set("Asia/Jakarta");?>
<form id="form1" method="post" style="margin:10px">
	<input type="hidden" name="user_id" value="<?php echo  $this->session->userdata('user_level_id')?>">
	<input type="hidden" name="date_create" value="<?php echo date('Y-m-d H:i:s ');?>">
	<input type="hidden" name="status" value="1">
	<div class="fitem" >
		<label style="width:100px">Departement </label>: 
			<select class="select" name="departement_id" style="width:200px;">
						<option>Pilih</option>
							<?=$this->mdl_prosedur->OptionDepartement(array('value'=>$id_departement));?>
						       
				</select>	
	</div>
	<div class="fitem" >
		<label style="width:100px">Purchase Request</label>: 
			<select class="select" name="id_pr" style="width:200px;">
						<option>Pilih</option>
							<?=$this->mdl_prosedur->OptionPurchaseOrder(array('value'=>$id_pr));?>
						       
				</select>	
	</div>

</form>
	

