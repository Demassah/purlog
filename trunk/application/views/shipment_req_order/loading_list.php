<script>
	
	var url;
	$(document).ready(function(){

		detailData = function (){
			$('#konten').panel({
				href:base_url+'shipment_req_order/detail'
			});
		}

		checkout = function (){
			$('#konten').panel({
				href:base_url+'shipment_req_order/checkout'
			});
		}
					
		actiondetail = function(value, row, index){
			var col='';
					col += '&nbsp;&nbsp; &nbsp;&nbsp;<a href="#" onclick="detailData(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">UnCheckout</a>';			
			return col;
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
            iconCls:'icon-loading',
            text:'Loading Sheet',
            handler:function(){
              a();
            }
          }              
        ]
      });     
    });
		
	});
</script>

<div id="toolbar_detail" style="padding:5px;height:auto">
	<div class="fsearch">
		<table>
			<tr>
					<td>
							&nbsp;&nbsp;<a href="#" onclick="detailData()" class="easyui-linkbutton" iconCls="icon-detail">List Detail SRO</a>
							&nbsp;&nbsp;<a href="#" onclick="checkout()" class="easyui-linkbutton" iconCls="icon-checkout">Checkout</a>
					</td>							
			</tr>		
		</table>
	</div>
</div>

<table id="dtgrd" title="Loading List Shipment Request Order" data-options="
			rownumbers:true,
			singleSelect:false,
			pagination:true,
			autoRowHeight:false,
			fit:true,
			toolbar:'#toolbar_detail',
		">		
	<thead>
		<tr>
			<th data-options="field:'id_krs_detail',width:'100', hidden:true">aa</th>
			<th field="nama_kategori" sortable="true" width="120">ID Detail ROS</th>
			<th field="kode_barang" sortable="true" width="120">ID ROS</th>
			<th field="kode_barang" sortable="true" width="120">ID Item</th>
			<th field="kode_barang" sortable="true" width="120">Qty</th>
			<th field="nama_sub_kategori" sortable="true" width="600">Deskripsi</th>		
		</tr>
	</thead>
</table>



