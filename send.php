<?php
require( dirname(__FILE__) . '/wp-load.php');
$c = true;
$admin_email = get_option('admin_email');

	if ( ! function_exists( 'wp_handle_upload' ) )
		require_once( ABSPATH . 'wp-admin/includes/file.php' );     

	$file = & $_FILES['user_file'];
	$overrides = [ 'test_form' => false ];
	$movefile = wp_handle_upload( $file, $overrides );
  $attachments = '';

	if ( $movefile && empty($movefile['error']) ) {
    $attachments = $movefile['file'];
	}

foreach ( $_POST as $key => $value ) {

  if(is_array($value)) {
    $value = implode(",", $value);
  }
    $message .= "
    " . ( ($c = !$c) ? '<tr>':'<tr style="background-color: #f8f8f8;">' ) . "
      <td style='padding: 10px; border: #e9e9e9 1px solid;'><b>$key</b></td>
      <td style='padding: 10px; border: #e9e9e9 1px solid;'>$value</td>
    </tr>
    ";
  }


$message = "<table style='width: 100%;'>$message</table>";

$headers = array(
    "Content-type: text/html; charset=utf-8",
    "From: Oddbee <".$admin_email.">"
      );

          
wp_mail( $admin_email, 'mail from Oddbee', $message, $headers, $attachments);

exit;

?>
