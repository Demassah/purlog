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
	<table class="tbl">
		<caption>Compare vendor List</caption>
		<thead>
			<tr>
				<th></th>
				<th>Vendor Name</th>
				<th>TOP</th>
				<th>Kode Barang</th>
				<th>Nama Barang</th>
				<th>Price</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php
				foreach ($list as $l) {
					echo "
						<tr id='".$l->id_detail_qr."' class='edit_tr'>
							<td></td>
							<td>".$l->name_vendor."</td>
							<td>".$l->top."</td>
							<td>".$l->id_barang."</td>
							<td>".$l->nama_barang."</td>
							<td class='edit_td'>
								<span id='price_".$l->id_detail_qr."' class='text'>".$l->price."</span>
								<input type='text' name='price' value='".$l->price."' class='editbox' id='price_input_".$l->id_detail_qr."'/>
							</td>
							<td><a href='#'' class='easyui-linkbutton' onclick='Selected(".$l->id_qr.");' iconCls='icon-save' plain='false'>Select</a></td>
						</tr>
					";
				}
			?>
		</tbody>
	</table>
</form>
<script type="text/javascript">
  $(document).ready(function() {
  	$(".editbox").hide();
    $(".edit_tr").click(function() {
     var ID=$(this).attr('id');
     $("#price_"+ID).hide();
     $("#price_input_"+ID).show();
    }).change(function() {
     var ID=$(this).attr('id');
     var price=$("#price_input_"+ID).val();
     var dataString = 'id='+ ID +'&price='+price;
     $("#price_"+ID).html('<img src="load.gif" />');
       if(price.length>0 ) {
          $.ajax({
            type: "POST",
            url: base_url + "quotation_request_selected/update/"+ID,
            data: dataString,
            cache: false,
            success: function(html) {
             $(".editbox").hide();
             $("#price_"+ID).show();
             $("#price_"+ID).html(price);
             $.messager.show({
								title: 'Success',
								msg: 'Data Berhasil Di Update'
							});
            }
          });
        }
        else {
          alert('Harga Tidak Boleh Null atau Harga Harus Angka');
            }
    });

          $(".editbox").mouseup(function() {
              return false
          });

          $(document).mouseup(function() {
              $(".editbox").hide();
              $(".text").show();
          });
          // Selected
     Selected = function (val){
        if(confirm("Apakah yakin akan mengirim data ke QRS '" + val + "'?")){
          var response = '';
          $.ajax({ type: "GET",
             url: base_url+'quotation_request_selected/Selected/' + val,
             async: false,
             success : function(response){
              var response = eval('('+response+')');
              if (response.success){
                $.messager.show({
                  title: 'Success',
                  msg: 'Data Berhasil Di save'
                });
                // reload and close tab
                $('#dg').datagrid('reload');
              } else {
                $.messager.show({
                  title: 'Error',
                  msg: response.msg
                });
              }
             }
          });
        }
      //}
    }
    });
    </script>