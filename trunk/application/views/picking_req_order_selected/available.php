<script>
	
	var url;
	$(document).ready(function(){

		detail = function (){
			$('#konten').panel({
				href: base_url+'picking_req_order_selected/detail',
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
		
		actionAvailable = function(value, row, index){
			var col='';
					col += '<a href="#" onclick="detailData(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">ReAlocate</a>';		
			return col;
		}

		Checkbox = function(value, row, index){
			return '<input style="margin-top:2px;" type="checkbox" name="checkbox" id="checkbox" onclick="update_value('+index+', this.checked, \''+row.id_jadwal+'\')" '+(row.chk==true?'checked="checked"':'')+'/>';
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
            iconCls:'icon-all',
            text:'ReAlocate All',
            handler:function(){
              a();
            }
          },
          {
            iconCls:'icon-login',
            text:'Lock SRO',
            handler:function(){
              b();
            }
          },
          {
            iconCls:'icon-print',
            text:'Print Picklist',
            handler:function(){
              c();
            }
          }              
        ]
      });     
    });
		
		
	});
</script>

<div id="toolbar_available" style="padding:5px;height:auto">
	<div class="fsearch">
		<table>
			<tr>
					<td>&nbsp;&nbsp;<a href="#" onclick="detail()" class="easyui-linkbutton" iconCls="icon-detail">Detail</a> 
							&nbsp;&nbsp;<a href="#" onclick="lock()" class="easyui-linkbutton" iconCls="icon-login">Lock</a> 
							&nbsp;&nbsp;<a href="#" onclick="pending()" class="easyui-linkbutton" iconCls="icon-redo">Pending</a>
							&nbsp;&nbsp;<a href="#" onclick="purchase()" class="easyui-linkbutton" iconCls="icon-purchase-form">Purchase Request</a>
					</td> 
			</tr>
		</table>
	</div>
</div>

<table id="dtgrd" title="Available Picking Request Order Selected" data-options="
		rownumbers:true,
		singleSelect:true,
		autoRowHeight:false,
		pagination:true,
		pageSize:30,
		fit:true,
		toolbar:'#toolbar_available',
		">		
	<thead>
		<tr>
			<th data-options="field:'id_krs_detail',width:'100', hidden:true">aa</th>
			<th field="nama_kategori" sortable="true" width="120">ID Detail ROS</th>
			<th field="kode_barang" sortable="true" width="120">ID ROS</th>
			<th field="kode_barang" sortable="true" width="120">ID Item</th>
			<th field="kode_barang" sortable="true" width="80">Qty</th>
			<th field="nama_sub_kategori" sortable="true" width="450">Deskripsi</th>	
			<th field="action" align="center" formatter="actionAvailable" width="160">Aksi</th>
			<th field="chk" width="23" formatter="Checkbox">
				<input style="margin-top:2px;" type="checkbox" name="checkbox" id="checkbox" onclick="update_value('+index+', this.checked, \''+row.id_jadwal+'\')" '+(row.chk==true?'checked="checked"':'')+'/>
			</th>
		</tr>
	</thead>
</table>


