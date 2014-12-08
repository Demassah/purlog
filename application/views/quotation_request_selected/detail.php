<script>
  
  var url;
  $(document).ready(function(){

    detail = function (){
      $('#dialog').dialog({
        title: 'Picking Request Order Selected',
        width: $(window).width() * 0.8,
        height: $(window).height() * 0.99,
        closed: true,
        cache: false,
        href: base_url+'request_order_approval/detail',
        modal: true
      });
       
      $('#dialog').dialog('open');
      url = base_url+'request_order_approval/save/add';
    }

    add = function (){
      $('#dialog').dialog({
        title: 'Add Detail Request approval',
         width: 600,
        height: 400,
        closed: true,
        cache: false,
        href: base_url+'request_order_approval/add',
        modal: true
      });
       
      $('#dialog').dialog('open');
      url = base_url+'request_order_approval/save/add';
    }

    app = function (){
      $('#dialog').dialog({
        title: 'Lock Picking Request Order Selected',
        width: $(window).width() * 0.8,
        height: $(window).height() * 0.99,
        closed: true,
        cache: false,
        href: base_url+'picking_req_order_selected/lock',
        modal: true
      });
       
      $('#dialog').dialog('open');
      url = base_url+'departement/save/add';
    }
    

    reject = function (){
      $('#dialog').dialog({
        title: 'Pending Picking Request Order Selected',
        width: $(window).width() * 0.8,
        height: $(window).height() * 0.99,
        closed: true,
        cache: false,
        href: base_url+'picking_req_order_selected/pending',
        modal: true
      });
       
      $('#dialog').dialog('open');
      url = base_url+'departement/save/add';
    }

    update = function (val){
      // var row = $('#dg').datagrid('getSelected');
      // if (row){
        $('#dialog').dialog({
          title: 'Edit Kategori',
          width: 380,
          height: 130,
          closed: true,
          cache: false,
          href: base_url+'kategori/edit/'+val,
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

    //# Tombol Bawah
    $(function(){
      var pager = $('#dg').datagrid().datagrid('getPager'); // get the pager of datagrid
      pager.pagination({
        buttons:[
          {
            iconCls:'icon-add',
            text:'Alocate All',
            handler:function(){
              newData();
            }
          }       
        ]
      });     
    });
    

    $(function(){ // init
      $('#dtgrd').datagrid({url:"picking_req_order_selected/grid"});  
      //$('#dg').datagrid('enableFilter'); 
    }); 
    
  });
</script>

<table id="dtgrd" data-options="
      rownumbers:true,
      singleSelect:false,
      autoRowHeight:false,
      fit:true,
      toolbar:'#toolbar_details',
    ">    
  <thead>
    <tr>
      <th data-options="field:'id_krs_detail',width:'100', hidden:true"></th>
      <th field="nama_kategori" sortable="true" width="120">ID Detail</th>
      <th field="kode_barang" sortable="true" width="120">ID RO</th>
      <th field="kode_barang" sortable="true" width="120">ID Item</th>
      <th field="kode_barang" sortable="true" width="120">Qty</th>
      <th field="kode_barang" sortable="true" width="120">Description</th>   
      <th field="action" align="center" formatter="actiondetail" width="140">Aksi</th>
    </tr>
  </thead>
</table>
<div id="toolbar_details" style="padding:5px;height:auto">
  <div>
    <table>
      <tr>
          <td>&nbsp;&nbsp;<a href="#" onclick="detail()" class="easyui-linkbutton" iconCls="icon-ok">Detail</a>
              &nbsp;&nbsp;<a href="#" onclick="app()" class="easyui-linkbutton" iconCls="icon-login">App</a>
              &nbsp;&nbsp;<a href="#" onclick="reject()" class="easyui-linkbutton" iconCls="icon-redo">Reject</a></td> 
      </tr>
      <tr> 
          <td>&nbsp;</td>
      </tr>   
      <tr> 
        <td>&nbsp;&nbsp;<a href="#" onclick="add()" class="easyui-linkbutton" iconCls="icon-add">Add</a></td>
      </tr>     
    </table>
  </div>
</div>


