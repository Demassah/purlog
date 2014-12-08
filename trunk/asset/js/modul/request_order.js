	var url;
	$(document).ready(function(){

		newData = function (){
			$('#dialog').dialog({
				title: 'Add Request Order',
				width: 380,
				height: 270,
				closed: true,
				cache: false,
				href: base_url+'request_order/add',
				modal: true
			});
			 
			$('#dialog').dialog('open');
			url = base_url+'request_order/save/add';
		}
		// end newData
		
			DetailData = function (val){
			$('#dialog').dialog({
				title: 'Detail Request Order',
				width: 625,
				height: 600,
				closed: true,
				cache: false,
				href: base_url+'request_order/detail/'+val,
				modal: true
			});
			 
			$('#dialog').dialog('open');
			url = base_url+'request_order/save';
		}
		// end newData
		
		actionbutton = function(value, row, index){
			var col='';
			//if (row.kd_fakultas != null) {
			if(del){
					col = '<a href="#" onclick="DeleteData(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Delete</a>';
			}

			if(detail){
					col += '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#" onclick="DetailData(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Detail</a>';
			}

					col += '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#" onclick="SendData(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Send</a>';

			//}
			return col;
		}
		
		$(function(){
			var pager = $('#dg').datagrid().datagrid('getPager');	// get the pager of datagrid
			pager.pagination({
				buttons:[
				if(tambah){
						iconCls:'icon-add',
						text:'Tambah Data',
						handler:function(){
						newData();
						}
					}
				]
			});			
		});

		$(function(){
			$('#dg').datagrid({
				url:base_url + "request_order/grid"
			});
		});


		
		
	});

