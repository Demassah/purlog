<script>
	
	var url;
	$(document).ready(function(){

		receive = function (){
			$('#dialog').dialog({
				title: 'Receive Barang SRO',
				//style:{background:'#d4d4d4'},
				width: $(window).width() * 0.8,
				height: $(window).height() * 0.99,
				closed: true,
				cache: false,
				href: base_url+'delivered/receive/',
				modal: true
			});
			 
			$('#dialog').dialog('open');
			url = base_url+'pros/save';
		}
				
		actiondetail = function(value, row, index){
			var col='';
					col += '&nbsp;&nbsp; &nbsp;&nbsp;<a href="#" onclick="detailData(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Submit</a>';			
					//col += '&nbsp;&nbsp; | &nbsp;&nbsp;<a href="#" onclick="detailData(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Pending</a>';			
					//col += '&nbsp;&nbsp; | &nbsp;&nbsp;<a href="#" onclick="detailData(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Received</a>';			
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
			toolbar:'#toolbar_detail',
		">		
	<thead>
		<tr>
			<th data-options="field:'id_krs_detail',width:'100', hidden:true">aa</th>
			<th field="nama_kategori" sortable="true" width="120">ID Request Order</th>
			<th field="kode_barang" sortable="true" width="100">ID Ext Document</th>
			<th field="kode_barang" sortable="true" width="120">ID Barang</th>
			<th field="nama_sub_kategori" sortable="true" width="120">Nama Barang</th>
			<th field="kode_barang" sortable="true" width="50">Qty</th>
			<th field="kode_barang" sortable="true" width="100">Requestor </th>
			<th field="kode_barang" sortable="true" width="100">Date Create</th>
			<th field="kode_barang" sortable="true" width="100">Note</th>	
			<th field="text" align="center" width="75" formatter="text">Qty</th>		
			<th field="action" align="center" formatter="actiondetail" width="120">Aksi</th>
		</tr>
	</thead>
</table>
<div id="toolbar_detail" style="padding:5px;height:auto">
	<div>
		<table>	
			<tr> 
				<td>
						&nbsp;&nbsp;<a href="#" onclick="receive()" class="easyui-linkbutton" iconCls="icon-ok">Receive</a>
				</td>
			</tr>			
		</table>
	</div>
</div>


