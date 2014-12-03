<script>
	
	var url;
	$(document).ready(function(){

		detailDO = function (){
			$('#dialog').dialog({
				title: 'Detail Delivery Order',
				width: $(window).width() * 0.8,
				height: $(window).height() * 0.99,
				closed: true,
				cache: false,
				href: base_url+'delivery_order/detail',
				modal: true
			});
			 
			$('#dialog').dialog('open');
			url = base_url+'departement/save/add';
		}
				
		actiondetail = function(value, row, index){
			var col='';
					col += '&nbsp;&nbsp;  &nbsp;&nbsp;<a href="#" onclick="detailData(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">add</a>';			
			return col;
		}

		Checkbox = function(value, row, index){
			return '<input style="margin-top:2px;" type="checkbox" name="checkbox" id="checkbox" onclick="update_value('+index+', this.checked, \''+row.id_jadwal+'\')" '+(row.chk==true?'checked="checked"':'')+'/>';
		}

		//# Tombol Bawah
		$(function(){
			var pager = $('#dg').datagrid().datagrid('getPager');	// get the pager of datagrid
			pager.pagination({
				buttons:[
					{
						iconCls:'icon-add',
						text:'Alocate All',
						handler:function(){
							newData();
						}
					}				
				]
			});			
		});
		

		$(function(){ // init
			$('#dtgrd').datagrid({url:"delivery_order/grid"});	
			//$('#dg').datagrid('enableFilter'); 
		});	
		
	});
</script>

<table id="dtgrd" data-options="
			rownumbers:true,
			singleSelect:false,
			autoRowHeight:false,
			fit:true,
			toolbar:'#toolbar_list_sro',
		">		
	<thead>
		<tr>
			<th data-options="field:'id_krs_detail',width:'100', hidden:true">aa</th>
			<th field="nama_kategori" sortable="true" width="120">ID Request Order</th>
			<th field="kode_barang" sortable="true" width="120">ID Ext Document</th>
			<th field="kode_barang" sortable="true" width="120">ID Barang</th>
			<th field="nama_sub_kategori" sortable="true" width="120">Nama Barang</th>
			<th field="kode_barang" sortable="true" width="120">Qty</th>
			<th field="kode_barang" sortable="true" width="120">Requestor </th>
			<th field="kode_barang" sortable="true" width="120">Date Create</th>
			<th field="kode_barang" sortable="true" width="120">Note</th>			
			<th field="action" align="center" formatter="actiondetail" width="140">Aksi</th>
			<th field="chk" width="23" formatter="Checkbox">
				<input style="margin-top:2px;" type="checkbox" name="checkbox" id="checkbox" onclick="update_value('+index+', this.checked, \''+row.id_jadwal+'\')" '+(row.chk==true?'checked="checked"':'')+'/>
			</th>
		</tr>
	</thead>
</table>
<div id="toolbar_list_sro" style="padding:5px;height:auto">
	<div>
		<table>
			<tr>
					<td>&nbsp;&nbsp;<a href="#" onclick="detailDO()" class="easyui-linkbutton" iconCls="icon-detail">Detail Delivery Order</a></td>						
			</tr>
			<tr> 
					<td>&nbsp;</td>
			</tr>		
			<tr> 
				<td>
						<label style="width:120px">SRO </label>:

						<select id="#" name="#" style="width:200px;">
						</select>
						&nbsp;&nbsp;<a href="#" onclick="filter()" class="easyui-linkbutton" iconCls="icon-add">Add All</a>
				</td>
			</tr>			
		</table>
	</div>
</div>


