<script>
	
	var url;
	$(document).ready(function(){

		back = function (val){
		  //detail
		  $('#konten').panel({
			href: base_url+'purchase_request/index',
		  });

		}
		
		var editIndex = undefined;
		endEditing = function(){
			if (editIndex == undefined){return true}
			if ($('#dtgrd').datagrid('validateRow', editIndex)){
				$('#dtgrd').datagrid('endEdit', editIndex);
				editIndex = undefined;
				return true;
			} else {
				return false;
			}
		}
		
		$(function(){ // init
			$('#dtgrd').datagrid({url:"picking_req_order_selected/grid"});	
			//$('#dg').datagrid('enableFilter'); 
		});	

		//# Tombol Bawah
    $(function(){
      var pager = $('#dtgrd').datagrid().datagrid('getPager'); // get the pager of datagrid
      pager.pagination({
        buttons:[
          {
            iconCls:'icon-undo',
            text:'Kembali',
            handler:function(){
              back();
            }
          }           
        ]
      });     
    });
		
	});
</script>

<table id="dtgrd" title="Detail Purchase Request" data-options="
			rownumbers:true,
			singleSelect:false,
			pagination:true,
			autoRowHeight:false,
			fit:true,
			toolbar:'#toolbar_pending',
		">		
	<thead>
		<tr>
			<th data-options="field:'id_krs_detail',width:'100', hidden:true">aa</th>
			<th field="nama_kategori" sortable="true" width="120">ID Detail ROS</th>
			<th field="kode_barang" sortable="true" width="120">ID ROS</th>
			<th field="kode_barang" sortable="true" width="120">ID Item</th>
			<th field="kode_barang" sortable="true" width="80">Qty</th>
			<th field="nama_sub_kategori" sortable="true" width="665">Deskripsi</th>	
		</tr>
	</thead>
</table>