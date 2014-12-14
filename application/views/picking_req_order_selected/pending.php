<script>
	
	var url;
	$(document).ready(function(){
    	var id_ro = <?php echo $id_ro;?>;

		detail = function (val){      
      if(val==null){
          var row = $('#dg_pending').datagrid('getData');              
          var id = id_ro;
          val = id;
      }
			$('#konten').panel({
        href: base_url+'picking_req_order_selected/detail/' + val,
			});
		}

		available = function (val){      
      if(val==null){
          var row = $('#dg_pending').datagrid('getData');              
          var id = id_ro;
          val = id;
      }
      $('#konten').panel({
        href: base_url+'picking_req_order_selected/available/' + val,
      });
    }

		lock = function (val){

      if(val==null){
          var row = $('#dg_pending').datagrid('getData');              
          var id = id_ro;
          val = id;
      }
      $('#konten').panel({
        href: base_url+'picking_req_order_selected/lock/' + val,
      });
		}

		purchase = function (){
			$('#konten').panel({
				href:base_url+'picking_req_order_selected/purchase'
			});
		}
		
		$(function(){ // init
			$('#dg_pending').datagrid({url:"picking_req_order_selected/grid_pending/<?=$id_ro?>"});	
		});	
		
	});
</script>

<div id="toolbar_pending" style="padding:5px;height:auto">
	<div class="fsearch">
		<table>
			<tr>
					<td>&nbsp;&nbsp;<a href="#" onclick="detail()" class="easyui-linkbutton" iconCls="icon-detail">Detail</a>
							&nbsp;&nbsp;<a href="#" onclick="available()" class="easyui-linkbutton" iconCls="icon-ok">Picking</a>
							&nbsp;&nbsp;<a href="#" onclick="lock()" class="easyui-linkbutton" iconCls="icon-login">Lock</a>
							&nbsp;&nbsp;<a href="#" onclick="purchase()" class="easyui-linkbutton" iconCls="icon-purchase-form">Purchase Request</a>
					</td> 
			</tr>
		</table>
	</div>
</div>

<table id="dg_pending" title="Pending Picking Request Order Selected" data-options="
			rownumbers:true,
			singleSelect:true,
			autoRowHeight:false,
			pagination:true,
			pageSize:30,
			fit:true,
			toolbar:'#toolbar_pending',
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


