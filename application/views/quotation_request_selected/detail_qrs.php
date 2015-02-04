
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
      
      <th field="id_qrs" sortable="true" width="80" >ID QRS</th>
      <th field="id_detail_qrs" sortable="true" width="120" >ID DETAIL QRS</th>
      <th field="id_pr" sortable="true" width="60">ID RO</th>     
      <th field="id_detail_pr" sortable="true" width="130">ID detail PR</th>
      <th field="kode_barang" sortable="true" width="120">Kode Barang</th>
      <th field="nama_barang" sortable="true" width="130">Nama Barang</th>
      <th field="qty" sortable="true" width="90">Qty</th>
      <th field="action" align="center" formatter="actionQrs" width="150">Aksi</th>
    </tr>
  </thead>
</table>
<script >
  var url;
  var id_qrs = '<?=$id_qrs?>';

  $(document).ready(function(){

  Add_detail = function (val){
      $('#dialog').dialog({
        title: 'Tambah Detail QRS/PR',
        width: 780,
        height: 330,
        closed: true,
        cache: false,
        href: base_url+'quotation_request_selected/add_detail/'+ id_qrs,
        modal: true
      });
       
      $('#dialog').dialog('open');
      url = base_url+'quotation_request_selected/SaveDetailQrs/add';
    }
    // end newData
    saveData = function () {
      var id_qrs = $('.id_qrs').val();
      var id_pr = $('.id_pr').val();
      var pick = $('.pick_input').map(function(){
          return $(this).val();
         }).get();
      var id_detail_pr = $('.detail_pr').map(function(){
          return $(this).val();
         }).get();
      $.ajax({
        url: base_url+'quotation_request_selected/SaveDetailQrs/add',
        type  : 'POST',
        data  : 'pick='+pick+'&id_detail_pr='+id_detail_pr+'&id_qrs='+id_qrs+'&id_pr='+id_pr,
        success : function(response, textStatus){
         //alert(response);
         var response = eval('('+response+')');
         if(response.success){
            $.messager.show({
              title: 'Success',
              msg: 'Data Berhasil Disimpan'
            });
            $('#dialog').dialog('close');
            $('#detail_dg_qrs').datagrid('reload');
          }else{
            $.messager.show({
              title: 'Error',
              msg: response.msg
            });
          }
        }
      });
    }

   Del_detail = function (val){
      if(confirm("Apakah yakin akan menghapus data  '" + val + "'?")){
        var response = '';
        $.ajax({ type: "GET",
           url: base_url+'quotation_request_selected/delete_detail/' + val,
           async: false,
           success : function(response){
            var response = eval('('+response+')');
            if (response.success){
              $.messager.show({
                title: 'Success',
                msg: 'Data Berhasil Di Hapus'
              });
              $('#detail_dg_qrs').datagrid('reload');
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
          col += '<a href="#" onclick="Del_detail(\''+row.id_detail_qrs+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Delete</a>';     
          <?php }?>
          
      return col;
    }
  back = function (){
      $('#konten').panel({
        href:base_url+'quotation_request_selected/index'
      });
    }

    $(function(){ // init
      $('#detail_dg_qrs').datagrid({url:"quotation_request_selected/grid_detail/"+id_qrs});
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
              Add_detail();
            }
          },
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
 });
</script>