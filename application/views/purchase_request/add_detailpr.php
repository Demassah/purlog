<script>
  var url;
  $(document).ready(function(){

    tutup = function (){
      $('#dialog_kosong').dialog('close');      
    }
    
    loaddata = function(){
      $.ajax({ 
        type: "POST",   
        url: base_url+'purchase_request/getdata_detailpr',   
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
        url: base_url+'purchase_request/saveDetail/<?php echo $id_pr;?>',
        onSubmit: function(){
          return $(this).form('validate');
        },
        success: function(result){
          alert(result);
          var result = eval('('+result+')');
          if (result.success){
            $.messager.show({
              title: 'Succes',
              msg: 'Data Berhasil Disimpan'
            });
            $('#dialog_kosong').dialog('close');  // close the dialog
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
            <td>ID Request Order</td>
            <td>: 
              <input name="id_ro" readonly="True" size="10" value="<?=$id_ro?>">
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
        <th width="" bgcolor="#F4F4F4">ID Request Order</th>
        <th width="" bgcolor="#F4F4F4">ID Detail RO</th>
        <th width="" bgcolor="#F4F4F4">Kode Barang</th>
        <th width="" bgcolor="#F4F4F4">Nama Barang</th>
        <th width="" bgcolor="#F4F4F4">Qty</th>
        <th width="" bgcolor="#F4F4F4">Requestor</th>
        <th width="" bgcolor="#F4F4F4">Date Create</th>
        <th width="" bgcolor="#F4F4F4">Note</th>
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