<script>
	 $(document).ready(function() {
		$(".select").select2();
	});
	 
</script>

<form id="form1" method="post" style="margin:10px">
<input type="hidden" name="kode" id="kode" value="<?=$kode?>">
	<div class="fitem" >
		<label style="width:140px">Requestor </label>: 
		<select  class="easyui-combobox" name="user_id" style="width:170px;">
			<?=$this->mdl_prosedur->OptionUserID(array('value'=>$user_id));?>	          
		</select>	
	</div>
	<div class="fitem" >
		<label style="width:140px">Purpose </label>: 
		<select class="easyui-combobox" name="purpose" style="width:170px;">
			<option value="">- Pilih -</option>
			<option value="REQUEST" <?= $purpose == 'REQUEST'?'selected ="selected"':''; ?>>Request</option>
			<option value="STOCK" <?= $purpose == 'STOCK'?'selected ="selected"':''; ?>>Stock</option>
		</select></li>
	</div>
	<div class="fitem" >
		<label style="width:140px">Category Request</label>: 
		<select class="easyui-combobox" name="cat_req" style="width:170px;">
			<option value="">- Pilih -</option>
			<option value="ASSET" <?= $cat_req == 'ASSET'?'selected ="selected"':''; ?>>Asset</option>
			<option value="ATK" <?= $cat_req == 'ATK'?'selected ="selected"':''; ?>>ATK</option>
			<option value="SPAREPART" <?= $cat_req == 'SPAREPART'?'selected ="selected"':''; ?>>Spare Part</option>		
			<option value="CETAKAN" <?= $cat_req == 'CETAKAN'?'selected ="selected"':''; ?>>Cetakan</option>		
		</select></li>
	</div>
	<div class="fitem" >
		<label style="width:140px">Ext Doc No</label>: 
		<input name="ext_doc_no" size="20" class="easyui-validatebox textbox" data-options="required:false">
	</div>
	<div class="fitem" >
		<label style="width:140px">ETD </label>: 
		<input class="easyui-datebox textbox" name="ETD" size="13" value="<?=$ETD?>" id="ETD" data-options="formatter:DateFormatter, parser:DateParser">
	</div>
	<div class="fitem" hidden="true" >
		<label style="width:140px">Date Create </label>: 
		<input class="textbox" name="date_create" size="13" value="<?=$date_create?>" id="date_create"  data-options="formatter:DateFormatter, parser:DateParser">
	</div>
	<div class="fitem" hidden="true">
		<label style="width:140px">Status request</label>: 
		<select class="easyui-combobox" name="status" style="width:170px;">
			<!--<option value="">- Select Status -</option>-->
			<option value="1" <?= $status == '1'?'selected ="selected"':''; ?>>Request</option>
			<!-- <option value="2" <?= $status == '2'?'selected ="selected"':''; ?>>Approve</option>
			<option value="3" <?= $status == '3'?'selected ="selected"':''; ?>>Logistic</option>		 -->
		</select></li>
	</div>
</form>