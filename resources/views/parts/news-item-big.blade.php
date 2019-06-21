

@if(isset($key))

    <div class="news-item news-item-big">
        <div class="img-wrap">
            <div class="image image-bg" style="background-image: url('<?= $allInfoHotForMiddle[$key]['img']?>');"></div>
        </div>
        <div class="text-wrap">
            <div class="title"><?= $allInfoHotForMiddle[$key]['title'] ?></div>
            <div class="meta"><span class="author">by <?= $allInfoHotForMiddle[$key]['author'] ?></span> | <span class="time"><?= $allInfoHotForMiddle[$key]['title'] ?></span></div>
            <div class="excerpt"> <?= $allInfoHotForMiddle[$key]['excerpt'] ?></div>
            <div class="stars-rating-wrapper">
                <div class="star"></div>
                <div class="star star-active"></div>
                <div class="star star-active"></div>
                <div class="star star-active"></div>
                <div class="star star-active"></div>
            </div>
        </div>
    </div>
@endif
