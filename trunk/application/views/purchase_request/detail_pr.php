<script>
	
	var url;
	$(document).ready(function(){

		purchase = function (){
      $('#konten').panel({
        href:base_url+'picking_req_order_selected/purchase'
      });
    }

		back = function (){
      $('#konten').panel({
        href:base_url+'purchase_request/index'
      });
    }
		
		
		$(function(){ // init
      $('#dg_detail').datagrid({url:"purchase_request/grid_detail/<?=$id_pr?>"});  
		});	

		 //# Tombol Bawah
    $(function(){
      var pager = $('#dg_detail').datagrid().datagrid('getPager'); // get the pager of datagrid
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

<table id="dg_detail" title ="Detail Purchase Request" data-options="
			rownumbers:true,
			singleSelect:false,
			pagination:true,
			autoRowHeight:false,
			fit:true,
			toolbar:'#toolbar_pending',
		">		
	<thead>
		<tr>
			<th field="id_detail_ro" sortable="true" width="150" hidden="true">ID</th>
      <th field="id_ro" sortable="true" width="130">ID Request Order</th>
      <th field="ext_doc_no" sortable="true" width="120">External Doc No</th>
      <th field="nama_barang" sortable="true" width="120">Nama Barang</th>
      <th field="qty" sortable="true" width="120">Qty</th>
      <th field="full_name" sortable="true" width="130">Requestor</th>
      <th field="date_create" sortable="true" width="130">Date Create</th>
      <th field="note" sortable="true" width="200">Note</th>
		</tr>
	</thead>
</table>

