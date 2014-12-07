<script >
  var url;
  $(document).ready(function(){

      add = function (){
      $('#detail_dialog').dialog({
        title: 'Add Request Order',
        width: $(window).width() * 0.8,
        height: $(window).height() * 0.99,
        closed: true,
        cache: false,
        href: base_url+'picking_req_order_selected/add_detail_pr',
        modal: true
      });
       
      $('#detail_dialog').dialog('open');
      url = base_url+'picking_req_order_selected/save/add_detail_pr';
    }
    // end newData

    detailData = function (){
      $('#konten').panel({
        href: base_url+'picking_req_order_selected/detail',
      });
    }
    
    available = function (){
      $('#konten').panel({
        href: base_url+'picking_req_order_selected/available',
      });
    }

    lock = function (){
      $('#konten').panel({
        href:base_url+'picking_req_order_selected/lock'
      });
    }

    pending = function (){
      $('#konten').panel({
        href:base_url+'picking_req_order_selected/pending'
      });
    }

    detail_pr = function (){
      $('#konten').panel({
        href:base_url+'picking_req_order_selected/detail_pr'
      });
    }
  
    actiondetail = function(value, row, index){
      var col='';
          col += '<a href="#" onclick="detail_pr(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Detail</a>';     
      return col;
    }
    
    $(function(){ // init
      $('#dg').datagrid({url:"picking_req_order_selected/grid"});      
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
              add();
            }
          }            
        ]
      });     
    }); 

});
</script>

<div id="toolbar_purchase" style="padding:5px;height:auto">
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
</div>

<table id="dg" title="Purchase Request" data-options="
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
      <th data-options="field:'id_krs_detail',width:'100', hidden:true">aa</th>
      <th field="nama_kategori" sortable="true" width="120">ID Purchase Request</th>
      <th field="nama_kategori" sortable="true" width="120">ID Detail ROS</th>
      <th field="kode_barang" sortable="true" width="120">ID ROS</th>
      <th field="kode_barang" sortable="true" width="120">ID Item</th>
      <th field="kode_barang" sortable="true" width="80">Qty</th>
      <th field="nama_sub_kategori" sortable="true" width="475">Deskripsi</th>  
      <th field="action" align="center" formatter="actiondetail" width="60">Aksi</th>
    </tr>
  </thead>
</table>


