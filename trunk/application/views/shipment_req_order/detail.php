<div id="toolbar" style="padding:5px;height:auto">
	<div class="fsearch">
		<table>
			<tr>
					<td>
							&nbsp;&nbsp;<a href="#" onclick="Insert()" class="easyui-linkbutton" iconCls="icon-ok">Add</a>
					</td>							
			</tr>		
		</table>
	</div>
</div>
<form id="form2" method="post">
<table class="tbl" id="dg" title="Detail Shipment Request Order">		
	<thead>
		<tr>
			<th width="120">ID Detail RO</th>
			<th width="120">ID RO</th>
			<th width="120">ID barang</th>
			<th width="120">Item Name</th>
			<th width="80">Qty</th>
			<th width="100">Lokasi</th>	
			<th width="20"></th>			
		</tr>
	</thead>
	<tbody>
		<tr>
			<?php 
				foreach ($list as $l) {
					echo "<td>".$l->id_detail_ro."</td>";
					echo "<td>".$l->id_ro."</td>";
					echo "<td>".$l->kode_barang."</td>";
					echo "<td>".$l->nama_barang."</td>";
					echo "<td>".$l->qty."</td>";
					echo "<td>".$l->id_lokasi."</td>";
					echo "<td><input type='checkbox' name='id_detail_pros[]'  value='".$l->id_detail_pros."'></td>";
				}
			?>
		</tr>
	</tbody>
</table>
  <br>  
  <div align="right">
      <a href="#" class="easyui-linkbutton" onclick="cancelData();" iconCls="icon-cancel" plain="false">Cancel</a>&nbsp;&nbsp;&nbsp;
  </div>
</form>


<script>
	var url;
	var id_sro ='<?php echo $id_sro;?>';
	var id_ro ='<?php echo $id_ro;?>';
	$(document).ready(function(){

		Insert = function (val){
     	
			$('#dialog').dialog({
				title: 'Detail SRO',
				width: 880,
				height: 290,
				closed: true,
				cache: false,
				href:base_url+'shipment_req_order/add_detail/<?=$id_ro?>/<?=$id_sro;?>',
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

		cancelData = function(){
      $('#form2').form('submit',{
        url: base_url+'shipment_req_order/save/cancel',
        onSubmit: function(){
          return $(this).form('validate');
        },
        success: function(result){
          //alert(result);
          var result = eval('('+result+')');
          if (result.success){
            $.messager.show({
              title: 'Succes',
              msg: 'Data Berhasil Disimpan'
            });
            $('#tbodypurchase').html(' ');
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

			
	});
</script>