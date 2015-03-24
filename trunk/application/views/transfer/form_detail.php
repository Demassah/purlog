<script>
  var url;
  $(document).ready(function(){

    tutup = function (){
      $('#dialog_kosong').dialog('close');      
    }
    
    loaddata = function(){
      $.ajax({ 
        type: "POST",   
        url: base_url+'transfer/getdata_transfer',   
        data: $('#form3').serialize(),
        async: true,
        success : function(respon)
        {
          if(respon == ''){
            $('#tbodydetail').html('<tr><td align="center" colspan="6">Tidak Terdapat Data Dalam Database</td></tr>');
          }else{
            $('#tbodydetail').html(respon);
          }
        }
      });
    }

    saveData = function(){
      $('#form3').form('submit',{
        url: base_url+'transfer/saveDetail/<?php echo $id_transfer;?>',
        onSubmit: function(){
          return $(this).form('validate');
        },
        success: function(result){
         // alert(result);
          var result = eval('('+result+')');
          if (result.success){
            $.messager.show({
              title: 'Succes',
              msg: 'Data Berhasil Disimpan'
            });
            $('#dialog_kosong').dialog('close');  // close the dialog
            $('#dtgrd').datagrid('reload');
          } else {
            $.messager.show({
              title: 'Error',
              msg: result.msg
            });

          }
        }
      });
    }
    //end saveData

  });
</script>

<form name="form3" id="form3" method="post">
  <table border="0" cellpadding="1" cellspacing="1" width="100%">
    <tr>
      <td>
      <div class="fsearch">
        <table border="0" cellpadding="1" cellspacing="1">
          <tr>
            <td>Nama Barang</td>
            <td>: 
              <select id="kode_barang" name="kode_barang" class="easyui-combobox" style="width:200px;">
                  <?=$this->mdl_prosedur->OptionBarangs(array('value'=>$kode_barang));?>
              </select>
            </td>
            <td>&nbsp;&nbsp;&nbsp;</td>
          
            <td>Jumlah Data Yang Diproses</td>
            <td>:</td>
            <td><input type="textfield" name="jumlah" size="8" maxlength="4"></td>
          
            <td></td>
            <td></td>
            <td align="left" colspan="2" valign="top">
              <a href="#" class="easyui-linkbutton" onclick="loaddata();" iconCls="icon-reload" plain="true">Tampilkan</a>
            </td>
          </tr>

        </table>
      </div>
      </td>
    </tr>
  </table>

  <table class="tbl">
    <thead>
      <tr>
        <th width="20px" bgcolor="#F4F4F4">No.</th>
        <th width="" bgcolor="#F4F4F4">ID Stock</th>
        <th width="" bgcolor="#F4F4F4">Kode Barang</th>
        <th width="" bgcolor="#F4F4F4">Nama Barang</th>
        <th width="" bgcolor="#F4F4F4">Qty</th>
        <th width="" bgcolor="#F4F4F4">Price</th>
        <th width="" bgcolor="#F4F4F4">Lokasi Lama</th>
        <th width="" bgcolor="#F4F4F4">Lokasi Baru</th>
        <th width="" bgcolor="#F4F4F4">Qty Transfer</th>
        <th width="80px" align="center" bgcolor="#F4F4F4">Aksi</th>
      </tr>
    </thead>
    <tbody id="tbodydetail">
      
    </tbody>
  </table>
  <br>  
  <div align="right">
      <a href="#" class="easyui-linkbutton" onclick="saveData();" iconCls="icon-save" plain="false">Simpan</a>
      <a href="#" class="easyui-linkbutton" onclick="tutup();" iconCls="icon-cancel" plain="false">Tutup</a>
      &nbsp;&nbsp;&nbsp;
  </div>
</form>
