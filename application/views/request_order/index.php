
<div id="toolbar" style="padding:5px;height:auto">
	<div style="margin-bottom:5px">		
	</div>
	<div class="fsearch">
		<table width="500" border="0">
		  <tr>
			<td>Search</td>
			<td>: 
				<select id="search" name=" " style="width:200px;">
						<option>Pilih</option>
						<option>Search 1</option>
            <option>Search 2</option>
            <option>Search 3</option>	
            <option>Search 4</option>              
				</select>	
			</td>
			<td><a href="#" onclick="filter()" class="easyui-linkbutton" iconCls="icon-search">Search</a></td>
		  </tr>
		</table>
	</div>
</div>

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
			<th field="kode_barang" sortable="true" width="100">ID RO</th>
			<th field="nama_kategori" sortable="true" width="130">Requestor</th>
			<th field="nama_sub_kategori" sortable="true" width="120">Departement</th>
			<th field="kode_barang" sortable="true" width="120">Purpose</th>
			<th field="nama_barang" sortable="true" width="120">Cat Request</th>
			<th field="nama_barang" sortable="true" width="100">Ext Document No</th>
			<th field="nama_barang" sortable="true" width="100">ETD</th>
			<th field="nama_barang" sortable="true" width="100">Date Create</th>
			<th field="action" align="center" formatter="actionbutton" width="160">Aksi</th>
		</tr>
	</thead>
</table>


<script type="text/javascript">
	var url;
	$(document).ready(function(){
	
		newData = function (){
			$('#dialog').dialog({
				title: 'Add Request Order',
				width: 380,
				height: 270,
				closed: true,
				cache: false,
				href: base_url+'request_order/add',
				modal: true
			});
			 
			$('#dialog').dialog('open');
			url = base_url+'request_order/save/add';
		}
		// end newData
		
			DetailData = function (val){
			$('#dialog').dialog({
				title: 'Detail Request Order',
				//style:{background:'#d4d4d4'},
				//width: $(window).width() * 0.8,
				//height: $(window).height() * 0.99,
				width: 625,
				height: 600,
				closed: true,
				cache: false,
				href: base_url+'request_order/detail/'+val,
				modal: true
			});
			 
			$('#dialog').dialog('open');
			url = base_url+'request_order/save';
		}
		// end newData
		
		actionbutton = function(value, row, index){
			var col='';
			//if (row.kd_fakultas != null) {
			<?if($this->mdl_auth->CekAkses(array('menu_id'=>14, 'policy'=>'DELETE'))){?>
					col = '<a href="#" onclick="DeleteData(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Delete</a>';
			<?}?>

			<?if($this->mdl_auth->CekAkses(array('menu_id'=>14, 'policy'=>'DETAIL'))){?>
					col += '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#" onclick="DetailData(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Detail</a>';
			<?}?>

					col += '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#" onclick="SendData(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Send</a>';

			//}
			return col;
		}
		
		$(function(){
			$('#dg').datagrid({
				url:base_url + "request_order/grid"
			});
		});

		// search text combo
		$(document).ready(function(){
			$("#search").select2();
		});
		
		//# Tombol Bawah
		$(function(){
			var pager = $('#dg').datagrid().datagrid('getPager');	// get the pager of datagrid
			pager.pagination({
				buttons:[
					<?if($this->mdl_auth->CekAkses(array('menu_id'=>14, 'policy'=>'ADD'))){?>
					{
						iconCls:'icon-add',
						text:'Tambah Data',
						handler:function(){
							newData();
						}
					}
					<?}?>
				]
			});			
		});
		
	});
</script>