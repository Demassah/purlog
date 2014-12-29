<table id="dg_qrs" title="Quotation Request List" data-options="
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
      <th field="purpose" sortable="true" width="90">Purpose</th>
      <th field="cat_req" sortable="true" width="120">Category Request</th>
      <th field="ext_doc_no" sortable="true" width="120">External Doc No</th>
      <th field="ETD" sortable="true" width="100">ETD</th>
      <th field="date_create" sortable="true" width="130">Date Create</th>
      <th field="action" align="center" formatter="actionPurchaseRequest" width="150">Aksi</th>
    </tr>
  </thead>
</table>

<script >
  var url;
  $(document).ready(function(){

    doneData = function (val){
        if(confirm("Apakah yakin akan mengirim data ke Purchase Order '" + val + "'?")){
          var response = '';
          $.ajax({ type: "GET",
             url: base_url+'quotation_request_selected/Done/' + val,
             async: false,
             success : function(response){
              var response = eval('('+response+')');
              if (response.success){
                $.messager.show({
                  title: 'Success',
                  msg: 'Data Berhasil Di save'
                });
                $('#dg_qrs').datagrid('reload');
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
    //end sendData 
    Add_Qrs = function (val){
      $('#konten').panel({
        href: base_url+'quotation_request_selected/add_qrs/' + val,
      });
    }
  
    actionPurchaseRequest = function(value, row, index){
      var col='';
          // col += '<a href="#" onclick="detail_pr(\''+row.id_pr+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Detail</a>';     
          
          col += '<a href="#" onclick="Add_Qrs(\''+row.id_pr+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">QRS</a>';     

          col += '&nbsp;&nbsp; | &nbsp;&nbsp;<a href="#" onclick="doneData(\''+row.id_pr+'\');" class="easyui-linkbutton" iconCls="icon-edit"plain="false">Done</a>';
      return col;
    }
    
    $(function(){ // init
      $('#dg_qrs').datagrid({url:"quotation_request_selected/grid"});      
  });
});
</script>
