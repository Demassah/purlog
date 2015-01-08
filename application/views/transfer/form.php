<script>
	 $(document).ready(function() {
		$(".select").select2();
	});
	 
</script>

<form id="form1" method="post" style="margin:10px">
<input type="hidden" name="kode" id="kode" value="<?=$kode?>">
	<div class="fitem" >
		<label style="width:140px">Tipe Transfer </label>: 
		<select class="easyui-combobox" name="type_transfer" style="width:170px;">
			<option value="">- Pilih -</option>
			<option value="1" <?= $type_transfer == 'Move'?'selected ="selected"':''; ?>>Move</option>
		</select></li>
	</div>
	<div class="fitem" >
		<label style="width:140px;vertical-align:top;">Note </label>:
		<textarea name="note" id="note" cols="30" rows="5"><?=$note?></textarea>
	</div>
	<div class="fitem" >
		<label style="width:140px">Date Create</label>: 
		<input class="easyui-datebox textbox" name="date_create" size="13" value="<?=$date_create?>" id="date_create" data-options="formatter:DateFormatter, parser:DateParser">
	</div>
	<div class="fitem" >
		<label style="width:140px">Requestor</label>: 
		<select  class="easyui-combobox" name="user_id" style="width:170px;">
			<?=$this->mdl_prosedur->OptionUserID(array('value'=>$user_id));?>	          
		</select>
	</div>
	<div class="fitem" >
		<label style="width:140px">Status</label>:
		<input type="checkbox" name="status" <?=$status=='1'?'checked':''?>/> Aktif
	</div>
</form>