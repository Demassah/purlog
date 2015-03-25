<?php
  $supplier_id = '';
  $supplier_set = array();
  $top_set = array();
  $barang_set = array();
  $harga_set = array();
  $index =0;
  $price = array();
  $qr_set = array();
  $status = array();
  $diskon = array();

  echo '<br> <h2 align="center"> Compare Vendor List </h2> <br>';

  foreach ($list as $data) {
    if ($data['id_vendor'] != $supplier_id) {
      array_push($supplier_set, $data['name_vendor']);
      array_push($top_set, $data['top']);
      array_push($qr_set,$data['id_qr']);
      array_push($price,$data['price']);
      array_push($status,$data['status']);
      array_push($diskon,$data['diskon']);
      $supplier_id = $data['id_vendor'];
      $index = 0;
    }
    $harga_set[$data['id_detail_pr']][] = array($data['price'],$data['id_detail_qr']);
    $diskon_set[$data['id_detail_pr']][] = array($data['diskon'],$data['id_detail_qr']);
    //print_r($harga_set);
    $barang_set[$index] = array("barang_nama" => $data['nama_barang'], "harga" => $harga_set[$data['id_detail_pr']],"diskon" => $diskon_set[$data['id_detail_pr']],"qty"=>$data['qty']);
    //print_r($barang_set);
    $index++;
     
  }

  $quotation = array("supplier_nama" => $supplier_set, "top" => $top_set, "data" => $barang_set,"Selected" => $qr_set,"status"=>$status);
 
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
            echo '<td colspan="2">'.$cols.'</td>';
        }
      } else {
        echo '<th>'.$rows.'</th>';
        foreach ($quotation[$_colname[$counter]] as $cols) {
            echo '<th colspan="2">'.$cols.'</th>';
        }
      }
      $header = FALSE;
      $counter++;
      echo '</tr>';
    }

    $data_counter = 0;

    foreach ($quotation['data'] as $details) {
      //echo print_r($quotation['data']);
      echo '<tr>';
      echo '<td>'.$quotation['data'][$data_counter]['barang_nama'].'<span style="color:red"> ['.$quotation['data'][$data_counter]['qty'].']</span>';
      $harga_counter = 0;
      foreach ($quotation['data'][$data_counter]['harga'] as $harga) {
        echo '<td><div id="'.$quotation['data'][$data_counter]['harga'][$harga_counter][1].'" class="qrs">';
          echo "<span name='harga' id='harga_".$quotation['data'][$data_counter]['harga'][$harga_counter][1]."' class='text'>Price : Rp.".number_format($quotation['data'][$data_counter]['harga'][$harga_counter][0],2,',','.')."</span>";
          echo "<input type='text'  name='harga' value='".$quotation['data'][$data_counter]['harga'][$harga_counter][0]."' class='editbox'  id='harga_input_".$quotation['data'][$data_counter]['harga'][$harga_counter][1]."'/>";
        echo"</div></td>";
        $harga_counter++;
      }
      $diskon_counter = 0;
      foreach ($quotation['data'][$data_counter]['diskon'] as $diskon) {
        echo '<td><div id="'.$quotation['data'][$data_counter]['diskon'][$diskon_counter][1].'" class="diskon">';
          echo "<span name='diskon' id='diskon_".$quotation['data'][$data_counter]['diskon'][$diskon_counter][1]."' class='text_diskon'>Diskon : Rp.".number_format($quotation['data'][$data_counter]['diskon'][$diskon_counter][0],2,',','.')."</span>";
          echo "<input type='text'  name='diskon' value='".$quotation['data'][$data_counter]['diskon'][$diskon_counter][0]."' class='editbox_diskon'  id='diskon_input_".$quotation['data'][$data_counter]['diskon'][$diskon_counter][1]."'/>";
        echo"</div></td>";
        $diskon_counter++;
      }
      echo '</tr>';
      $data_counter++;
    }
    echo "<tr><td></td>";

     $x=0;
      foreach ($quotation['Selected'] as $l) {
        //print_r($l);
        echo "<td colspan='2'>";
        if($quotation['status'][$x] != 2){
          if($this->mdl_auth->CekAkses(array('menu_id'=>15, 'policy'=>'SELECT'))){
          echo "<a href='#'  onclick='select_vendor(".$l.");'  plain='false'>Select</a>";
          }
          echo "   |  ";
          if($this->mdl_auth->CekAkses(array('menu_id'=>15, 'policy'=>'DELETE'))){
          echo "<a href='#'  onclick='delete_vendor(".$l.");'  plain='false'>Delete</a>";
          }
        echo "</td>";
        }else{
          echo "vendor selected";
        }
        $x++;
      }
    echo "</tr>";
  echo '</table>';
?>


<script type="text/javascript">
  var id_pr = '<?php echo $id_pr;?>';
  var id_qrs = '<?php echo $id_qrs;?>';
  $(".editbox").hide();
  $(".editbox_diskon").hide();
  $(document).ready(function() {
    $("div").on('click' ,'.qrs', function(event) {
      var ID_qr = $(this).attr('id');
          $("#harga_"+ID_qr).hide();
          $("#harga_input_"+ID_qr).show();
          $("#harga_input_"+ID_qr).focusin();
          $("#harga_input_"+ID_qr).numericInput();
          $("#harga_input_"+ID_qr).autoNumeric('init'); 
          $("#harga_input_"+ID_qr).val(""); 
    }).change(function(event) {
      var ID_qr = $(this).attr('id');
      var harga = $("#harga_input_"+ID_qr).val();
      var dataString = 'id='+ID_qr+'&harga='+harga;
      
      $(harga).numericInput();
        if( harga.length > 0)
        {
          $.ajax({
            type:"POST",
            url: base_url+"vendor_selected/update/"+ID_qr,
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
            $('#qrs_table').load(base_url + 'vendor_selected/after_select/'+id_pr+'/'+id_qrs).fadeIn("slow");  
            }
          });
        }else{
           $('#qrs_table').load(base_url + 'vendor_selected/after_select/'+id_pr+'/'+id_qrs).fadeIn("slow");
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
    //diskon
    $("div").on('click' ,'.diskon', function(event) {
      var ID_qr_dis = $(this).attr('id');
          $("#diskon_"+ID_qr_dis).hide();
          $("#diskon_input_"+ID_qr_dis).show();
          $("#diskon_input_"+ID_qr_dis).focusin();
          $("#diskon_input_"+ID_qr_dis).numericInput();
          $("#diskon_input_"+ID_qr_dis).autoNumeric('init'); 
          $("#diskon_input_"+ID_qr_dis).val(""); 
    }).change(function(event) {
      var ID_qr_dis = $(this).attr('id');
      var diskon = $("#diskon_input_"+ID_qr_dis).val();
      var dataString = 'id='+ ID_qr_dis+'&diskon='+ diskon;
      
      $(diskon).numericInput();
        if(diskon.length > 0)
        {
          $.ajax({
            type:"POST",
            url: base_url+"vendor_selected/update_diskon/"+ID_qr_dis,
            data: dataString,
            cache: false,
            success: function (html) {
              $(".editbox_diskon").hide();
              $("#diskon_"+ID_qr_dis).show();
              $("#diskon_"+ID_qr_dis).html(diskon);
              $.messager.show({
                title:'Success',
                msg: 'Data berhasil Di Update'
              });
            $('#qrs_table').load(base_url + 'vendor_selected/after_select/'+id_pr+'/'+id_qrs).fadeIn("slow");  
            }
          });
        }else{
           $('#qrs_table').load(base_url + 'vendor_selected/after_select/'+id_pr+'/'+id_qrs).fadeIn("slow");
          alert("diskon tidak boleh null atau diskon harus angka");

        }
    });
    $(".editbox_diskon").mouseup(function() {
        return false
    });
    $(document).mouseup(function() {
        $(".editbox_diskon").hide();
        $(".text_diskon").show();
    });
    // Selected
     select_vendor = function (val){
      if(confirm("Apakah yakin akan Akan Memilih Vendor '" + val + "'?")){
        var response = '';
        $.ajax({ type: "GET",
           url: base_url+'vendor_selected/Selected/' + val +'/'+id_pr+'/'+id_qrs,
           async: false,
           success : function(response){
            var response = eval('('+response+')');
            if (response.success){

              $.messager.show({
                title: 'success',
                msg: 'Data Vendor Berhasil Dipilih'
              });
              // reload and close tab
              $('#qrs_table').load(base_url + 'vendor_selected/after_select/'+id_pr+'/'+id_qrs);
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
           url: base_url+'vendor_selected/Delete/' + val,
           async: false,
           success : function(response){
            var response = eval('('+response+')');
            if (response.success){
              $.messager.show({
                title: 'Success',
                msg: 'Data Vendor Berhasil Di Hapus'
              });
              // reload and close tab
              cache:false;
              $('#qrs_table').load(base_url + 'vendor_selected/after_select/'+id_pr+'/'+id_qrs).fadeIn("slow");
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
        height: 180,
        closed: true,
        cache: false,
        href: base_url+'vendor_selected/add_vendor/'+id_pr+'/'+id_qrs,
        modal: true
      });
      $('#dialog').dialog('open');
      url = base_url+'vendor_selected/save_vendor/add';
    }
    // end newData
    saveData = function(){
      $('#form2').form('submit',{
        url: url,
        onSubmit: function(){
          return $(this).form('validate');
        },
        success: function(result){
          //alert(result);
          var result = eval('('+result+')');
          if (result.success){
            
            $('#dialog').dialog('close');   // close the dialog
            $("#qrs_table").load(base_url + 'vendor_selected/after_select/'+id_pr+'/'+id_qrs).fadeIn("slow");;  // reload the user data
            $.messager.show({
              title: 'Succes',
              msg: 'Data Berhasil Ditambahkan  ',
            });
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
      $('#konten').panel({
        href:base_url+'vendor_selected/index'
      });
    }
  });
    </script>