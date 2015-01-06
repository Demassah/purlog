<script>
	$(document).ready(function(){
		$('.sub').hide();
		$('#id_po_re').change(function(){
			var $po_re = $("#id_po_re").val();
			if($po_re==0){
				$('.sub').hide();
			}else{
				$('#id_sub_po_re').load(base_url+'inbound/SubInbound/'+$('#id_po_re').val());
				$('.sub').show();
			}

		});
		
	});
</script>
<?php date_default_timezone_set('Asia/Jakarta');?>
<form id="form1" method="post" style="margin:10px">
	<input type="hidden" name="user_id" value="<?php echo  $this->session->userdata('user_level_id')?>">
	<input type="hidden" name="date_create" value="<?php echo date('Y-m-d H:i:s ');?>">
	<input type="hidden" name="status" value="1">
	<div class="fitem" >
		<label style="width:100px">PO/Return </label>: 
		<select id="id_po_re" name="id_po_re" style="width:200px;">
			<option value="0">--Select--</option>}
			<option value="1">PO</option>
			<option value="2">Return</option>
		</select>
	</div>
	<div class="fitem sub" >
		<label style="width:100px">Id PO/Return </label>: 
		<select id="id_sub_po_re"  name="id_sub_po_re" style="width:200px;">
			<?=$this->mdl_prosedur->OptionInbound();?>
		</select>	
	</div>
</form>
	

