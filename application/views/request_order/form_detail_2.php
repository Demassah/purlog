<script>
	 $(document).ready(function() {
		$("#id_ro").select2();
		$("#id_barang").select2();
		$("#user_id").select2();
	});
</script>

<form id="form1" method="post" style="margin:10px">
<input type="hidden" name="kode" id="kode" value="<?=$kode?>">
	<div class="fitem" >
		<label style="width:140px">ID Request Order </label>: 
		<select id="id_ro" name="id_ro" style="width:170px;">
			<?=$this->mdl_prosedur->OptionRO(array('value'=>$id_ro));?>	          
		</select>	
	</div>
	<div class="fitem" >
		<label style="width:140px">Ext Doc No</label>: 
		<input name="ext_doc_no" size="20" value=" ">
	</div>
	<div class="fitem" >
		<label style="width:140px">Nama Barang </label>: 
		<select id="id_barang" name="id_barang" style="width:170px;">
			<?=$this->mdl_prosedur->OptionBarang(array('value'=>$id_barang));?>	          
		</select></li>
	</div>
	<div class="fitem" >
		<label style="width:140px">Qty </label>: 
		<input name="ext_doc_no" size="20" value=" ">
	</div>
	<div class="fitem" >
		<label style="width:140px">Requestor </label>: 
		<select id="user_id" name="user_id" style="width:170px;">
			<?=$this->mdl_prosedur->OptionUserID(array('value'=>$user_id));?>	          
		</select>	
	</div>
	<div class="fitem" >
		<label style="width:140px">Date Create </label>: 
		<input class="easyui-datebox" name="date_create" size="13" value="<?=$date_create?>" id="date_create" data-options="formatter:DateFormatter, parser:DateParser">
	</div>
	<div class="fitem" >
		<label style="width:140px;vertical-align:top;">Description </label>: 
		<textarea name="note" id="note" cols="20" rows="5"><?=$note?></textarea>
	</div>	
	<div class="fitem" >
		<label style="width:140px">Status request</label>: 
		<select id="status" name="status" style="width:170px;">
			<!--<option value="">- Select Status -</option>-->
			<option value="1" <?= $status == '1'?'selected ="selected"':''; ?>>Request</option>
			<!-- <option value="2" <?= $status == '2'?'selected ="selected"':''; ?>>Approve</option>
			<option value="3" <?= $status == '3'?'selected ="selected"':''; ?>>Logistic</option>		 -->
		</select></li>
	</div>
</form>
