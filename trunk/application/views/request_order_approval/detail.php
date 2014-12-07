<script type="text/javascript">
  var url;
  $(document).ready(function(){

    add = function (){
      $('#dialog').dialog({
        title: 'Add Detail Request approval',
         width: 400,
        height: 300,
        closed: true,
        cache: false,
        href: base_url+'request_order_approval/add',
        modal: true
      });
       
      $('#dialog').dialog('open');
    }

     back = function (val){
      //detail
      $('#konten').panel({
        href: base_url+'request_order_approval/index',
      });

    }

    app = function (val){
      //detail
      $('#konten').panel({
        href: base_url+'picking_req_order_selected/lock',
      });

    }

    reject = function (val){
      //detail
      $('#konten').panel({
        href: base_url+'picking_req_order_selected/pending',
      });

    }

   update = function (){
        $('#dialog').dialog({
          title: 'Edit Kategori',
          width: 380,
          height: 130,
          closed: true,
          cache: false,
          href: base_url+'kategori/edit/',
          modal: true
        });
        
        $('#dialog').dialog('open');  
        url = base_url+'kategori/save/edit';
      // }
    }

    actiondetail = function(value, row, index){
      var col='';
          col += '&nbsp;&nbsp; &nbsp;&nbsp;<a href="#" onclick="update(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">update</a>';      
      return col;
    }
    
    $(function(){
      $('#dtgrd').datagrid({
        url:base_url + "request_order_approval/grid"
      });
    });
    

    //# Tombol Bawah
    $(function(){
      var pager = $('#dtgrd').datagrid().datagrid('getPager'); // get the pager of datagrid
      pager.pagination({
        buttons:[
          {
            iconCls:'icon-add',
            text:'Tambah Detail',
            handler:function(){
              add();
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

<div id="toolbar_detail" style="padding:5px;height:auto">
  <div class="fsearch">
    <table>
      <tr>
          <td>
              &nbsp;&nbsp;<a href="#" onclick="app()" class="easyui-linkbutton" iconCls="icon-login">App</a>
              &nbsp;&nbsp;<a href="#" onclick="reject()" class="easyui-linkbutton" iconCls="icon-redo">Reject</a>
          </td> 
      </tr>     
    </table>
  </div>
</div>

<table id="dtgrd" title="Detail Request Order Approval" data-options="
      rownumbers:true,
      singleSelect:true,
      autoRowHeight:false,
      pagination:true,
      pageSize:30,
      fit:true,
      toolbar:'#toolbar_detail',
      ">
  <thead>
   <tr>
      <th data-options="field:'id_krs_detail',width:'100', hidden:true">aa</th>
      <th field="nama_kategori" sortable="true" width="120">ID Detail</th>
      <th field="kode_barang" sortable="true" width="120">ID RO</th>
      <th field="kode_barang" sortable="true" width="120">ID Item</th>
      <th field="kode_barang" sortable="true" width="120">Qty</th>
      <th field="nama_barang" sortable="true" width="350">Description</th>   
      <th field="action" align="center" formatter="actiondetail" width="140">Aksi</th>
    </tr>
  </thead>
</table>

