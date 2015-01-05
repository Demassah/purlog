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
          col += '<a href="#" onclick="detail_return(\''+row.id_return+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Detail</a>';     

          col += '&nbsp;&nbsp; | &nbsp;&nbsp;<a href="#" onclick="doneData(\''+row.id_return+'\');" class="easyui-linkbutton" iconCls="icon-edit"plain="false">Done</a>';
      return col;
    }
    
    $(function(){ // init
      $('#dg').datagrid({url:"retur/grid"});      
  });

  //# Tombol Bawah
    $(function(){
      var pager = $('#dg').datagrid().datagrid('getPager'); // get the pager of datagrid
      pager.pagination({
        buttons:[
          {
            iconCls:'icon-add',
            text:'Tambah Data',
            handler:function(){
              add_return();
            }
          }            
        ]
      });     
    }); 

});
</script>

<!-- <div id="toolbar_purchase" style="padding:5px;height:auto">
  <div class="fsearch">
    <table>
      <tr>
          <td>&nbsp;&nbsp;<a href="#" onclick="detail()" class="easyui-linkbutton" iconCls="icon-detail">Detail</a>
              &nbsp;&nbsp;<a href="#" onclick="available()" class="easyui-linkbutton" iconCls="icon-ok">Picking</a>
              &nbsp;&nbsp;<a href="#" onclick="lock()" class="easyui-linkbutton" iconCls="icon-login">Lock</a>
              &nbsp;&nbsp;<a href="#" onclick="pending()" class="easyui-linkbutton" iconCls="icon-redo">pending</a>
          </td> 
      </tr>
    </table>
  </div>
</div> -->

<table id="dg" title="Return List" data-options="
      rownumbers:true,
      singleSelect:true,
      autoRowHeight:false,
      pagination:true,
      pageSize:30,
      fit:true,
      toolbar:'#toolbar_purchase',
    ">    
  <thead>
    <tr>
      <th field="id_return" sortable="true" width="80" >ID Return</th>
      <th field="id_receive" sortable="true" width="80">ID Receive</th>     
      <th field="date_create" sortable="true" width="130">Date Create</th>
      <th field="user_id" sortable="true" width="100">Requestor</th>
      <th field="status" sortable="true" width="100">Status</th>
      <th field="action" align="center" formatter="actionPurchaseRequest" width="150">Aksi</th>
    </tr>
  </thead>
</table>


