<?php

/*
 * Шаблон уведомления о завершении заказа исполнителем и получении отзыва (УВ-9)
 * Так же используется при отправле ЛС поэтому все переводы каретки (новая строка) будут заменены <br/> при выводе сообщения и при отправке письма
 */

$smail->subject = "Завершение заказа «{$order['title']}»";

$title = reformat(htmlspecialchars($order['title']), 30, 0, 1);
$order_url = $GLOBALS['host'] . tservices_helper::getOrderCardUrl($order['id']);
$frl_feedback = reformat(htmlspecialchars($order['frl_feedback']), 30);
$frl_is_good = ($order['frl_rating'] > 0);
//$feedback_url = $GLOBALS['host'] . "/users/{$order['freelancer']['login']}/opinions/";

if(empty($frl_feedback))
{
    
?>
Исполнитель <?=$frl_fullname?> завершил сотрудничество и закрыл заказ &laquo;<a href="<?=$order_url?>"><?=$title?></a>&raquo;.
<a href="<?=$order_url?>">Вы можете оставить отзыв.</a>
<?php

}
else
{
        
?>
Исполнитель <?=$frl_fullname?> завершил сотрудничество с вами по заказу &laquo;<a href="<?=$order_url?>"><?=$title?></a>&raquo; и оставил <?php if($frl_is_good){ ?>положительный<?php }else{ ?>отрицательный<?php } ?> отзыв:

<i><?=$frl_feedback?></i>

Ознакомиться с ним и оставить ответный отзыв вы можете в заказе &laquo;<a href="<?=$order_url?>"><?=$title?></a>&raquo;.

<a href="<?=$order_url?>">Перейти к отзыву</a> / <a href="<?=$order_url?>">Оставить ответный отзыв</a> 
<?php

}