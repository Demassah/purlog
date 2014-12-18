<!--<script src="<?=base_url();?>asset/js/Chart.js"></script>-->
<script>
		$(document).ready(function(){
			
			$('#menu-mhs').click(function(){
				$('#konten').panel({
					href:base_url+'barang'
				});
			});
			$('#menu-krs').click(function(){
				$('#konten').panel({
					href:base_url+'barang'
				});
			});
			$('#menu-trns').click(function(){
				$('#konten').panel({
					href:base_url+'barang'
				});
			});
			$('#menu-ka').click(function(){
				$('#konten').panel({
					href:base_url+'barang'
				});
			});
		});
</script>

<link rel="stylesheet" type="text/css" href="<?=base_url();?>asset/css/dashboard.css" />
<div class="container">
	<h1>Dashboard Sistem Informasi Purchasing Logistic</h1>
	<div class="status">
		<div class="col3">
			<a>
			  <div class="icon">
				<!-- <img src="<?php echo base_url();?>asset/images/s1.png">
				<img src="<?php echo base_url();?>asset/images/s1-h.png" class="hover"> -->
			  </div>
			  <div class="heading">
				 <!--<?php echo $mhsActCount;?>-->
			  </div>
			  <div class="desc">
				 Requestor
			  </div>
			</a>
		</div>
		<div class="col3">
			<a>
			  <div class="icon">
				<!-- <img src="<?php echo base_url();?>asset/images/s2.png">
				<img src="<?php echo base_url();?>asset/images/s2-h.png" class="hover"> -->
			  </div>
			  <div class="heading">
				 <!--<?php echo $mhsCount;?>-->
			  </div>
			  <div class="desc">
				 Warehouse
			  </div>
			</a>
		</div>
		<div class="col3">
			<a>
			  <div class="icon">
				<!-- <img src="<?php echo base_url();?>asset/images/t.png">
				<img src="<?php echo base_url();?>asset/images/t-h.png" class="hover"> -->
			  </div>
			  <div class="heading">
				 <!--<?php echo $dsnCount;?>-->
			  </div>
			  <div class="desc">
				 Purchasing
			  </div>
			</a>
		</div>
	</div>
	<div class="content">
		<div class="diagram">
			<h2>Perkembangan Jumlah Barang</h2>
			<!--<h2><?php $l = count($lblDiagram)-1; echo $lblDiagram[0].' - '.$lblDiagram[$l];?></h2>-->
			<div id="diagram" style="width:auto;height:250px"><canvas id="canvas"></canvas></div>
		</div>
		<div class="nav">
			<div class="ncontainer">
			<nav>
					<ul class="mcd-menu">
						<li class="float">
							<a href="#" style="text-align:center">
								<h1>MENU FAVORIT</h1>
								<small>Akses Modul Terfavorit (sering digunakan)</small>
							</a>
						</li>
						<li id="menu-mhs" class='m'>
							<a href="#">
								<i class="icon-user"></i>
								<strong>Data Vendor</strong>
								<small>Kelola Data Vendor</small>
							</a>
						</li>
						<li id="menu-krs" class='m'>
							<a href="#">
								<i class="icon-edits"></i>
								<strong>Data Barang</strong>
								<small>Kelola Data Barang</small>
							</a>
						</li>
						<li id="menu-trns" class='m'>
							<a href="#">
								<i class="icon-star"></i>
								<strong>Pemasukan Barang</strong>
								<small>Kelola Data Pemasukan Barang</small>
							</a>
						</li>
						<li id="menu-ka" class='m'>
							<a href="#">
								<i class="icon-calendar"></i>
								<strong>Pengeluaran Barang</strong>
								<small>Kelola Data Pengeluaran Barang</small>
							</a>
						</li>
					</ul>
				</nav>
			</div>
		</div>
	</div>
</div>

<!--<script>
	var canvasNode = document.getElementById("canvas");
	var canvasParent = document.getElementById("diagram");
	canvasNode.width = (canvasParent.clientWidth * 60) / 100;
	canvasNode.height = canvasParent.clientHeight;
	<?php
		$phpArr = $lblDiagram;
		$jsArr = json_encode($phpArr);
		echo "var labelArr = ". $jsArr . ";\n";
	?>
	<?php
		$phpArr = $dataDiagram;
		$jsArr = json_encode($phpArr);
		echo "var dataArr = ". $jsArr . ";\n";
	?>
	var lineChartData = {
		labels : labelArr,
		datasets : [
			{
				fillColor : "rgba(151,187,205,0.5)",
				strokeColor : "rgba(151,187,205,1)",
				pointColor : "rgba(151,187,205,1)",
				pointStrokeColor : "#fff",
				data : dataArr
			}
		]
		
	}

	var myLine = new Chart(document.getElementById("canvas").getContext("2d")).Line(lineChartData);
</script>-->