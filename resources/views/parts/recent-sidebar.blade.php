<div class="recent-sidebar">
    <?php
    $controller = new \App\Http\Controllers\PostController();
    ?>
    @foreach($allPosts['all'] as $post)
        <?php
        $allInfoRecent[] = $controller->getInfoOnPostForMain($post['post']->id);
        $i = 0;
        $GLOBALS['iForRecent'] = $i;
        $GLOBALS['allInfoRecent'] = $allInfoRecent;
        global $iForRecent;
        ?>
    @endforeach


    @for($iForRecent = 0; $iForRecent < count($allInfoRecent)-1; $iForRecent++)
            <div class="news-block small-image-news">
                <div class="title-line">אופנה</div>
                <?php
//                dd($allInfoRecent);
                for ($innerI = $iForRecent; $innerI < 5; $innerI++){
                    if ($innerI < count($allInfoRecent)-1){
                        ?>@include('parts/news-item-small')<?php
                    }
                    $iForRecent = $innerI;
                    var_dump($iForRecent);
                }

                ?>

            </div>

            <div class="banner" style="background-image: url('https://via.placeholder.com/375x600');"></div>

            <div class="news-block small-image-news">
                <div class="title-line">אופנה</div>
                <?php

                for ($innerI = $iForRecent; $innerI < 5; $innerI++){
                if ($innerI < count($allInfoRecent)-1){
                ?>@include('parts/news-item-small')<?php
                }
                $iForRecent = $innerI;
                }
                ?>
            </div>
    @endfor


</div>
