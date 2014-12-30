<div id="toolbar" style="padding:5px;height:auto">
	<div class="fsearch">
		<table>
			<tr>
					<td>
							&nbsp;&nbsp;<a href="#" onclick="Add_sro()" class="easyui-linkbutton" iconCls="icon-ok">Add</a>
					</td>							
			</tr>		
		</table>
	</div>
</div>
<form id="form2" method="post">
	<div id="isi">
	  <table class="tbl" title="List Delivery Order">       
	    <thead>
	      <tr>
	        <th width="20"></th>
	        <th width="20">ID SRO</th>
	        <th width="20">ID RO</th>
	        <th width="20">ID DO</th>
	        <th width="140">Create</th>
	        <th width="100">Requestor</th>
	        <th width="30">Aksi</th>         
	      </tr>
	    </thead>
	    <tbody>
	      <?php 
	        // foreach ($list as $d) {
	        foreach ($item as $l) {
	       		echo "<tr>";
	          echo "<td  align='center'><input type='checkbox'  name='id_sro[]' value=".$l->id_sro.">";
	          echo "<input type='hidden' name='id_do'  value='$id_do'></td>";
	          echo "<td>".$l->id_sro."</td>";
	          echo "<td value='".$l->id_ro."'>".$l->id_ro."<input id='id_ro' type='hidden' value='".$l->id_ro."'></td>";
	          echo "<td>".$l->id_do."</td>";
	          echo "<td>".$l->date_create."</td>";
	          echo "<td>".$l->full_name."</td>";
	          echo "<td value=''><a href='javascript:void(0)'  onclick='Detail_ro(".$l->id_sro.")'  plain='false'>Detail</a></td>";
	          ?>

	          <!-- <td value="<?=$l->id_ro?>"><a href="javascript:void(0)"  onclick="Detail_ro"  plain="false">Detail</a></td> -->
	         <?php
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
	var id_ro = $('#id_ro').val(); 
	var id_do = '<?=$id_do;?>'
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

		Add_sro = function (){
			$('#dialog').dialog({
				title: 'Add Shipment Request Order',
				width: 580,
				height: 290,
				closed: true,
				cache: false,
				href: base_url+'delivery_order/add_detail/<?=$id_do?>',
				modal: true
			});
			 
			$('#dialog').dialog('open');
			url = base_url+'delivery_order/save_add/add';
		}
	// $(".tbl").on('click','td',function(e){
	//     e.preventDefault();
	//     var id = $(this).attr('value');
	//     $('#dialog').dialog({
	// 			title: 'Detail List Request order',
	// 			width: 880,
	// 			height: 290,
	// 			closed: true,
	// 			cache: false,
	// 			href: base_url + 'delivery_order/detail_ro/' + id,
	// 			modal: true
	     
	//    });
	//     alert(id);
	// });

		Detail_ro = function (value){
			$('#dialog_kosong').dialog({
				title: 'Detail List Request order',
				width: 880,
				height: 290,
				closed: true,
				cache: false,
				href: base_url + 'delivery_order/detail_ro/' + value,
				modal: true
			});
			 
			$('#dialog_kosong').dialog('open');
			url = base_url+'delivery_order/save_add/add';
		}

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
						//$('#isi').html(' ');
						$("#isi").load('<?=base_url();?>delivery_order/after/'+id_do).fadeIn(5000);
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
        url: base_url + 'delivery_order/save_add/cancel',
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
            $("#isi").load('<?=base_url();?>delivery_order/after/'+id_do).fadeIn(5000);
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

	
	});
</script>