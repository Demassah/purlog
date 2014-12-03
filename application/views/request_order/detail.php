
<div id="p" class="easyui-panel" title="Form Detail Item" style="padding:10px;background:#fafafa;" data-options="collapsible:true">
    <form id="form1" method="post" style="margin:10px">
			<input type="hidden" name="kode" id="kode" value="<?=$kode?>">
			<div class="fitem">
				<label style="width:100px">Id Item</label>:
				<input name="id_item" size="15" value="">
			</div>
			<div class="fitem" >
				<label style="width:100px">Item Type</label>: 
				<select id="id_kategori" name="id_kategori" style="width:200px;">
							<?=$this->mdl_prosedur->OptionKategori(array('value'=>$id_kategori));?>
					</select>	
			</div>
			<div class="fitem">
				<label style="width:100px">Item Name</label>:
				<input name="id_item" size="15" value="">
			</div>
			<div class="fitem" >
				<label style="width:100px">Description </label>: 
				<textarea  name="kode_barang"></textarea>
			</div>
		</form>
</div>
<br />
<div id="p" class="easyui-panel" title="Table List Item" style="padding:10px;background:#fafafa;" data-options="collapsible:true">
	<table id="dg" title="Request Order List" data-options="
				rownumbers:true,
				singleSelect:true,
				autoRowHeight:false,
				pagination:true,
				pageSize:30,
				fit:true,
				toolbar:'#toolbar',
				">
		<thead>
			<tr>
				<th field="user_id" sortable="true" width="150" hidden="true">ID</th>
				<th field="id_type" sortable="true" width="150">Id Item</th>
				<th field="item_type" sortable="true" width="150">Item Type</th>
				<th field="item_name" sortable="true" width="150">Item Name</th>
				<th field="description" sortable="true" width="150">Description</th>
				<th field="action" align="center" formatter="actionbutton" width="140">Action</th>
			</tr>
		</thead>
		<!--<thead>
			<tr>
				<th field="id_kategori" sortable="true" width="150" hidden="true">ID</th>
				<th field="nama_kategori" sortable="true" width="350">Kategori</th>
				<th field="action" align="center" formatter="actionbutton" width="100">Aksi</th>
			</tr>
		</thead>-->
	</table>
</div>