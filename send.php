<?php
require( dirname(__FILE__) . '/wp-load.php');
$c = true;


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
    "From: ASX <klyukovskiy@yandex.ru>"
      );
          
wp_mail( 'klyukovskiy@yandex.ru', 'Заявка на расчёт', $message, $headers);
header('Location: '.site_url('/thanks').'');
exit;

?>
