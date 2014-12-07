<script>
	
	var url;
	$(document).ready(function(){

		kembali = function (){
			//detail
			$('#konten').panel({
				href: base_url+'request_order_selected/index/'
			});

		}
				
		actiondetail = function(value, row, index){
			var col='';
					col += '&nbsp;&nbsp; &nbsp;&nbsp;<a href="#" onclick="detailData(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Alocate</a>';			
			return col;
		}
		

		$(function(){ // init
			$('#dtgrd').datagrid({url:"request_order_selected/grid"});	
			//$('#dg').datagrid('enableFilter'); 
		});	

			//Bawah
		$(function(){
			var pager = $('#dtgrd').datagrid().datagrid('getPager');	// get the pager of datagrid
			pager.pagination({
				buttons:[
					{
						iconCls:'icon-undo',
						text:'Kembali',
						handler:function(){
							kembali();
						}
					}
				]
			});			
		});
		
	});
</script>

<table id="dtgrd" title="Detail Request Order Selected" data-options="
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
      <th data-options="field:'id_krs_detail',width:'100', hidden:true">aa</th>
      <th field="nama_kategori" sortable="true" width="120">ID Detail</th>
      <th field="kode_barang" sortable="true" width="120">ID RO</th>
      <th field="kode_barang" sortable="true" width="120">ID Item</th>
      <th field="kode_barang" sortable="true" width="120">Qty</th>
      <th field="nama_barang" sortable="true" width="350">Description</th>   
      <th field="action" align="center" formatter="actiondetail" width="140">Aksi</th>
    </tr>
	</thead>
</table>

