<?php
/*
Plugin Name: поля для профиля
Description: новые поля в профиль пользователя.
Version: 1.0
*/

function tm_additional_profile_fields( $user ) {
    
    $floors = array( 'Женский', 'Мужской' );
    
    $family_statuses = array( 'В браке', 'В разводе' , 'Не женат/Не замужем' );
    
    $floor_date = get_user_meta( $user->ID, 'floor_date', true);
    
    $family_status_date = get_user_meta( $user->ID, 'family_statusr_date', true);
    ?>
    <h3>Дополнительная информация</h3>

    <table class="form-table">
   	 <tr>
   		 <th><label for="floor-date-day">Пол</label></th>
   		 <td>
   			 
   			 <select id="floor-date" name="floor"><?php
   				 foreach ( $floors as $floor ) {
   					printf( '<option value="%1$s" %2$s>%1$s</option>', $floor, selected( $floor_date, $floor, false ) ); 
   				 }
   			 ?></select>
   			 
   		 </td> 
   	 </tr>
    </table>
<table class="form-table">
   	 <tr>

   		 <th><label for="floor-date-day">Семейный статус</label></th>
   		 <td>
   			 
   			 <select id="family-status-date" name="family"><?php
   				 foreach ( $family_statuses as $family_status ) {
   					printf( '<option value="%1$s" %2$s>%1$s</option>', $family_status, selected( $family_status_date, $family_status, false  ) ); 
   				 }
   			 ?></select>
   			 
   		 </td>
   		 
   	 </tr>
    </table>
    <?php
}


add_action( 'show_user_profile', 'tm_additional_profile_fields' );
add_action( 'edit_user_profile', 'tm_additional_profile_fields' );


function modify_contact_methods( $contact_fields ) {
	// Новые поля
	$contact_fields['Phone']  = 'Телефон';
	$contact_fields['address']  = 'Адрес';

	return $contact_fields;
}
add_filter('user_contactmethods', 'modify_contact_methods');

add_user_meta( $user_id, $meta_key, $meta_value, $unique );



