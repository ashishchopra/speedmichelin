<style>
	#main_div {
		width: 800px;
		height: 570px;
		background: url("<?php echo Yii::app()->request->baseUrl; ?>/images/bg_.jpg");
	}
</style>

<div id="main_div" >
	<a href="<?php echo $this->createUrl('upload'); ?>" ><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/home_btn.png" /></a>
</div>