<script>
	
	var url;
	$(document).ready(function(){

		detail = function (val){      
      if(val==null){
          var row = $('#dg_lock').datagrid('getData');              
          var id = row.rows[0].id_ro;
          val = id;
      }
			$('#konten').panel({
        href: base_url+'picking_req_order_selected/detail/' + val,
			});
		}

		available = function (val){      
      if(val==null){
          var row = $('#dg_lock').datagrid('getData');              
          var id = row.rows[0].id_ro;
          val = id;
      }
      $('#konten').panel({
        href: base_url+'picking_req_order_selected/available/' + val,
      });
    }

		pending = function (val){
       if(val==null){
          var row = $('#dg_lock').datagrid('getData');              
          var id = row.rows[0].id_ro;
          val = id;
      }
      $('#konten').panel({
        href: base_url+'picking_req_order_selected/pending/' + val,
      });
		}

		purchase = function (){
			$('#konten').panel({
				href:base_url+'picking_req_order_selected/purchase'
			});
		}
				
		var editIndex = undefined;
		endEditing = function(){
			if (editIndex == undefined){return true}
			if ($('#dg_lock').datagrid('validateRow', editIndex)){
				$('#dg_lock').datagrid('endEdit', editIndex);
				editIndex = undefined;
				return true;
			} else {
				return false;
			}
		}
		
			
		$(function(){ // init
			$('#dg_lock').datagrid({url:"picking_req_order_selected/grid_lock/<?=$id_ro?>"});	
		});	
		
		
	});
</script>

<div id="toolbar_lock" style="padding:5px;height:auto">
	<div class="fsearch">
		<table>
			<tr>
					<td>&nbsp;&nbsp;<a href="#" onclick="detail()" class="easyui-linkbutton" iconCls="icon-detail">Detail</a>
							&nbsp;&nbsp;<a href="#" onclick="available()" class="easyui-linkbutton" iconCls="icon-ok">Picking</a> 
							&nbsp;&nbsp;<a href="#" onclick="pending()" class="easyui-linkbutton" iconCls="icon-redo">Pending</a>
							&nbsp;&nbsp;<a href="#" onclick="purchase()" class="easyui-linkbutton" iconCls="icon-purchase-form">Purchase Request</a>
					</td> 
			</tr>
		</table>
	</div>
</div>


<table id="dg_lock" title="Lock Picking Request Order Selected" data-options="
			rownumbers:true,
			singleSelect:true,
			autoRowHeight:false,
			pagination:true,
			pageSize:30,
			fit:true,
			toolbar:'#toolbar_lock',
		">		
	 <thead>
    <tr>
      <th field="id_detail_ros" sortable="true" width="150" hidden="true">ID</th>
      <th field="id_ro" sortable="true" width="130">ID ROS</th>
      <th field="kode_barang" sortable="true" width="120">ID Barang</th>
      <th field="nama_barang" sortable="true" width="130">Nama Barang</th>
      <th field="qty" sortable="true" width="120">Qty</th>
      <th field="note" sortable="true" width="130">Deskripsi</th>
    </tr>
  </thead>
</table>

