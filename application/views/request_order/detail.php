<div id="toolbar" style="padding:5px;height:auto">
	<div style="margin-bottom:5px">		
	</div>
	<div class="fsearch">
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
		<select id="id_sub_kategori" name="id_sub_kategori" style="width:200px;">
					<?=$this->mdl_prosedur->OptionSubKategori(array('value'=>$id_sub_kategori, 'id_kategori'=>$id_kategori));?>
			</select>	
	</div>
	<br>
	<div class="fitem" >
		<label style="width:100px">Field </label>: 
		<input name="kode_barang" size="15" value="<?=$jumlah?>">
	</div>
</form>
	</div>
</div>
<div id="toolbar" style="padding:5px;height:auto">
	<div style="margin-bottom:5px">		
	</div>
	<div class="fsearch">
		<table width="500" border="0">
		  <tr>
			<td>Search</td>
			<td>: 
				<input name="#" size="30" value=" ">
			</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;&nbsp;<a href="#" onclick="filter()" class="easyui-linkbutton" iconCls="icon-search">Search</a></td>
		  </tr>
		</table>
	</div>
</div>