<div id="toolbar" style="padding:5px;height:auto">
	<div class="fsearch">
		<table>
			<tr>
					<td>
							<a href="#" onclick="Add_vendor()" class="easyui-linkbutton" iconCls="icon-ok">Add</a>
					</td>
			</tr>
		</table>
	</div>
</div>
<!-- <h2 align="center">Compare Vendor List</h2>
  <table class="tbl">
      <thead>
          <tr>
              <th></th>
              <th scope="col" abbr="Starter">Smart Starter</th>
              <th scope="col" abbr="Medium">Smart Medium</th>
              <th scope="col" abbr="Business">Smart Business</th>
              <th scope="col" abbr="Deluxe">Smart Deluxe</th>
          </tr>
      </thead>
      <tfoot>
          <tr>
              <th scope="row"></th>
              <td>$ 2.90</td>
              <td>$ 5.90</td>
              <td>$ 9.90</td>
              <td>$ 14.90</td>
          </tr>
      </tfoot>
      <tbody>
          <tr>
              <th scope="row">TOP</th>
              <td>512 MB</td>
              <td>1 GB</td>
              <td>2 GB</td>
              <td>4 GB</td>
          </tr>
          <tr>
              <th scope="row">Nama Barang</th>
              <td>50 GB</td>
              <td>100 GB</td>
              <td>150 GB</td>
              <td>Unlimited</td>
          </tr>
          <tr>
              <th scope="row">Nama Barang </th>
              <td>Unlimited</td>
              <td>Unlimited</td>
              <td>Unlimited</td>
              <td>Unlimited</td>
          </tr>
          <tr>
              <th scope="row">Nama Barang </th>
              <td>19.90 $</td>
              <td>12.90 $</td>
              <td>free</td>
              <td>free</td>
          </tr>
      </tbody>
  </table> -->
<div id="isi">
  <form id="form2" method="post" >
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
        if(empty($list)){
          echo "data kosong";
        }else{
  				foreach ($list as $l) {
  					echo "
  						<tr id='".$l->id_detail_qr."' class='edit_tr'>
  							<td></td>
  							<td>".$l->name_vendor."</td>
  							<td>".$l->top."</td>
  							<td>".$l->kode_barang."</td>
  							<td>".$l->nama_barang."</td>
  							<td class='edit_td'>
  								<span id='price_".$l->id_detail_qr."' class='text'>".$l->price."</span>
  								<input type='text' name='price' value='".$l->price."' class='editbox' id='price_input_".$l->id_detail_qr."'/>
  							</td>
  							<td><a href='#'' class='easyui-linkbutton' onclick='Selected(".$l->id_qr.");'  plain='false'>Select</a></td>
  						</tr>
  					";
  				}
        }
  			?>
  		</tbody>
  	</table>
  </form>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    var id_pr = '<?php echo $id_pr;?>';
  	$(".editbox").hide();

    $('.edit_tr').on('click', function() {
     var ID=$(this).attr('id');
     $("#price_"+ID).hide();
     $("#price_input_"+ID).show();
    }).change(function() {
     var ID=$(this).attr('id');
     var price=$("#price_input_"+ID).val();
     var dataString = 'id='+ ID +'&price='+price;
     $("#price_"+ID).html('');
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
    }

    Add_vendor = function (){
      $('#dialog').dialog({
        title: 'Tambah Vendor',
        width: 380,
        height: 150,
        closed: true,
        cache: false,
        href: base_url+'quotation_request_selected/add/'+id_pr,
        modal: true
      });
       
      $('#dialog').dialog('open');
      url = base_url+'quotation_request_selected/save/add';
    }
    // end newData
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
            $('#dialog').dialog('close');   // close the dialog
            $("#isi").load(base_url + 'quotation_request_selected/after/'+id_pr);  // reload the user data
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