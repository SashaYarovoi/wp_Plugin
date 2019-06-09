<?php
/*
Plugin Name: поля для профиля
Description: новые поля в профиль пользователя.
Version: 1.0
*/

function tm_additional_profile_fields( $user ) {

    $floor = array( 'Женский', 'Мужской' );
    $family_status = array( 'В браке', 'В разводе' , 'Не женат/Не замужем' );
    $floor_date = wp_parse_args( get_the_author_meta( 'floor_date', $user->ID ), $default );
    $family_status_date = wp_parse_args( get_the_author_meta( 'family_statusr_date', $user->ID ), $default );
    ?>
    <h3>Дополнительная информация</h3>

    <table class="form-table">
   	 <tr>
   		 <th><label for="floor-date-day">Пол</label></th>
   		 <td>
   			 
   			 <select id="floor-date" name="floor"><?php
   				 foreach ( $floor as $floor ) {
   					printf( '<option value="%1$s" %2$s>%1$s</option>', $floor, selected( $floor_date['floor'], $floor, false ) ); 
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
   				 foreach ( $family_status as $family_status ) {
   					printf( '<option value="%1$s" %2$s>%1$s</option>', $family_status, selected( $family_status['family'], $family_status, false  ) ); 
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

	return $contact_fields;
}
add_filter('user_contactmethods', 'modify_contact_methods');
