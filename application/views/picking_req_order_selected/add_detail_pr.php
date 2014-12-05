<script>
	
	var url;
	$(document).ready(function(){

		detail_pr = function (){
			$('#dialog').dialog({
				title: 'Detail Purchase Request',
				width: $(window).width() * 0.8,
				height: $(window).height() * 0.99,
				closed: true,
				cache: false,
				href: base_url+'picking_req_order_selected/detail_pr',
				modal: true
			});
			 
			$('#dialog').dialog('open');
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
		
		actionAvailable = function(value, row, index){
			var col='';
					col += '&nbsp;&nbsp;| &nbsp;&nbsp;<a href="#" onclick="detailData(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">ReAlocate</a>';		
			return col;
		}

		Checkbox = function(value, row, index){
			return '<input style="margin-top:2px;" type="checkbox" name="checkbox" id="checkbox" onclick="update_value('+index+', this.checked, \''+row.id_jadwal+'\')" '+(row.chk==true?'checked="checked"':'')+'/>';
		}
			
		$(function(){ // init
			$('#dtgrd').datagrid({url:"picking_req_order_selected/grid"});	
			//$('#dg').datagrid('enableFilter'); 
		});	
		
		
	});
</script>

<table id="dtgrd" data-options="
			rownumbers:true,
			singleSelect:false,
			autoRowHeight:false,
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
			<th field="nama_sub_kategori" sortable="true" width="650">Deskripsi</th>	
			<th field="chk" width="23" formatter="Checkbox">
				<input style="margin-top:2px;" type="checkbox" name="checkbox" id="checkbox" onclick="update_value('+index+', this.checked, \''+row.id_jadwal+'\')" '+(row.chk==true?'checked="checked"':'')+'/>
			</th>
		</tr>
	</thead>
</table>
<div id="toolbar_available" style="padding:5px;height:auto">
	<div>
		<table>
			<tr>
					<td>
							&nbsp;&nbsp;<a href="#" onclick="detail_pr()" class="easyui-linkbutton" iconCls="icon-purchase-form">Detail Purchase Request</a>
					</td> 
			</tr>
			<tr> 
					<td>&nbsp;</td>
			</tr>		
			<tr>
					<td>
							&nbsp;&nbsp;<a href="#" onclick="filter()" class="easyui-linkbutton" iconCls="icon-add">Add</a> 
					</td>
			<td>&nbsp;</td>
			</tr>
		</table>
	</div>
</div>

