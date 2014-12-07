<script>
	
	var url;
	$(document).ready(function(){

		receive = function (){
			$('#konten').panel({
				href:base_url+'delivered/receive'
			});
		}
				
		actiondetail = function(value, row, index){
			var col='';
					col += '<a href="#" onclick="detailData(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Submit</a>';			
			return col;
		}

		text = function(value, row, index){
			return '<input name="menu_name" size="30" value=" ">';
		}
		

		$(function(){ // init
			$('#dtgrd').datagrid({url:"delivered/grid"});	
			//$('#dg').datagrid('enableFilter'); 
		});	
		
	});
</script>

<table id="dtgrd" data-options="
			rownumbers:true,
			singleSelect:false,
			autoRowHeight:false,
			fit:true,
			toolbar:'#toolbar_dd',
		">		
	<thead>
		<tr>
			<th data-options="field:'id_krs_detail',width:'100', hidden:true">aa</th>
			<th field="nama_kategori" sortable="true" width="120">ID Request Order</th>
			<th field="kode_barang" sortable="true" width="100">ID Ext Document</th>
			<th field="kode_barang" sortable="true" width="100">ID Barang</th>
			<th field="nama_sub_kategori" sortable="true" width="120">Nama Barang</th>
			<th field="kode_barang" sortable="true" width="50">Qty</th>
			<th field="kode_barang" sortable="true" width="100">Requestor </th>
			<th field="kode_barang" sortable="true" width="100">Date Create</th>
			<th field="kode_barang" sortable="true" width="100">Note</th>	
			<th field="text" align="center" width="75" formatter="text">Qty</th>		
			<th field="action" align="center" formatter="actiondetail" width="80">Aksi</th>
		</tr>
	</thead>
</table>


