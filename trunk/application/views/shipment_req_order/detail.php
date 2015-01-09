<div id="toolbar" style="padding:5px;height:auto">
	<div class="fsearch">
		<table>
			<tr>
				<td><a href="#" onclick="Insert()" class="easyui-linkbutton" iconCls="icon-ok">Add</a></td>
				<td style="width:100%"></td>
        <td><a href="#" onclick="back()" class="easyui-linkbutton" iconCls="icon-undo">Kembali</a></td>
			</tr>		
		</table>
	</div>
</div>

<form id="form2"  method="post">
	<div id="isi">
	<table class="tbl" id="dg" title="Detail Shipment Request Order">		
		<thead>
			<tr>
				<th width="20"></th>
				<th width="120">ID Detail RO</th>
				<th width="120">ID RO</th>
				<th width="120">ID barang</th>
				<th width="120">Item Name</th>
				<th width="80">Qty</th>
				<th width="100">Lokasi</th>	
			</tr>
		</thead>
		<tbody>
				<?php 
					foreach ($list as $l) {
						echo "<tr>";
						echo "<td><input type='checkbox' name='id_detail_pros[]'  value='".$l->id_detail_pros."'></td>";
						echo "<td>".$l->id_detail_ro."</td>";
						echo "<td>".$l->id_ro."</td>";
						echo "<td>".$l->kode_barang."</td>";
						echo "<td>".$l->nama_barang."</td>";
						echo "<td>".$l->qty."</td>";
						echo "<td>".$l->id_lokasi."</td>";
						echo "</tr>";
					}
				?>
			
		</tbody>
	</table>
	</div>
	  <br>  
	  <div align="right">
	      <a href="#" class="easyui-linkbutton" onclick="CancelData();" iconCls="icon-cancel" plain="false">Cancel</a>&nbsp;&nbsp;&nbsp;
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
					//alert(result);
					var result = eval('('+result+')');
					if (result.success){
						$.messager.show({
              title: 'Succes',
              msg: 'Data Berhasil Ditambahkan ',
            });
						$('#dialog').dialog('close');		// close the dialog
						 $("#isi").load('<?=base_url();?>shipment_req_order/after/'+id_ro+'/'+id_sro).fadeIn(5000);// reload the user data
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
				}
			});
		}

		CancelData = function(){
      $('#form2').form('submit',{
        url: base_url+'shipment_req_order/save_add_detail/cancel',
        onSubmit: function(){
          return $(this).form('validate');
        },
        success: function(result){
          //alert(result);
          var result = eval('('+result+')');
          if (result.success){
          	
            $.messager.show({
              title: 'Succes',
              msg: 'Data Berhasil ',

            });
            $("#dg").load('<?=base_url();?>shipment_req_order/after/'+id_ro+'/'+id_sro).fadeIn(5000);;
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