<script>
	
	var url;
	$(document).ready(function(){

		checkout = function (){
			$('#konten').panel({
				href:base_url+'shipment_req_order/checkout'
			});
		}

		back = function (val){
		  //detail
		  $('#konten').panel({
			href: base_url+'shipment_req_order/index',
		  });
		}

		loadingList = function (){
			$('#konten').panel({
				href:base_url+'shipment_req_order/loadingList'
			});
		}

		Checkbox = function(value, row, index){
			return '<input style="margin-top:2px;" type="checkbox" name="checkbox" id="checkbox" onclick="update_value('+index+', this.checked, \''+row.id_jadwal+'\')" '+(row.chk==true?'checked="checked"':'')+'/>';
		}
		
		$(function(){ // init
			$('#dg').datagrid({url:"picking_req_order_selected/grid"});	
		});	

			//# Tombol Bawah
    $(function(){
      var pager = $('#dg').datagrid().datagrid('getPager'); // get the pager of datagrid
      pager.pagination({
        buttons:[
          {
            iconCls:'icon-checkout',
            text:'Checkout',
            handler:function(){
              a();
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
					<td>
							&nbsp;&nbsp;<a href="#" onclick="checkout()" class="easyui-linkbutton" iconCls="icon-ok">Checkout</a>
							&nbsp;&nbsp;<a href="#" onclick="loadingList()" class="easyui-linkbutton" iconCls="icon-list">Loading List</a>
					</td>							
			</tr>		
		</table>
	</div>
</div>

<table id="dg" title="Detail Shipment Request Order" data-options="
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
			<th field="kode_barang" sortable="true" width="80">Qty</th>
			<th field="nama_sub_kategori" sortable="true" width="600">Deskripsi</th>		
			<th field="chk" width="23" formatter="Checkbox">
				<input style="margin-top:2px;" type="checkbox" name="checkbox" id="checkbox" onclick="update_value('+index+', this.checked, \''+row.id_jadwal+'\')" '+(row.chk==true?'checked="checked"':'')+'/>
			</th>
		</tr>
	</thead>
</table>

