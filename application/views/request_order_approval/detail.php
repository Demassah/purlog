<script type="text/javascript">
    var url;
  $(document).ready(function(){

    back = function (val){
      $('#konten').panel({
        href:base_url+'request_order_approval/index'
      });
    }

    newDetail = function (){
      $('#dialog_kosong').dialog({
        title: 'Tambah Detail Request Order',
        width: 440,
        height: $(window).height() * 0.66,
        closed: true,
        cache: false,
        href: base_url+'request_order_approval/add_detail/<?=$id_ro?>',
        modal: true
      });
      $('#dialog_kosong').dialog('open');
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
            $('#dg_roa').datagrid('reload');   // reload the user data
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
    
    deleteData = function (val){
        if(confirm("Apakah yakin akan menghapus data '" + val + "'?")){
          var response = '';
          $.ajax({ type: "GET",
             url: base_url+'request_order_approval/DeleteDetail/' + val,
             async: false,
             success : function(response){
              var response = eval('('+response+')');
              if (response.success){
                $.messager.show({
                  title: 'Success',
                  msg: 'Data Berhasil Dihapus'
                });
                // reload and close tab
                $('#dg_roa').datagrid('reload');
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
    //end deleteData 
    

    // editing cell
      $.extend($.fn.datagrid.methods, {
        editCell: function(jq,param){
          return jq.each(function(){
            var opts = $(this).datagrid('options');
            var fields = $(this).datagrid('getColumnFields',true).concat($(this).datagrid('getColumnFields'));
            for(var i=0; i<fields.length; i++){
              var col = $(this).datagrid('getColumnOption', fields[i]);
              col.editor1 = col.editor;
              if (fields[i] != param.field){
                col.editor = null;
              }
            }
            $(this).datagrid('beginEdit', param.index);
            for(var i=0; i<fields.length; i++){
              var col = $(this).datagrid('getColumnOption', fields[i]);
              col.editor = col.editor1;
            }
          });
        }
      });

      var editIndex = undefined;
      endEditing = function(){
        if (editIndex == undefined){return true}
        if ($('#dg_roa').datagrid('validateRow', editIndex)){
          $('#dg_roa').datagrid('endEdit', editIndex);
          editIndex = undefined;
          return true;
        } else {
          return false;
        }
      }

      onClickCells = function(index, field){
        if (endEditing()){
          $('#dg_roa').datagrid('selectRow', index)
              .datagrid('editCell', {index:index,field:field});
          editIndex = index;
        }
      }

      saveQTY = function(){
        // save jika cell masih dlm keadaan edit
        $('#dg_roa').datagrid('endEdit', editIndex);      
        $.ajax({
          url: base_url+"request_order_approval/save_qty",
          method: 'POST',
          data: {
                  data_qty : $('#dg_roa').datagrid('getData')
                },
          success : function(response, textStatus){
          //alert(response);
          var response = eval('('+response+')');
          if(response.success){
            $.messager.show({
              title: 'Success',
              msg: 'Data Berhasil Disimpan'
            });
            $('#dg_roa').datagrid('reload');
          }else{
            $.messager.show({
              title: 'Error',
              msg: response.msg
            });
            $('#dg_roa').datagrid('reload');
          }
          }
        });
      }
    

    actionbutton = function(value, row, index){
      var col='';
          col += '<a href="#" onclick="saveQTY(\''+row.id_detail_ro+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Save</a>';

      <?if($this->mdl_auth->CekAkses(array('menu_id'=>37, 'policy'=>'DELETE'))){?>  
          col += '&nbsp;&nbsp; | &nbsp;&nbsp; <a href="#" onclick="deleteData(\''+row.id_detail_ro+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Delete</a>';
      <?]?>
      return col;
    }

  
    $(function(){
      $('#dg_roa').datagrid({
        url:base_url + "request_order_approval/grid_detail/<?=$id_ro?>"
      });
    });

    //# Tombol Bawah
    $(function(){
      var pager = $('#dg_roa').datagrid().datagrid('getPager');  // get the pager of datagrid
      pager.pagination({
        buttons:[
          {
            iconCls:'icon-ok',
            text:'Save All',
            handler:function(){
              saveQTY();
            }
          },
        <?if($this->mdl_auth->CekAkses(array('menu_id'=>37, 'policy'=>'ADD'))){?>
          {
            iconCls:'icon-add',
            text:'Tambah Detail',
            handler:function(){
              newDetail();
            }
          },
        <?}?>
          {
            iconCls:'icon-undo',
            text:'Kembali',
            handler:function(){
              back();
            }
          }
        ]
      });     
    });

    cellStyler = function(value,row,index){
        return 'background-color:#ffee00;color:red;';
    }
    
  });
</script>

<table id="dg_roa" title="Detail Request Order Approval" data-options="
      rownumbers:true,
      singleSelect:true,
      autoRowHeight:false,
      pagination:true,
      pageSize:30,
      fit:true,
      toolbar:'#toolbar_ro',      
      onClickCell: onClickCells,
      ">
  <thead>
    <tr>
     <th field="id_detail_ro" sortable="true" width="150" hidden="true">ID</th>
      <th field="id_ro" sortable="true" width="130">ID Request Order</th>
      <th field="ext_doc_no" sortable="true" width="120">External Doc No</th>
      <th field="kode_barang" sortable="true" width="80">ID Barang</th>
      <th field="nama_barang" sortable="true" width="120">Nama Barang</th>
      <th data-options="field:'qty',width:'100',styler:cellStyler" editor="text">Qty</th>  
      <th field="full_name" sortable="true" width="130">Requestor</th>
      <th field="date_create" sortable="true" width="130">Date Create</th>
      <th field="note" sortable="true" width="200">Note</th>
      <th field="action" align="center" formatter="actionbutton" width="120">Aksi</th>
    </tr>
  </thead>
</table>
