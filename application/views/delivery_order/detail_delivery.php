<form id="form1" id="dg" method="post">
  <table class="tbl" >       
    <thead>
      <tr>
        <th width="20"></th>
        <th width="20">ID SRO</th>
        <th width="120">Create</th>
        <th width="120">Requestor</th>         
      </tr>
    </thead>
    <tbody>
      <?php 
        // foreach ($list as $d) {
        foreach ($l as $d) {

       		echo"
          <tr>
          <td align='center'><input type='checkbox' name='id_sro[]'  value='$d[id_sro]'>
          <input type='hidden' name='id_do'  value='$id_do'></td>
          <td>$d[id_sro]</td>
          <td>$d[date_create]</td>
          <td>$d[full_name]</td>
          </tr> ";
         }
       ?>
    </tbody>
  </table>
</form>

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
				href: base_url + 'delivery_order/add_detail/<?=$id_do?>',
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

		
		
	});
</script>