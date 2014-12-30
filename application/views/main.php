<?php // VIEW MAIN;
date_default_timezone_set('Asia/Jakarta');
?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Sistem Informasi Purchasing Logistic</title>
		<link rel="shortcut icon" href="<?php echo base_url();?>asset/images/favicon.png">
		<link rel="stylesheet" type="text/css" href="<?=base_url();?>asset/css/style.css" />
		<link rel="stylesheet" type="text/css" href="<?=base_url();?>asset/easyui/themes/metro/easyui.css" />
		<link rel="stylesheet" type="text/css" href="<?=base_url();?>asset/select/select2.css"/>
		<!--<link rel="stylesheet" type="text/css" href="<?=base_url();?>asset/easyui/themes/bootstrap/easyui.css" />-->
		<link rel="stylesheet" type="text/css" href="<?=base_url();?>asset/easyui/themes/icon.css" />
		<script type="text/javascript" src="<?=base_url();?>asset/easyui/jquery.min.js"></script>
		<script type="text/javascript" src="<?=base_url();?>asset/easyui/jquery.easyui.min.js"></script>
		<script type="text/javascript" src="<?=base_url();?>asset/easyui/plugins/jquery.datagrid-groupview.js"></script>
		<script type="text/javascript" src="<?=base_url();?>asset/easyui/plugins/jquery.datagrid-filter.js"></script>
		<script type="text/javascript" src="<?=base_url();?>asset/easyui/plugins/jquery.datagrid-detailview.js"></script>
		<script type="text/javascript" src="<?=base_url();?>asset/js/ckeditor/ckeditor.js"></script>
		<script type="text/javascript" src="<?=base_url();?>asset/select/select2.js"></script>
		<script type="text/javascript" src="<?=base_url();?>asset/js/modernizr.custom.05095.js"></script>
		<script type="text/javascript" src="<?=base_url();?>asset/easyui/plugins/jquery.edatagrid.js"></script>
		<script type="text/javascript" src="<?=base_url();?>asset/js/numericInput.min.js"></script>
		<script type="text/javascript" src="<?=base_url();?>asset/currency/autoNumeric.js"></script>
				 
	</head>
	<body class="easyui-layout">
	<input type="hide" value="<?=base_url();?>"/>
		<script>
			base_url = '<?=base_url();?>';
			$(document).ready(function(){
				$('#konten').panel({
								href:base_url+'main/dashboard'
				});			 
				check_login = function(){
					$.ajax({
						url: base_url+"auth/cekstatuslogin",
						data: { },
						success : function(data, textStatus){
									//alert(data);
									if (data=="0" || data==""){
													window.location.replace(base_url+"auth/login");
									}
						},
						complete: function(xmlHttp) {
									// xmlHttp is a XMLHttpRquest object
									//if (xmlHttp.status==200) window.location.replace(base_url+"security/login");
						}
					});
				}					 
				// cek login
				jQuery(document).ajaxStart(function(){
								check_login();
				});					 
				// load menu kiri
				$('#leftMenu').tree({
					checkbox: false,
					url: base_url+'auth/loadMenu',
					onClick:function(node){        
					$(this).tree('toggle', node.target);
					var b = $('#tt2').tree('isLeaf', node.target);
						if (b){
							setTimeout(function(){
								//addTab(node.text,node.attributes.url);
								//alert('you click '+node.attributes.url);
								$('#konten').panel({
										href:base_url+node.attributes.url
								});
							}, 100);
						};
					}	 
				});
				//var node1 = $('#leftMenu').tree('find',1);
				// var node2 = $('#leftMenu').tree('find',16);
				// $('#leftMenu').tree('expandTo', node2.target).tree('select', node1.target);
			 
				// format date picker
				DateFormatter = function(date){
					var y = date.getFullYear();
					var m = date.getMonth()+1;
					var d = date.getDate();
					//return y+'/'+(m<10?('0'+m):m)+'/'+(d<10?('0'+d):d);
					return (d<10?('0'+d):d) + '/' + (m<10?('0'+m):m) + '/' + y;
				}
				DateParser = function(s){
					if (!s) return new Date();
					var ss = (s.split('/'));
					var y = parseInt(ss[2],10);
					var m = parseInt(ss[1],10);
					var d = parseInt(ss[0],10);
					if (!isNaN(y) && !isNaN(m) && !isNaN(d)){
									return new Date(y,m-1,d);
					} else {
									return new Date();
					}
				}					 
				// inisialisasi dialog box
				$('#dialog').dialog({
					style:{background:'#ffffff'},
					autoOpen: false,
					show: {
					effect: "blind",
					duration: 1000
					},
					hide: {
					effect: "explode",
					duration: 1000
					}
				});
				// init
				check_login();
			});
		</script>
				 
			<style type="text/css">
			#fm/*<?=$objectId;?>*/{
				margin:0;
				padding:10px 30px;
			}
			.ftitle{
				font-size:14px;
				font-weight:bold;
				color:#666;
				padding:5px 0;
				margin-bottom:10px;
				border-bottom:1px solid #ccc;
			}
			.fitem{
				margin-bottom:5px;
			}
			.fitem label{
				display:inline-block;
				min-width:30px;
			}		 
			.fsearch{
				background:#fafafa;
				border-radius:2px;
				-moz-border-radius:0px;
				-webkit-border-radius: 5px;
				-moz-box-shadow: 2px 2px 3px rgba(0, 0, 0, 0.2);
				-webkit-box-shadow: 2px 2px 3px rgba(0, 0, 0, 0.2);
				filter: progid:DXImageTransform.Microsoft.Blur(pixelRadius=2,MakeShadow=false,ShadowOpacity=0.2);
				margin-bottom:0px;
				border: 1px solid #C5C5C5;
				color: #15428B;
				font-size: 12px;
				position: relative;
			}
			.fsearch div{
				background:url('<?=base_url();?>public/css/themes/gray/images/panel_title.gif') repeat-x;
				height:200%;
				border-bottom: 1px solid #99BBE8;
				color:#15428B;
				font-size:10pt;
				text-transform:uppercase;
				font-weight: bold;
				padding: 3px 5px 0px 5px;
				position: relative;
			}
			.fsearch table{
				padding: 8px;
			}
			.fsearch label{
				display:inline-block;
				width:60px;
			}
			.fitemArea{
				margin-bottom:5px;
				text-align:left;
				/* border:1px solid blue; */
			}
			.fitemArea label{
				display:inline-block;
				width:84px;
				margin-bottom:5px;
			}		 
			.tbl {
				width: 100%;
				padding: 0;
				margin: 0;
			}		 
			.tbl th{
				font: normal 12px;
				color: #4f6b72;
				border-right: 1px solid #C1DAD7;
				border-bottom: 1px solid #C1DAD7;
				border-top: 1px solid #C1DAD7;
				border-left: 1px solid #C1DAD7;
				/*text-align: left;*/
				padding: 2px 2px 3px 4px;
				margin:0;
				background: #CAE8EA url(<?=base_url();?>asset/images/th.png) repeat-x;
			}	 
			.tbl td{
				border-right: 1px solid #C1DAD7;
				border-left: 1px solid #C1DAD7;
				border-top: 1px solid #C1DAD7;
				border-bottom: 1px solid #C1DAD7;
				padding: 3px 3px 3px 5px;
				margin:0;
			}		 
			.tbl tr{
				margin:0;
			}
			</style>
		<div data-options="region:'north',border:false" style="height:93px;background:#FFF;background: fixed  no-repeat top left;">
			<!-- bagian atas -->
			<div id="topheader">
				<div class="bg" >
					<div class="logo" style="margin-top: 10px;"><a href="">home</a></div>
					<div class="title" style="margin-top: 30px;">
						<h1>Sistem Informasi Purchasing Logistic</h1>
					</div>			 
					<div class="rpanel">
						<div class="left" style="margin-top: 10px;">
							<h4>Selamat Datang :</h4>
							<!-- <p><a href="#">Administrator</a></p> -->
							<hr>
							<a href="#" onclick="editData();" class="inlink">Setting dan Ubah Password</a>
						</div>
							<div class="right" style="margin-top: 5px;"><a href="<?=base_url()?>auth" class="logout">LOGOUT</a></div>
							<div class="clear"></div>
					</div>
					<div class="clear"></div>

				</div>
			</div>
			<!--<div style="padding:2px;border:1px solid #ddd;float:right;margin:28px 0px 0px 0px;background-color:#9cd4f4;color:#F00;">
							<a href="<?=base_url()?>auth/logout" class="easyui-linkbutton" data-options="plain:true">Ubah Password</a>
							<a href="<?=base_url()?>auth/logout" class="easyui-linkbutton" data-options="plain:true">Logout</a>
			</div>-->
		</div>
		<div data-options="region:'west',split:true,title:'Menu Utama'" style="width:250px;padding:10px;">
			<!-- bagian menu -->
			<ul id="leftMenu" ></ul> 
		</div>
		<!-- bagian bawah -->
		<!--<div data-options="region:'south',border:false" style="height:20px;background:#817e68;padding:3px;color:#FFFFFF;">
			<div id="versionBar" align="center">
							Copyright 2014  All Rights Reserved
			</div>
		</div>-->
		<div data-options="region:'center'">
			<!-- bagian konten -->
			<div id="konten" class="easyui-panel" data-options="fit:true,border:false">
			</div>
		</div>
		<div data-options="region:'south'" id="footer">
			<div class="footer_content">
				<div class="footer_bottom">
					<div class="copyright" style="align:center">&copy; PT. Cipaganti Citra Graha 2014 - <a href="#" target="_blank">Sistem Informasi Purchasing Logistic <!-- <?=$universitas->Nama?> --></a></div>
				</div>
				<div class="clear"></div>  
			</div><!--end footer content-->
		</div>
				 
		<!-- AREA untuk Form Add/EDIT >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  -->
		<div id="dialog" class="easyui-dialog" style="width:400px;height:150px;" closed="true" buttons="#dlg-buttons">
			<div id="dialogDetail" class="easyui-dialog" style="width:400px;height:150px" closed="true">
			</div>
			<div id="dlg-buttons">
				<a href="#" class="easyui-linkbutton" id="save" iconCls="icon-ok" onclick="saveData()">Save</a>
				<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dialog').dialog('close')">Cancel</a>
			</div>
		</div>

		<div id="detail_dialog" class="easyui-dialog" style="width:400px;height:150px;" closed="true" buttons="#dlg-buttons-detail">
			<div id="dialogDetail" class="easyui-dialog" style="width:400px;height:150px" closed="true">		 
			</div>
			<div id="dlg-buttons-detail">
				<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#detail_dialog').dialog('close')">Cancel</a>
			</div>
		</div>
		<div id="dialog_kosong" class="easyui-dialog" style="width:400px;height:150px;" closed="true" buttons="#dlg-buttons-kosong">
			<div id="dialogKosong" class="easyui-dialog" style="width:400px;height:150px" closed="true">		 
			</div>
			<div id="dlg-buttons-kosong">
			</div>
		</div>				 
				 
	</body>
