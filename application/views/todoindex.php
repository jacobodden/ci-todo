<?php

$this->load->helper('form');

//echo '<pre>';
//var_dump($data);
//echo '</pre>';

?>
<div class="container">
	<div class="row">
		<div class="col-xs-1"></div>
		<div class="col-xs-10">
			<h1>CI - Todo</h1>
			<div class="todo-container">
				<div class="todo-list">
					<?php
					if(!empty($data)) // display a list of all current todos
					{
						print "<ul class='tdlist'>";
						foreach($data as $todo)
						{
							if($todo->finished != 1) // unfinished todos
							{
								print "<li><label data-id='".$todo->id."'><input type='checkbox'>".$todo->content."</label></li>";
							}
							else // finished todos
							{
								print "<li><label data-id='".$todo->id."' class='checked'><input id='checked' type='checkbox' checked='checked'>".$todo->content."</label><button data-id='".$todo->id."' class='delete-button' type='button'>Delete</button></li>";
							}
						}
						print "</ul>";
					}
					else //  display message that there are no current todos
					{
						print '<h4>You currently have no todos.<h4/>';
					}
					?>
				</div>
			</div>
			<div class="form-container">
			<?php
			$todo_data = array(
				'value' => '',
				'maxlength' => '60',
				'size' => '60',
				'placeholder' => 'Create a new Todo (max 60 characters)',
			);
			echo form_input($todo_data);
			echo form_submit('submit','Add Todo');
			?>
			</div>
		</div>
		<div class="col-xs-1"></div>
	</div>
</div>
