<script type="text/javascript">
    var url;
  $(document).ready(function(){

    back = function (val){
      $('#konten').panel({
        href:base_url+'request_order_logistic/index'
      });
    }
  
    $(function(){
      $('#dg_rol').datagrid({
        url:base_url + "request_order_logistic/grid_detail/<?=$id_ro?>"
      });
    });

    //# Tombol Bawah
    $(function(){
      var pager = $('#dg_rol').datagrid().datagrid('getPager');  // get the pager of datagrid
      pager.pagination({
        buttons:[
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

<table id="dg_rol" title="Detail Request Order Logistic" data-options="
      rownumbers:true,
      singleSelect:true,
      autoRowHeight:false,
      pagination:true,
      pageSize:30,
      fit:true,
      toolbar:'#toolbar_ro',
      ">
  <thead>
    <tr>
      <th field="id_detail_ro" sortable="true" width="150" hidden="true">ID</th>
      <th field="id_ro" sortable="true" width="130">ID Request Order</th>
      <th field="ext_doc_no" sortable="true" width="120">External Doc No</th>
      <th field="nama_barang" sortable="true" width="120">Nama Barang</th>
      <th field="qty" sortable="true" width="120">Qty</th>
      <th field="full_name" sortable="true" width="130">Requestor</th>
      <th field="date_create" sortable="true" width="130">Date Create</th>
      <th field="note" sortable="true" width="200">Note</th>
      <!--<th field="action" align="center" formatter="actionbutton" width="80">Aksi</th>-->
    </tr>
  </thead>
</table>
