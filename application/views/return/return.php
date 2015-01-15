<script >
  var url;
  $(document).ready(function(){

    doneData = function (val){
        if(confirm("Apakah yakin akan mengirim data ke Alocate Return dengan ID '" + val + "'?")){
          var response = '';
          $.ajax({ type: "GET",
             url: base_url+'retur/doneData/' + val,
             async: false,
             success : function(response){
              var response = eval('('+response+')');
              if (response.success){
                $.messager.show({
                  title: 'Success',
                  msg: 'Data Berhasil Dikirim'
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
    //end sendData 

    add_return = function (val){
      $('#konten').panel({
        href: base_url+'retur/add_return/',
      });
    }
    // end newData

    detail_return = function (val){
      $('#konten').panel({
        href: base_url+'retur/detail_return/' + val,
      });
    }
  
    actionPurchaseRequest = function(value, row, index){
      var col='';
      <?if($this->mdl_auth->CekAkses(array('menu_id'=>21, 'policy'=>'DETAIL'))){?>
          col += '<a href="#" onclick="detail_return(\''+row.id_return+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Detail</a>';     
      <?}?>

      <?if($this->mdl_auth->CekAkses(array('menu_id'=>21, 'policy'=>'APPROVE'))){?>
          col += '&nbsp;&nbsp; | &nbsp;&nbsp;<a href="#" onclick="doneData(\''+row.id_return+'\');" class="easyui-linkbutton" iconCls="icon-edit"plain="false">Done</a>';
      <?}?>
      return col;
    }

    // filter
    filter = function(){
      $('#dg').datagrid('load',{
        id_return : $('#s_id_return').val(),
        id_receive : $('#s_id_receive').val(),
      });
      //$('#dg').datagrid('enableFilter');
    }
    
    $(function(){ // init
      $('#dg').datagrid({url:"retur/grid"});      
  });

  //# Tombol Bawah
    $(function(){
      var pager = $('#dg').datagrid().datagrid('getPager'); // get the pager of datagrid
      pager.pagination({
        buttons:[
        <?if($this->mdl_auth->CekAkses(array('menu_id'=>21, 'policy'=>'ADD'))){?>
          {
            iconCls:'icon-add',
            text:'Tambah Data',
            handler:function(){
              add_return();
            }
          }
        <?}?>
        ]
      });     
    }); 

});
</script>

<div id="toolbar" style="padding:5px;height:auto">
  <div style="margin-bottom:5px">   
  </div>
  <div class="fsearch">
    <table width="400" border="0">
      <tr>
       <td>ID Return</td>
      <td>: 
        <input name="s_id_return" id="s_id_return" size="15">
      </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;&nbsp;<a href="#" onclick="filter()" class="easyui-linkbutton" iconCls="icon-search">Search</a></td>
      </tr>
      <tr>
      <td>ID Receive</td>
      <td>: 
        <input name="s_id_receive" id="s_id_receive" size="15">
      </td>

      <td>&nbsp;</td>
      </tr>
    </table>
  </div>
</div>

<table id="dg" title="Return List" data-options="
      rownumbers:true,
      singleSelect:true,
      autoRowHeight:false,
      pagination:true,
      pageSize:30,
      fit:true,
      toolbar:'#toolbar',
    ">    
  <thead>
    <tr>
      <th field="id_return" sortable="true" width="80" >ID Return</th>
      <th field="id_receive" sortable="true" width="80">ID Receive</th>     
      <th field="date_create" sortable="true" width="130">Date Create</th>
      <th field="full_name" sortable="true" width="100">Requestor</th>
      <th field="status" sortable="true" width="100">Status</th>
      <th field="action" align="center" formatter="actionPurchaseRequest" width="150">Aksi</th>
    </tr>
  </thead>
</table>


