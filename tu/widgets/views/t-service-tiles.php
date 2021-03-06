<?php

/**
 * Шаблон "плитка" ТУ
 */

if ($tservices):
?>
<aside class="b-layout__side b-layout__side_content " id="tservices_tile">
<?php 
foreach($tservices as $key => $tservice): 

    $tservice_url = sprintf('/tu/%d/%s.html', $tservice['id'], tservices_helper::translit($tservice['title']));
    $tservice_title = LenghtFormatEx(reformat($tservice['title'], 20, 0, 1),80);
    $alt = $tservice_title;
    $title = sprintf("Услуги фрилансера %s: %s", $tservice['login'], $tservice_title);

    if (!empty($tservice['file'])) {
        $image_url = tservices_helper::image_src($tservice['file'], $tservice['login']);
        $thumbnail200x150 = '<img width="200" height="150" class="b-pic" src="'.$image_url.'" alt="'.$alt.'" title="'.$title.'">';
    } else {
        $thumbnail200x150 = '<div class="b-pic b-pic_no_img b-pic_w200_h150 b-pic_bg_f2"></div>';
    }

    $hasVideo = !empty($tservice['videos']) && count($tservice['videos']);
    // Пока сфинск не считает все покупки, будем брать отзывы. #0026584
    $sold_count = isset($tservice['count_sold']) ? $tservice['count_sold'] : $tservice['total_feedbacks']; 
?>
    <div class="i-pic i-pic_port i-pic_port_z-index_inherit i-pic_pad_10 i-pic_height_220 i-pic_bord_green_hover">
        <div class="b-layout b-layout_relative">
            <a href="<?=$tservice_url?>" class="b-pic__lnk b-pic__lnk_relative">
                <?php if($hasVideo): ?>
                    <div class="b-icon b-icon__play b-icon_absolute b-icon_bot_4 b-icon_left_4"></div>
                <?php endif; ?>
                <?=$thumbnail200x150?>
            </a>
            <a class="b-pic__price-box b-pic__price-box_pay b-pic__price-box b-pic__price-box_noline" href="javascript:void(0);" data-url="<?=$tservice_url?>" onclick="TServices_Catalog.orderNow(this);"><?=tservices_helper::cost_format($tservice['price'],true)?>			
			<?php if ($sold_count > 0): ?>
                <span title="Количество продаж услуги"><span class="b-icon b-icon__tu2 b-icon_top_2"></span> <?=number_format($sold_count, 0, '', ' ')?></span>
            <?php endif; ?>
            </a>
        </div>
		<div class="b-layout__txt b-layout__txt_padtop_10 b-layout_overflow_hidden">
			<a href="<?=$tservice_url?>" class="b-layout__link b-layout__link_no-decorat b-layout__link_color_000 b-layout__link_inline-block"><?=LenghtFormatEx(reformat($tservice['title'], 20, 0, 1),80)?></a>
		</div>
	</div>
<?php endforeach; ?>
</aside>
<?php endif; ?>