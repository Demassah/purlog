<div id="toolbar" style="padding:5px;height:auto">
	<div class="fsearch">
		<table>
			<tr>
					<td>
							&nbsp;&nbsp;<a href="#" onclick="add()" class="easyui-linkbutton" iconCls="icon-ok">Add</a>
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
			toolbar:'#toolbar',
		">		
	<thead>
		<tr>
			<th data-options="field:'id_krs_detail',width:'100', hidden:true"></th>
			<th field="id_detail_pros" sortable="true" width="120">ID Detail ROS</th>
			<th field="id_detail_ros" sortable="true" width="120">ID ROS</th>
			<th field="kode_barang" sortable="true" width="120">ID Item</th>
			<th field="qty" sortable="true" width="80">Qty</th>
			<th field="nama_sub_kategori" sortable="true" width="600">Deskripsi</th>		
			<th field="chk" width="23" formatter="Checkbox">
				<input style="margin-top:2px;" type="checkbox" name="checkbox" id="checkbox" onclick="update_value('+index+', this.checked, \''+row.id_jadwal+'\')" '+(row.chk==true?'checked="checked"':'')+'/>
			</th>
		</tr>
	</thead>
</table>

<script>
	var url;
	var id_sro ='<?php echo $id_sro;?>';
	var id_ro ='<?php echo $id_ro;?>';
	$(document).ready(function(){

		add = function (val){
			if(val==null){
	          var row = $('#dg').datagrid('getData');              
	          var id = id_ro;
	          var id_sro=id_sro;
	          val = id;
	          id_sro =id_sro;
	     	}
	     	
			$('#dialog').dialog({
				title: 'Detail SRO',
				width: 880,
				height: 290,
				closed: true,
				cache: false,
				href:base_url+'shipment_req_order/add_detail/'+val+'/<?=$id_sro;?>',
				modal: true
			});

			$('#dialog').dialog('open');
			url = base_url+'shipment_req_order/save_add_detail/add';
		}
		//end newData
		saveData = function(){
			
			$('#form1').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					alert(result);
					var result = eval('('+result+')');
					if (result.success){
						$('#dialog').dialog('close');		// close the dialog
						$('#dg').datagrid('reload');		// reload the user data
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
				}
			});
		}

		back = function (val){
		  //detail
		  $('#konten').panel({
			href: base_url+'shipment_req_order/index',
		  });
		}

		loadingList = function (){
		$('#dialog').dialog({
				title: 'Tambah Request Order',
				width: 980,
				height: 590,
				closed: true,
				cache: false,
				href:base_url+'shipment_req_order/loadingList',
				modal: true
			});			 
			$('#dialog').dialog('open');
			url = base_url+'request_order/save/add';
		}
		Checkbox = function(value, row, index){
			return '<input style="margin-top:2px;" type="checkbox" name="checkbox" id="checkbox" onclick="update_value('+index+', this.checked, \''+row.id_jadwal+'\')" '+(row.chk==true?'checked="checked"':'')+'/>';
		}
		
		$(function(){ // init
			$('#dg').datagrid({url:"shipment_req_order/detail_grid/<?=$id_ro?>/<?=$id_sro?>"});	
		});	



		
	});
</script>