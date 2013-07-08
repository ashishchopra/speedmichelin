<style>
	
	#uploadgallery_div {
		display: inline;
	}
	
	#browse_div {
		width: 742px;
		height: 187px;
		background: url("<?php echo Yii::app()->request->baseUrl; ?>/images/screen_5_box.png");
		display: none;
	}
	
</style>

<div class="second_bg" >
	<div id="uploadgallery_div" >
		<a href="<?php Yii::app()->createUrl('/gallery') ?>" ><img src="<?php echo Yii::app()->request->baseUrl ?>/images/screen_2_btn_2.png" /></a>
		<img onclick="browse()" src="<?php echo Yii::app()->request->baseUrl ?>/images/screen_2_btn_1.png" />
	</div>
	<div id="browse_div" >
			<button onclick="systempopup()" >From System</button>
			<button onclick="fbpopup()" >From FB</button>
			<div id="systempopup" >
				
			</div>
			<div id="fbpopup" >
				
			</div>
	</div>
</div>

<script>
	
	function browse() {
		document.getElementById('uploadgallery_div').style.display = 'none';
		document.getElementById('browse_div').style.display = 'inline';
	}
	
	function systempopup() {
		document.getElementById('systempopup').style.display = 'inline';
	}
	
	function fbpopup() {
		document.getElementById('fbpopup').style.display = 'inline';
	}
	
	function hide() {
		document.getElementById('fbpopup').style.display = 'none';
		document.getElementById('systempopup').style.display = 'none';
	}
	
</script>