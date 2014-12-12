<form id="form1" method="post" style="margin:10px">
	<input type="hidden" name="kode" id="kode" value="<?=$kode?>">
  <div class="fitem" >
    <label style="width:100px">Kategori </label>: 
    <select id="id_kategori" name="id_kategori" style="width:200px;">
          <?=$this->mdl_prosedur->OptionKategori(array('value'=>$id_kategori));?>
      </select> 
  </div>
	<div class="fitem" >
		<label style="width:100px">Sub Kategori </label>:
		<input name="nama_sub_kategori" size="30" value="<?=$nama_sub_kategori?>">
	</div>
	<div class="fitem" hidden="true" >
		<label style="width:120px">Status</label>:
		<input type="checkbox" name="status" <?=$status=='1'?'checked':''?>/> Aktif
	</div>
</form>
	

