<script >
  var url;
  $(document).ready(function(){

      add = function (){
      $('#dialog').dialog({
        title: 'Add Request Order',
        width: $(window).width() * 0.8,
        height: $(window).height() * 0.99,
        closed: true,
        cache: false,
        href: base_url+'picking_req_order_selected/add_detail_pr',
        modal: true
      });
       
      $('#dialog').dialog('open');
      url = base_url+'picking_req_order_selected/save/add_detail_pr';
    }
    // end newData

    detail = function (val){      
      if(val==null){
          var row = $('#dg').datagrid('getData');              
          var id = row.rows[0].id_ro;
          val = id;
      }
      $('#konten').panel({
        href: base_url+'picking_req_order_selected/detail/' + val,
      });
    }

    available = function (val){      
      if(val==null){
          var row = $('#dg').datagrid('getData');              
          var id = row.rows[0].id_ro;
          val = id;
      }
      $('#konten').panel({
        href: base_url+'picking_req_order_selected/available/' + val,
      });
    }

    lock = function (val){

      if(val==null){
          var row = $('#dg').datagrid('getData');              
          var id = row.rows[0].id_ro;
          val = id;
      }
      $('#konten').panel({
        href: base_url+'picking_req_order_selected/lock/' + val,
      });
    }

    pending = function (val){
       if(val==null){
          var row = $('#dg').datagrid('getData');              
          var id = row.rows[0].id_ro;
          val = id;
      }
      $('#konten').panel({
        href: base_url+'picking_req_order_selected/pending/' + val,
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
      <th field="id_pr" sortable="true" width="80" >ID PR</th>
      <th field="id_ro" sortable="true" width="80" >ID RO</th>
      <th field="full_name" sortable="true" width="130">Requestor</th>
      <th field="departement_name" sortable="true" width="130">Departement</th>
      <th field="purpose" sortable="true" width="120">Purpose</th>
      <th field="cat_req" sortable="true" width="120">Category Request</th>
      <th field="ext_doc_no" sortable="true" width="120">External Doc No</th>
      <th field="ETD" sortable="true" width="100">ETD</th>
      <th field="date_create" sortable="true" width="130">Date Create</th>
      <th field="action" align="center" formatter="actionbutton" width="120">Aksi</th>
    </tr>
  </thead>
</table>


