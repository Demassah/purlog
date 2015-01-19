<script >
  var url;
  $(document).ready(function(){

    doneData = function (val){
        if(confirm("Apakah yakin akan mengirim data ke QRS '" + val + "'?")){
          var response = '';
          $.ajax({ type: "GET",
             url: base_url+'purchase_request/doneData/' + val,
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
    
    deleteData = function (val){
        if(confirm("Apakah yakin akan menghapus data dengan ID '" + val + "'?")){
          var response = '';
          $.ajax({ type: "GET",
             url: base_url+'purchase_request/deleteData/' + val,
             async: false,
             success : function(response){
              var response = eval('('+response+')');
              if (response.success){
                $.messager.show({
                  title: 'Success',
                  msg: 'Data Berhasil Dihapus'
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
    
    add_pr = function (val){
      $('#konten').panel({
        href: base_url+'purchase_request/add_pr/',
      });
    }
    // end newData

    detail_pr = function (val){
      $('#konten').panel({
        href: base_url+'purchase_request/detail_pr/' + val,
      });
    }
  
    actionPurchaseRequest = function(value, row, index){
      var col='';
        <?php if($this->mdl_auth->CekAkses(array('menu_id'=>14, 'policy'=>'DETAIL'))){ ?>
          col += '<a href="#" onclick="detail_pr(\''+row.id_pr+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Detail</a>';     
        <?php }?>
        <?php if($this->mdl_auth->CekAkses(array('menu_id'=>14, 'policy'=>'APPROVE'))){ ?>
          col += '&nbsp;&nbsp; | &nbsp;&nbsp;<a href="#" onclick="doneData(\''+row.id_pr+'\');" class="easyui-linkbutton" iconCls="icon-edit"plain="false">Done</a>';
        <?php }?>
        <?php if($this->mdl_auth->CekAkses(array('menu_id'=>14, 'policy'=>'DELETE'))){ ?>
          col += '&nbsp;&nbsp; | &nbsp;&nbsp;<a href="#" onclick="deleteData(\''+row.id_pr+'\');" class="easyui-linkbutton" iconCls="icon-edit"plain="false">Delete</a>';
        <?php }?>
      return col;
    }

    // filter
    filter = function(){
      $('#dg').datagrid('load',{
        departement_id : $('#s_departement_id').val(),
        id_ro : $('#s_id_ro').val(),
        id_pr : $('#s_id_pr').val(),
      });
      //$('#dg').datagrid('enableFilter');
    }
    
    $(function(){ // init
      $('#dg').datagrid({url:"purchase_request/grid"});      
  });

  //# Tombol Bawah
    $(function(){
      var pager = $('#dg').datagrid().datagrid('getPager'); // get the pager of datagrid
      pager.pagination({
        buttons:[
          {
            iconCls:'icon-add',
            text:'Create PR',
            handler:function(){
              add_pr();
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

<div id="toolbar_purchase" style="padding:5px;height:auto">
  <div style="margin-bottom:5px">   
  </div>
  <div class="fsearch">
    <table width="650" border="0">
      <tr>
      <td>Departement</td>
      <td>: 
        <select id="s_departement_id" name="s_departement_id" style="width:120px;">
          <?=$this->mdl_prosedur->OptionDepartement();?>
        </select>
      </td>
      <td>ID PR</td>
      <td>: 
        <input name="s_id_pr" id="s_id_pr" size="15">
      </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;&nbsp;<a href="#" onclick="filter()" class="easyui-linkbutton" iconCls="icon-search">Search</a></td>
      </tr>
      <tr>
      <td>ID RO</td>
      <td>: 
        <input name="s_id_ro" id="s_id_ro" size="15">
      </td>

      <td>&nbsp;</td>
      </tr>
    </table>
  </div>
</div>

<table id="dg" title="Purchase Request List" data-options="
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
      <th field="id_pr" sortable="true" width="80" >ID PR</th>
      <th field="id_ro" sortable="true" width="60">ID RO</th>     
      <th field="full_name" sortable="true" width="130">Requestor</th>
      <th field="departement_name" sortable="true" width="130">Departement</th>
      <th data-options="field:'purpose',width:'90',styler:cellStyler" editor="text">Purpose</th>
      <th field="cat_req" sortable="true" width="120">Category Request</th>
      <th field="ext_doc_no" sortable="true" width="120">External Doc No</th>
      <th field="ETD" sortable="true" width="100">ETD</th>
      <th field="date_create" sortable="true" width="130">Date Create</th>
      <th field="action" align="center" formatter="actionPurchaseRequest" width="170">Aksi</th>
    </tr>
  </thead>
</table>


