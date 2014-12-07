<script>
	
	var url;
	$(document).ready(function(){

		available = function (){
			$('#konten').panel({
				href: base_url+'picking_req_order_selected/available',
			});
		}

		lock = function (){
			$('#konten').panel({
				href:base_url+'picking_req_order_selected/lock'
			});
		}

		pending = function (){
			$('#konten').panel({
				href:base_url+'picking_req_order_selected/pending'
			});
		}

		purchase = function (){
			$('#konten').panel({
				href:base_url+'picking_req_order_selected/purchase'
			});
		}
		
		back = function (val){
		  //detail
		  $('#konten').panel({
			href: base_url+'picking_req_order_selected/index',
		  });

		}

		actiondetail = function(value, row, index){
			var col='';
					col += '<a href="#" onclick="detailData(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Alocate</a>';			
			return col;
		}
		
		$(function(){ // init
			$('#dtgrd').datagrid({url:"picking_req_order_selected/grid"});	
		});	

		//# Tombol Bawah
    $(function(){
      var pager = $('#dtgrd').datagrid().datagrid('getPager'); // get the pager of datagrid
      pager.pagination({
        buttons:[
          {
            iconCls:'icon-all',
            text:'Alocate All',
            handler:function(){
              add();
            }
          },
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

<div id="toolbar_detail" style="padding:5px;height:auto">
	<div class="fsearch">
		<table>
			<tr>
					<td>&nbsp;&nbsp;<a href="#" onclick="available()" class="easyui-linkbutton" iconCls="icon-ok">Picking</a>
							&nbsp;&nbsp;<a href="#" onclick="lock()" class="easyui-linkbutton" iconCls="icon-login">Lock</a>
							&nbsp;&nbsp;<a href="#" onclick="pending()" class="easyui-linkbutton" iconCls="icon-redo">Pending</a>
							&nbsp;&nbsp;<a href="#" onclick="purchase()" class="easyui-linkbutton" iconCls="icon-purchase-form">Purchase Request</a>
					</td> 
			</tr>			
		</table>
	</div>
</div>

<table id="dtgrd" title="Detail Picking Request Order Selected" data-options="
		rownumbers:true,
		singleSelect:true,
		autoRowHeight:false,
		pagination:true,
		pageSize:30,
		fit:true,
		toolbar:'#toolbar_detail',
		">		
	<thead>
		<tr>
			<th data-options="field:'id_krs_detail',width:'100', hidden:true">aa</th>
			<th field="nama_kategori" sortable="true" width="120">ID Detail ROS</th>
			<th field="kode_barang" sortable="true" width="120">ID ROS</th>
			<th field="kode_barang" sortable="true" width="120">ID Item</th>
			<th field="kode_barang" sortable="true" width="80">Qty</th>
			<th field="nama_sub_kategori" sortable="true" width="505">Deskripsi</th>	
			<th field="action" align="center" formatter="actiondetail" width="80">Aksi</th>
		</tr>
	</thead>
</table>



