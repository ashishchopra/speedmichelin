<style>
	#main_div {
		width: 800px;
		height: 570px;
		background: url("<?php echo Yii::app()->request->baseUrl; ?>/images/bg_.jpg");
	}
	
	#participateBtn {
		position: relative;
		margin-top: 500px;
		float: right;
	}
</style>

<div id="main_div" >
	<a href="<?php echo $this->createUrl('upload'); ?>" ><img id="participateBtn" src="<?php echo Yii::app()->request->baseUrl; ?>/images/home_btn.png" /></a>
</div>