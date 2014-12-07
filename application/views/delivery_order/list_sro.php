<script>
	
	var url;
	$(document).ready(function(){

		detailDO = function (){
			$('#konten').panel({
				href: base_url+'delivery_order/detail',
			});
		}

		detailSROlist = function (){
			$('#konten').panel({
				href: base_url+'delivery_order/detailSROlist',
			});
		}
		
		actiondetail = function(value, row, index){
			var col='';
					col += '<a href="#" onclick="detailSROlist(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Detail</a>';			
			return col;
		}

		Checkbox = function(value, row, index){
			return '<input style="margin-top:2px;" type="checkbox" name="checkbox" id="checkbox" onclick="update_value('+index+', this.checked, \''+row.id_jadwal+'\')" '+(row.chk==true?'checked="checked"':'')+'/>';
		}
		

		$(function(){ // init
			$('#dtgrd').datagrid({url:"delivery_order/grid"});	
			//$('#dg').datagrid('enableFilter'); 
		});	
		
	});
</script>

<table id="dtgrd" data-options="
			rownumbers:true,
			singleSelect:false,
			autoRowHeight:false,
			fit:true,
			toolbar:'#toolbar_list_sro',
		">		
	<thead>
		<tr>
			<th field="user_id" sortable="true" width="150" hidden="true">ID</th>
			<th field="nama_barang" sortable="true" width="100">ID SRO</th>
			<th field="nama_barang" sortable="true" width="100">ID ROS</th>
			<th field="nama_kategori" sortable="true" width="110">Requestor</th>
			<th field="nama_sub_kategori" sortable="true" width="100">Departement</th>
			<th field="kode_barang" sortable="true" width="100">Purpose</th>
			<th field="nama_barang" sortable="true" width="120">Cat Request</th>
			<th field="nama_barang" sortable="true" width="100">Ext Document No</th>
			<th field="nama_barang" sortable="true" width="100">ETD</th>
			<th field="nama_barang" sortable="true" width="100">Date Create</th>	
			<th field="action" align="center" formatter="actiondetail" width="80">Aksi</th>
			<th field="chk" width="23" formatter="Checkbox">
				<input style="margin-top:2px;" type="checkbox" name="checkbox" id="checkbox" onclick="update_value('+index+', this.checked, \''+row.id_jadwal+'\')" '+(row.chk==true?'checked="checked"':'')+'/>
			</th>
		</tr>
	</thead>
</table>
<div id="toolbar_list_sro" style="padding:5px;height:auto">
	<div>
		<table>
			<tr> 
				<td>
						<label style="width:120px">SRO </label>:

						<select id="#" name="#" style="width:200px;">
						</select>
						&nbsp;&nbsp;<a href="#" onclick="filter()" class="easyui-linkbutton" iconCls="icon-all">Add All</a>
				</td>
			</tr>			
		</table>
	</div>
</div>


