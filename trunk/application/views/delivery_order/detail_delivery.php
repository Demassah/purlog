<div id="toolbar_detail" style="padding:5px;height:auto">
	<div class="fsearch">
		<table>
			<tr>
					<td>&nbsp;&nbsp;<a href="#" onclick="add_sro()" class="easyui-linkbutton" iconCls="icon-detail">Add SRO</a></td>					
			</tr>	
		</table>
	</div>
</div>

<table id="dg" title="Detail Delivery Order" data-options="
			rownumbers:true,
			singleSelect:false,
			pagination:true,
			autoRowHeight:false,
			fit:true,
			toolbar:'#toolbar_detail',
		">		
	<thead>
		<tr>
			<th data-options="field:'id_krs_detail',width:'100', hidden:true"></th>
			<th field="id_do" sortable="true" width="120">ID DO</th>
			<th field="id_sro" sortable="true" width="120">ID SRO</th>
			<th field="date_create" sortable="true" width="80">Create</th>
			<th field="full_name" sortable="true" width="180">Requestor</th>	
			<!-- <th field="action" align="center" formatter="actiondetail" width="140">Aksi</th>	 -->
		</tr>
	</thead>
</table>


<script>
	
	var url;
	$(document).ready(function(){

		// search text combo
		$(document).ready(function(){
			$("#SRO").select2();
		});

		back = function (){
			$('#konten').panel({
				href: base_url+'delivery_order/index',
			});
		}

		add_sro = function (){
			$('#dialog').dialog({
				title: 'Add Shipment Request Order',
				width: 480,
				height: 290,
				closed: true,
				cache: false,
				href: base_url+'delivery_order/add_detail/<?=$id_do?>',
				modal: true
			});
			 
			$('#dialog').dialog('open');
			url = base_url+'delivery_order/save_add/add';
		}

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

		// detail_sro = function (val){
		// 	$('#konten').panel({
		// 		href:base_url+'delivery_order/detail/'+val
		// 	});
		// }

		// actiondetail = function(value, row, index){
		// 	var col='';
		// 	<?if($this->mdl_auth->CekAkses(array('menu_id'=>19, 'policy'=>'DETAIL'))){?>
		// 			col += '&nbsp;&nbsp; &nbsp;&nbsp;<a href="#" onclick="detail_sro(\''+row.id_sro+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Detail</a>';
		// 	<?}?>			
		// 	return col;
		// }
		

		$(function(){ // init
			$('#dg').datagrid({url:"delivery_order/detail_grid/<?=$id_do?>"
			});				
		});	

		//# Tombol Bawah
    $(function(){
      var pager = $('#dg').datagrid().datagrid('getPager'); // get the pager of datagrid
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