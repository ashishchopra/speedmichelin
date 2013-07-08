<div class="second_bg" >
	
	<table style="width: 558px; " >
		<tr>
			<td colspan="3" >
				<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/screen_9_box.png" />
			</td>
		</tr>
	<?php
		foreach ($lb_data as $key => $value) {
	?>
		<tr style=" height: 110px; background: url('<?php echo Yii::app()->request->baseUrl; ?>/images/screen_9_box_1.png'); " >
			<td>
				<img src="https://graph.facebook.com/<?php echo $value['uid']; ?>/picture" />
			</td>
			<td>
				<label>
					<?php echo $value['caption']; ?>
				</label>
			</td>
			<td>
				<label>
					<?php echo $value['points']; ?>
				</label>
			</td>
		</tr>
	
	<?php	
		}
	?>
	</table>
</div>