<script>
	var url;
	$(document).ready(function(){
		
		actionbutton = function(value, row, index){
			var col;
			//if (row.kd_fakultas != null) {
				col = '<a href="#" onclick="editData(\''+row. 	id_sub_kategori+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Edit</a>';
				col += '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#" onclick="deleteData(\''+row. 	id_sub_kategori+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Delete</a>';
			//}
			return col;
		}
		
		$(function(){
			$('#dg').datagrid({
				url:"<?=base_url()?>soh/grid"
			});
		});

		// filter
		filter = function(){
			$('#dg').datagrid('load',{
				kode_barang : $('#s_kode_barang').val(),
			});
			//$('#dg').datagrid('enableFilter');
		}
		
	});
</script>

<div id="toolbar" style="padding:5px;height:auto">
	<div style="margin-bottom:5px">
		
	</div>
	<div class="fsearch">
		<table width="500" border="0">
		  <tr>
			<td>Barang</td>
				<td>: 
					<select id="s_kode_barang" name="s_kode_barang" style="width:200px;">
						<?=$this->mdl_prosedur->OptionBarangs();?>
					</select>
				</td>			
				<td><a href="#" onclick="filter()" class="easyui-linkbutton" iconCls="icon-search">Filter</a></td>
		  </tr>
		</table>
	</div>
</div>

<table id="dg" title="Stock On Hand" data-options="
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
			<th field="id_stock" sortable="true" width="100">ID Stock</th>
			<th field="kode_barang" sortable="true" width="120">Kode Barang</th>
			<th field="nama_barang" sortable="true" width="150">Nama Barang</th>
			<th field="qty" sortable="true" width="80">Qty</th>
			<th field="price" sortable="true" width="120">Harga</th>
			<th field="id_lokasi" sortable="true" width="120">Lokasi</th>
			<!-- <th field="action" align="center" formatter="actionbutton" width="100">Aksi</th> -->
		</tr>
	</thead>
</table>