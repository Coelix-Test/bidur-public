<div class="recent-sidebar">
    <?php
    $controller = new \App\Http\Controllers\PostController();
    ?>
    @foreach($allPosts['recent'] as $post)
        <?php

        $allInfoRecent[] = $controller->getInfoOnPostForMain($post['post']->id);
        $i = 0;
        $GLOBALS['iForRecent'] = $i;
        $GLOBALS['allInfoRecent'] = $allInfoRecent;
        global $iForRecent;
        ?>
    @endforeach

<?php
$split = array_chunk($allInfoRecent, 5);

        ?>
        @foreach($split as $array)
            <div class="news-block small-image-news">
                <div class="title-line">אופנה</div>
                @foreach($array as $key => $innerArray)
                    @include('parts/news-item-small', [$key])
                @endforeach
            </div>
            <div class="banner" style="background-image: url('https://via.placeholder.com/375x600');"></div>
        @endforeach

</div>
