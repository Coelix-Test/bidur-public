<header id="header_main">
    @include('parts/header/top-line')
    <?php
    $postController = new \App\Http\Controllers\PostController();
    $twoPosts = $postController->getTwoRandomPosts();

    ?>

    <div class="celebrities-container">
        <div class="celebrities-slider">
            <?php
            $hashtags = new \App\Http\Controllers\HashtagController();
            $hashtags = $hashtags->getAllHashtags();
            foreach ($hashtags as $hashtag) {
                ?>
                <a href="/#/hashtag/{{ $hashtag['id'] }}" class="np-slide-item">
                    <div class="celebrity">
                        <div class="img-wrap">
                            <div class="image" style="background-image: url('<?=$hashtag['img']?>');"></div>
                        </div>
                        <div class="name"><?=$hashtag['name']?></div>
                    </div>
                </a>
                <?php
            }
            ?>
        </div>
    </div><!-- celebrities row end-->
    <div class="run-stroke-wrap-wrap" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
      <div class="run-stroke-wrap" style="margin:0 auto;max-width:1440px;box-shadow:unset;">
          <ul class="run-stroke">
              <?php
              $post = new \App\Http\Controllers\PostController();
              $postTitles = $post->getAllPostTitles();

              foreach ($postTitles as $postTitle) {
                  ?>
                  <li>Lorem ipsum dolor sit amet, consectetur adipisicing.<?= $postTitle['title']?></li>
                  <?php
              }
              ?>
          </ul>
          <ul class="run-stroke hidden">
              <?php
              foreach ($postTitles as $postTitle) {
              ?>
              <li>Lorem ipsum dolor sit amet, consectetur adipisicing.<?= $postTitle['title']?></li>
              <?php
              }
              ?>
          </ul>
      </div>
    </div>

</header>
