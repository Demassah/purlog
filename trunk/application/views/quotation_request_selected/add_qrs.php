<div id="toolbar" style="padding:5px;height:auto">
  <div class="fsearch">
    <table>
      <tr>
          <td>
              &nbsp;&nbsp;<a href="#" onclick="Add_vendor()" class="easyui-linkbutton" iconCls="icon-ok">Add</a>
          </td>             
      </tr>   
    </table>
  </div>
</div>

<?php

$supplier_id = '';
$supplier_set = array();
$top_set = array();
$barang_set = array();
$harga_set = array();
$index =0;
$qr_set = array();

echo '<br> <h2 align="center"> Compare Vendor List </h2> <br>';
// print_r($list);

foreach ($list as $data) {
    // echo "<br>".$data['name_vendor'];

    if ($data['id_vendor'] != $supplier_id) {
        array_push($supplier_set, $data['name_vendor']);
        array_push($top_set, $data['top']);
        array_push($qr_set,$data['id_qr']);
        // echo "<br>".$data['name_vendor'];
        $supplier_id = $data['id_vendor'];
        $index = 0;
    }

    // echo "<br>".print_r($supplier_set);

    $harga_set[$data['nama_barang']][] = $data['price'];
    $barang_set[$index] = array("barang_nama" => $data['nama_barang'], "harga" => $harga_set[$data['nama_barang']]);
    $index++;
}

$quotation = array("supplier_nama" => $supplier_set, "top" => $top_set, "data" => $barang_set, "Selected" => $qr_set);

// print_r($quotation);
$header = TRUE;
$counter = 0;
$_crossfield = array('', 'TOP');
$_colname = array(0 => "supplier_nama", 1 => "top");

echo '<table class="tbl">';

foreach ($_crossfield as $rows) {

    echo '<tr>';
    if (!$header) {
        echo '<td>'.$rows.'</td>';
        foreach ($quotation[$_colname[$counter]] as $cols) {
            echo '<td>'.$cols.'</td>';
        }
    } else {
        echo '<th>'.$rows.'</th>';
        foreach ($quotation[$_colname[$counter]] as $cols) {
            echo '<th>'.$cols.'</th>';
        }
    }
    // echo '</tr>';

    $header = FALSE;
    $counter++;
    echo '</tr>';
}

$data_counter = 0;

foreach ($quotation['data'] as $details) {

    echo '<tr>';
    echo '<td>'.$quotation['data'][$data_counter]['barang_nama'].'</td>';

    $harga_counter = 0;
    foreach ($quotation['data'][$data_counter]['harga'] as $harga) {
        echo '<td>'.$quotation['data'][$data_counter]['harga'][$harga_counter].'</td>';
        $harga_counter++;
    }

    echo '</tr>';
    $data_counter++;
}
echo "<tr><td></td>";
foreach ($quotation['Selected'] as $l) {
  // echo '<td>'.$l.'</td>';
  echo "<td><a href='#'' class='easyui-linkbutton' onclick='Selected(".$l.");'  plain='false'>Select</a>
  <a href='#'' class='easyui-linkbutton' onclick='Delete(".$l.");'  plain='false'>Delete</a></td>";
}
echo "</tr>";

echo '</table>';
?>


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
          // var cek = $('.cek').val();
          // $('.cek').keyup(function() {
          //   if($.isNumeric('.cek'))
          //   {
          //     alert(cek);
          //   }else{
          //     alert('bukan angka');
          //   }
          // });

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

    Delete = function (val){
      if(confirm("Apakah yakin akan Menghapus Vendor '" + val + "'?")){
        var response = '';
        $.ajax({ type: "GET",
           url: base_url+'quotation_request_selected/Delete/' + val,
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
        href: base_url+'quotation_request_selected/add_vendor/'+id_pr,
        modal: true
      });
       
      $('#dialog').dialog('open');
      url = base_url+'quotation_request_selected/save_vendor/add';
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

    // var auto_refresh = setInterval(
    //   function ()
    //   {
    //   $("#konten").load(base_url + "quotation_request_selected/add_qrs/" + id_pr).fadeIn("slow");
    //   }, 50000);
    

    });
    </script>