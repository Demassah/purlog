var url;
	$(document).ready(function(){
	
	DetailData = function (val){
			//detail
			$('#konten').panel({
				href: base_url+'sample',
			});

		}

	actionbutton = function(value, row, index){
			var col='';
			//if (row.kd_fakultas != null) {

			if(detail){
					col += '<a href="#" onclick="DetailData(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">List QR</a>';
			}

			//}
			return col;
		}
		
		$(function(){
			$('#dg').datagrid({
				url:base_url + "request_order/grid"
			});
		});
		
	});