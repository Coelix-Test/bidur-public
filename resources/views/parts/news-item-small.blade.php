
@if(isset($key))
    <div class="news-item news-item-small">
        <div class="img-wrap">
            <div class="image" style="background-image: url('<?=$allInfoRecent[$key]['img'] ?>');"></div>
        </div>
        <div class="text-wrap">
            <div class="title"><?=$allInfoRecent[$key]['title'] ?> </div>
            <div class="meta"><span class="author">by <?=$allInfoRecent[$key]['author'] ?></span> | <span class="time"><?=$allInfoRecent[$key]['time'] ?></span></div>
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
