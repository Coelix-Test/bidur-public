<?php
global $iForRecent;
global $allInfoRecent;
if (!empty($allInfoRecent[$iForRecent])){
   ?>
<div class="news-item news-item-small">
    <div class="img-wrap">
        <div class="image" style="background-image: url('<?=$allInfoRecent[$iForRecent]['img'] ?>');"></div>
    </div>
    <div class="text-wrap">
        <div class="title"><?=$allInfoRecent[$iForRecent]['title'] ?> </div>
        <div class="meta"><span class="author">by <?=$allInfoRecent[$iForRecent]['author'] ?></span> | <span class="time"><?=$allInfoRecent[$iForRecent]['time'] ?></span></div>
        <div class="stars-rating-wrapper">
            <div class="star"></div>
            <div class="star star-active"></div>
            <div class="star star-active"></div>
            <div class="star star-active"></div>
            <div class="star star-active"></div>
        </div>
    </div>
</div>
    <?php
}
?>

