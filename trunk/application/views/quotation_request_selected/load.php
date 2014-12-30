<?php
  $supplier_id = '';
  $supplier_set = array();
  $top_set = array();
  $barang_set = array();
  $harga_set = array();
  $detail_qr = array();
  $index =0;
  $qr_set = array();

  echo '<br> <h2 align="center"> Compare Vendor List </h2> <br>';

  foreach ($list as $data) {
    if ($data['id_vendor'] != $supplier_id) {
      array_push($supplier_set, $data['name_vendor']);
      array_push($top_set, $data['top']);
      array_push($qr_set,$data['id_qr']);
      array_push($detail_qr,$data['id_detail_qr']);

      $supplier_id = $data['id_vendor'];
      $index = 0;
    }
    $harga_set[$data['nama_barang']][] = array($data['price'],$data['id_detail_qr']);
    $barang_set[$index] = array("barang_nama" => $data['nama_barang'], "harga" => $harga_set[$data['nama_barang']]);
    $index++;
  }

  $quotation = array("supplier_nama" => $supplier_set, "top" => $top_set, "data" => $barang_set, "Selected" => $qr_set);

  $header = TRUE;
  $counter = 0;
  $_crossfield = array('Vendor', 'TOP');
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
        echo '<td><div id="'.$quotation['data'][$data_counter]['harga'][$harga_counter][1].'" class="qrs">';
          echo "<span name='harga' id='harga_".$quotation['data'][$data_counter]['harga'][$harga_counter][1]."' class='text'>".$quotation['data'][$data_counter]['harga'][$harga_counter][0]."</span>";
          echo "<input type='text' name='harga' value='".$quotation['data'][$data_counter]['harga'][$harga_counter][0]."' class='editbox' id='harga_input_".$quotation['data'][$data_counter]['harga'][$harga_counter][1]."'/>";
        echo"</div></td>";
        $harga_counter++;
      }
      echo '</tr>';
      $data_counter++;
    }
    echo "<tr><td></td>";
    foreach ($quotation['Selected'] as $l) {
      echo "<td>";
        if($this->mdl_auth->CekAkses(array('menu_id'=>15, 'policy'=>'ACCESS'))){
        echo "<a href='#'  onclick='select_vendor(".$l.");'  plain='false'>Select</a>";
        }
        echo "   |  ";
        if($this->mdl_auth->CekAkses(array('menu_id'=>15, 'policy'=>'DELETE'))){
        echo "<a href='#'  onclick='delete_vendor(".$l.");'  plain='false'>Delete</a>";
        }
      echo "</td>";
    }
    echo "</tr>";
  echo '</table>';
?>

<script type="text/javascript">
  var id_pr = '<?php echo $id_pr;?>';
  $(".editbox").hide();
  $(document).ready(function() {
    $("div").on('click' ,'.qrs', function(event) {
      var ID_qr = $(this).attr('id');
          $("#harga_"+ID_qr).hide();
          $("#harga_input_"+ID_qr).show();
          $("#harga_input_"+ID_qr).focusin();

    }).change(function(event) {
      var ID_qr = $(this).attr('id');
      var harga = $("#harga_input_"+ID_qr).val();
      var dataString = 'id='+ID_qr+'&harga='+harga;
      $("#harga_"+ID_qr).html('');
        if(harga.length > 0 && $.isNumeric(harga) && harga !=0)
        {
          $.ajax({
            type:"POST",
            url: base_url+"quotation_request_selected/update/"+ID_qr,
            data: dataString,
            cache: false,
            success: function (html) {
              $(".editbox").hide();
              $("#harga_"+ID_qr).show();
              $("#harga_"+ID_qr).html(harga);
              $.messager.show({
                title:'Success',
                msg: 'Data berhasil Di Update'
              });

            }
          });
        }else{
          alert("Harga tidak boleh null atau harga harus angka");
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
     select_vendor = function (val){
      if(confirm("Apakah yakin akan mengirim data ke QRS '" + val + "'?")){
        var response = '';
        $.ajax({ type: "GET",
           url: base_url+'quotation_request_selected/Selected/' + val +'/'+id_pr,
           async: false,
           success : function(response){
            var response = eval('('+response+')');
            if (response.success){

              $.messager.show({
                title: 'success',
                msg: 'Data Vendor Berhasil Dipilih'
              });
              // reload and close tab
              $('#qrs_table').load(base_url + 'quotation_request_selected/after_select/'+id_pr).fadeIn("slow");
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

    delete_vendor = function (val){
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
                msg: 'Data Vendor Berhasil Di Hapus'
              });
              // reload and close tab
              $('#qrs_table').load(base_url + 'quotation_request_selected/after_select/'+id_pr).fadeIn("slow");
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
      $('#form2').form('submit',{
        url: url,
        onSubmit: function(){
          return $(this).form('validate');
        },
        success: function(result){
          alert(result);
          var result = eval('('+result+')');
          if (result.success){
            $('#dialog').dialog('close');   // close the dialog
            $("#qrs_table").load(base_url + 'quotation_request_selected/after_select/'+id_pr).fadeIn("slow");;  // reload the user data
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