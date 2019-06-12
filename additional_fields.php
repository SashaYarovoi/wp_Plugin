<?php
/*
Plugin Name: поля для профиля
Description: новые поля в профиль пользователя.
Version: 1.0
*/

### дополнительные данные на странице профиля
add_action('show_user_profile', 'my_profile_new_fields_add');
add_action('edit_user_profile', 'my_profile_new_fields_add');

add_action('personal_options_update', 'my_profile_new_fields_update');
add_action('edit_user_profile_update', 'my_profile_new_fields_update');

function my_profile_new_fields_add(){ 
	global $user_ID;
	
	$floor = get_user_meta( $user_ID, "user_floor", 1 );
	$family = get_user_meta( $user_ID, "user_family_status", 1 );
	?>
	<h3>Дополнительные данные</h3>
	<table class="form-table">
		<tr>
			<th><label for="user_pl_txt">Пол</label></th>
			<td>
				<input type="text" name="user_floor" value="<?php echo $floor ?>"><br>
			</td>
		</tr>
		<tr>
			<th><label for="user_st_txt">Семейный статус</label></th>
			<td>
				<input type="text" name="user_family_status" value="<?php echo $family ?>"><br>
			</td>
		</tr>
	</table>
	<?php            
}

// обновление
function my_profile_new_fields_update(){
	global $user_ID;
	
	update_user_meta( $user_ID, "user_floor", $_POST['user_floor'] );
        update_user_meta( $user_ID, "user_family_status", $_POST['user_family_status'] );
}

