<ol>
	<li class="even">
		<label>Group</label>
		<?php echo form_dropdown(
				array(
						'name'		=> 'group', 
						'options'	=> $groups,
						'selected' 	=> $options['group']
					)
				); 
		?>
	</li>
	<li class="odd">
		<label>Column</label>
		<?php echo form_dropdown(
				array(
						'name'		=> 'column', 
						'options'	=> array(1=>'One column', 2=>'Two column', 3=>'Three column'),
						'selected' 	=> $options['column']
					)
				); 
		?>
	</li>
	<li class="even">
		<label>Play delay(ms), set 0 to stop.</label>
		<?php echo form_input(
				array(
						'name'		=> 'delay', 
						'maxlength' => '10',
						'size'		=> '50',
						'value' 	=> ($options['delay'] != '' ? $options['delay']:'5000'),
						'style'		=> 'width:30%'
					)
				); 
		?>
	</li>
	<li class="odd">
		<label>Generate Next Prev?</label>
		<?php /* echo form_checkbox(
				array(
						'name'		=> 'arrow', 
						'id'		=> 'arrow',
						'value' 	=> '1',
						'checked'	=> $options['arrow'], 
						'style' 	=> 'margin-left:10px'
					)
				);  */
		?>
		<?php echo form_dropdown(
				array(
						'name'		=> 'arrow', 
						'options'	=> array(0=>'No', 1=>'Yes'),
						'selected' 	=> $options['arrow']
					)
				); 
		?>
	</li>
	<li class="even">
		<label>Width</label>
		<?php echo form_input(
				array(
						'name'		=> 'width', 
						'maxlength' => '10',
						'size'		=> '50',
						'value' 	=> $options['width'],
						'style'		=> 'width:30%'
					)
				); 
		?>
	</li>
	<li class="odd">
		<label>Height</label>
		<?php echo form_input(
				array(
						'name'		=> 'height', 
						'maxlength' => '10',
						'size'		=> '50',
						'value' 	=> $options['height'],
						'style'		=> 'width:30%'
					)
				); 
		?>
	</li>
</ol>