<table id="dg" title="Kelola Data Barang" data-options="
			rownumbers:true,
			singleSelect:true,
			autoRowHeight:false,
			pagination:true,
			pageSize:30,
			fit:true,
			">
	<thead>
		<tr>
			<th field="user_id" sortable="true" width="150" hidden="true">ID</th>
			<th field="nama_kategori" sortable="true" width="150">Kategori</th>
			<th field="nama_sub_kategori" sortable="true" width="150">Sub Kategori</th>
			<th field="kode_barang" sortable="true" width="150">Kode Barang</th>
			<th field="nama_barang" sortable="true" width="150">Nama Barang</th>
			<th field="jumlah" sortable="true" width="150">Jumlah</th>
			<th field="action" align="center" formatter="actionbutton" width="100">Aksi</th>
		</tr>
	</thead>
</table>

<!-- AREA untuk Form MENU >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  -->
<div id="dialog-menu" class="easyui-dialog" style="width:400px;height:150px" closed="true" buttons="#dlg-buttons-menu">
	<div id="dlg-buttons-menu">
		<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveMenu()">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dialog-menu').dialog('close')">Cancel</a>
	</div>
</div>
<script type="text/javascript" src="<?=base_url();?>asset/js/modul/ro_logistic/app.js"></script>