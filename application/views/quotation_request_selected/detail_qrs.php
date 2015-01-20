
<table id="detail_dg_qrs" title="Quotation Request List" data-options="
      rownumbers:true,
      singleSelect:true,
      autoRowHeight:false,
      pagination:true,
      pageSize:30,
      fit:true,
      toolbar:'#detail_toolbar_qrs',
    ">    
  <thead>
    <tr>
      <th field="id_detail_pr " sortable="true" width="80" >ID Detail PR</th>
      <th field="id_pr" sortable="true" width="80" >ID PR</th>
      <th field="id_ro" sortable="true" width="60">ID RO</th>     
      <th field="kode_barang" sortable="true" width="130">Kode Barang</th>
      <th field="nama_barang" sortable="true" width="130">Nama Barang</th>
      <th field="qty" sortable="true" width="90">Qty</th>
      <th field="pick" sortable="true" width="90">Pick</th>
      <th field="sisa" sortable="true" width="90">Sisa</th>
      <th field="action" align="center" formatter="actionQrs" width="150">Aksi</th>
    </tr>
  </thead>
</table>
table><script >
  var url;
  var id_pr = '<?=$id_pr?>';
  $(document).ready(function(){

  newData = function (){
      $('#dialog').dialog({
        title: 'Tambah Detail QRS/PR',
        width: 780,
        height: 330,
        closed: true,
        cache: false,
        href: base_url+'quotation_request_selected/add_detail/'+ id_pr,
        modal: true
      });
       
      $('#dialog').dialog('open');
      url = base_url+'quotation_request_selected/SaveDetailQrs/add';
    }
    // end newData
    saveData = function(){
      
      $('#form1').form('submit',{
        url: url,
        onSubmit: function(){
          return $(this).form('validate');
        },
        success: function(result){
          //alert(result);
          var result = eval('('+result+')');
          if (result.success){
            $.messager.show({
              title: 'Succes',
              msg: 'Data Berhasil Ditambahkan ',
            });
            $('#dialog').dialog('close');   // close the dialog
            $('#dg_do').datagrid('reload');   // reload the user data
          } else {
            $.messager.show({
              title: 'Error',
              msg: result.msg
            });
          }
        }
      });
    }

   done = function (val){
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
            }else{
              $.messager.show({
                title: 'Error',
                msg: response.msg
              });
            }
           }
        });
      }
    }
  actionQrs = function(value, row, index){
      var col='';
          <?php if($this->mdl_auth->CekAkses(array('menu_id'=>15, 'policy'=>'DELETE'))){ ?>
          col += '<a href="#" onclick="del_detail(\''+row.id_pr+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Delete</a>';     
          <?php }?>
          
      return col;
    }
    
    $(function(){ // init
      $('#detail_dg_qrs').datagrid({url:"quotation_request_selected/grid_detail/"+id_pr});
  });
    //tombol bawah
 $(function(){
      var pager = $('#detail_dg_qrs').datagrid().datagrid('getPager'); // get the pager of datagrid
      pager.pagination({
        buttons:[
          {
            iconCls:'icon-add',
            text:'Create',
            handler:function(){
              newData();
            }
          }            
        ]
      });     
    });
 });
</script>