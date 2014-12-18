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
<form id="form1" id="dg" method="post">
  <table class="tbl" title="List Delivery Order">       
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
        foreach ($item as $l) {

       		echo"
          <tr>
          <td align='center'><input type='checkbox' name='id_sro[]'  value='".$l->id_sro."'>
          <input type='hidden' name='id_do'  value='$id_do'></td>
          <td>".$l->id_sro."</td>
          <td>".$l->date_create."</td>
          <td>".$l->full_name."</td>
          </tr> ";
         }
       ?>
    </tbody>
  </table>

   <br>  
	  <div align="right">
	      <a href="#" class="easyui-linkbutton" onclick="CancelData();" iconCls="icon-cancel" plain="false">Cancel</a>&nbsp;&nbsp;&nbsp;
	  </div>
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

		Insert = function (){
			$('#dialog').dialog({
				title: 'Add Shipment Request Order',
				width: 480,
				height: 290,
				closed: true,
				cache: false,
				href: base_url + 'delivery_order/add_detail/<?=$id_do?>',
				modal: true
			}); 
			 
			// $('#dialog').dialog('open');
			// url = base_url+'delivery_order/save_add/add';
		}

		saveData = function(){
			
			$('#form1').form('submit',{
				url: base_url+'delivery_order/save_add/add',
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