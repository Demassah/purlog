<script>
  var url;
  $(document).ready(function(){

    kembali = function (){
      $('#konten').panel({      
        href:base_url+'document_receive/index/',
      });
    }
    
    loaddata = function(){
      $.ajax({ 
        type: "POST",   
        url: base_url+'document_receive/getdata_add_detail',   
        data: $('#form_detail').serialize(),
        async: true,
        success : function(respon)
        {
          if(respon == ''){
            $('#tbodypurchase').html('<tr><td align="center" colspan="6">Tidak Terdapat Data Dalam Database</td></tr>');
          }else{
            $('#tbodypurchase').html(respon);
          }
        }
      });
    }
    
    saveData = function(){
      $('#form_detail').form('submit',{
        url: base_url+'document_receive/saveDetail/<?php echo $id_receive;?>',
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
            $('#dialog_kosong').datagrid('reload');
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
<form name="form_detail" id="form_detail" method="post">
  <table border="0" cellpadding="1" cellspacing="1" width="100%">
    <tr>
      <td>
      <div class="fsearch">
        <table border="0" cellpadding="1" cellspacing="1">
          <tr>
            <td>ID Shipment RO</td>
            <td>: 
              <select id="id_sro" name="id_sro" style="width:80px;">
                <?=$this->mdl_prosedur->OptionSRO_add_DetailDR(array('value'=>$id_sro));?>
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
        <th width="" bgcolor="#F4F4F4">ID Detail Pros</th>
        <th width="" bgcolor="#F4F4F4">ID Detail RO</th>
        <th width="" bgcolor="#F4F4F4">ID RO</th>
        <th width="" bgcolor="#F4F4F4">ID SRO</th>
        <th width="" bgcolor="#F4F4F4">Kode Barang</th>
        <th width="" bgcolor="#F4F4F4">Nama Barang</th>
        <th width="" bgcolor="#F4F4F4">Qty</th>
        <th width="" bgcolor="#F4F4F4">Date Create</th>
        <th width="200px" align="center" bgcolor="#F4F4F4">Aksi</th>
      </tr>
    </thead>
    <tbody id="tbodypurchase">
      
    </tbody>
  </table>
  <br>  
  <div align="right">
      <a href="#" class="easyui-linkbutton" onclick="saveData();" iconCls="icon-save" plain="false">Simpan</a>
      <a href="#" class="easyui-linkbutton" onclick="kembali();" iconCls="icon-undo" plain="false">Kembali</a>
      &nbsp;&nbsp;&nbsp;
  </div>
</form>