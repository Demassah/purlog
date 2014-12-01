
<table id="dg" title="Kelola Data Barang" data-options="
			rownumbers:true,
			singleSelect:true,
			autoRowHeight:false,
			pagination:true,
			pageSize:30,
			fit:true,
			toolbar:'#toolbar',
			">
	<!-- <thead>
		<tr>
			<th field="picking_id" sortable="true" width="150" hidden="true">ID</th>
			<th field="#" sortable="true" width="150">List 1</th>
			<th field="#" sortable="true" width="250">List 2</th>
			<th field="#" sortable="true" width="200">List 3</th>
			<th field="#" sortable="true" width="350">List 4</th>
			<th field="#" sortable="true" width="250">List 5</th>
			<th field="action" align="center" formatter="actionbutton" width="140">Aksi</th>
		</tr>
	</thead> -->
	<thead>
		<tr>
			<th field="id_kategori" sortable="true" width="150" hidden="true">ID</th>
			<th field="nama_kategori" sortable="true" width="350">Kategori</th>
			<th field="action" align="center" formatter="actionbutton" width="100">Aksi</th>
		</tr>
	</thead>
</table>
<div id="toolbar" style="padding:5px;height:auto">
	<div style="margin-bottom:5px">		
	</div>
	<div class="fsearch">
		<table width="500" border="0">
		  <tr>
			<td>ROS</td>
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

<!-- AREA untuk Form MENU >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  -->
<div id="dialog-menu" class="easyui-dialog" style="width:400px;height:150px" closed="true" buttons="#dlg-buttons-menu">
<div id="dlg-buttons-menu">
	<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveMenu()">Save</a>
	<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dialog-menu').dialog('close')">Cancel</a>
</div>

<script type="text/javascript" src="<?=base_url();?>asset/js/modul/pros/pros.js"></script>