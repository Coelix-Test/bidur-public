

<section class="big-news">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="tab-switchers tab-switchers-bg-type">
                    <div class="swithcer-item ico-hot active">
                        <span class="caption">חם</span>
                        <svg width="18" height="20" viewBox="0 0 18 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4.88844 20C3.5555 17.2264 4.26534 15.6371 5.2898 14.1398C6.41169 12.5 6.70082 10.8768 6.70082 10.8768C6.70082 10.8768 7.58274 12.0233 7.22994 13.8164C8.78799 12.0821 9.08203 9.31876 8.84676 8.26047C12.3685 10.7216 13.8737 16.0506 11.8453 20C22.6338 13.8959 14.5288 4.76228 13.1178 3.73343C13.5881 4.76224 13.6774 6.50393 12.7272 7.34918C11.1187 1.24999 7.14178 0 7.14178 0C7.61214 3.14539 5.4368 6.58485 3.33913 9.15488C3.26544 7.90066 3.18714 7.03519 2.52759 5.83497C2.37954 8.11339 0.638302 9.97066 0.166777 12.2535C-0.471924 15.345 0.645202 17.6086 4.88844 20Z"/>
                        </svg>
                    </div>
                    <div class="swithcer-item ico-liked">
                        <span class="caption">טרנדי</span>
                        <svg width="12" height="20" viewBox="0 0 12 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.3022 6.85935C11.2475 6.74201 11.1298 6.66669 11.0002 6.66669H7.05016L10.9485 0.511681C11.0135 0.409024 11.0175 0.279024 10.9588 0.172696C10.9002 0.0660158 10.7881 0 10.6668 0H5.33348C5.20715 0 5.0918 0.0713283 5.03516 0.184336L0.0351488 10.1844C-0.0165309 10.2874 -0.0108669 10.41 0.0497973 10.5083C0.110813 10.6067 0.217805 10.6667 0.33347 10.6667H3.76113L0.0261253 19.5373C-0.0375467 19.689 0.0191332 19.865 0.159446 19.951C0.21343 19.984 0.27343 20 0.333118 20C0.428782 20 0.523119 19.959 0.58847 19.8817L11.2552 7.21498C11.3388 7.11568 11.3568 6.97701 11.3022 6.85935Z"/>
                        </svg>
                    </div>
                    <div class="swithcer-item ico-recent">
                        <span class="caption">חדש</span>
                        <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 0C4.486 0 0 4.486 0 10C0 15.514 4.486 20 10 20C15.514 20 20 15.514 20 10C20 4.486 15.514 0 10 0ZM10 17.8722C5.65933 17.8722 2.12762 14.3409 2.12762 10C2.12762 5.65912 5.65933 2.12783 10 2.12783C14.3407 2.12783 17.8724 5.65912 17.8724 10C17.8724 14.3409 14.3407 17.8722 10 17.8722Z"/>
                            <path d="M15.2116 9.69124H10.7176V4.28778C10.7176 3.83306 10.3489 3.46439 9.89418 3.46439C9.43947 3.46439 9.0708 3.83306 9.0708 4.28778V10.5146C9.0708 10.9693 9.43947 11.338 9.89418 11.338H15.2116C15.6663 11.338 16.035 10.9693 16.035 10.5146C16.035 10.0599 15.6663 9.69124 15.2116 9.69124Z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <div class="tabs-container">
        <div class="tab-item active">
            <div class="container">
                <div class="row">
                    {{--       HOT         --}}
                    <?php
                    $controller = new \App\Http\Controllers\PostController();
                    ?>
                    @foreach($allPosts['hot'] as $post)
                        <?php
                        $allInfoHot[] = $controller->getInfoOnPostForMain($post['post']->id);
                        ?>
                    @endforeach
                    <div class="col-3 vertical-column">
                        <a href="{{route('postView', ['id' => $allInfoHot[0]['id']])}}" class="news-item" style="background-image: url('<?= $allInfoHot[0]['img'] ?>');">
                            <div class="gradient">
                                <div class="title"><?= $allInfoHot[0]['title'] ?></div>
                                <div class="meta"><span class="author">by <?= $allInfoHot[0]['author'] ?></span> | <span class="time"><?= $allInfoHot[0]['time'] ?></span></div>
                                <div class="stars-rating-wrapper">
                                    <div class="star"></div>
                                    <div class="star star-active"></div>
                                    <div class="star star-active"></div>
                                    <div class="star star-active"></div>
                                    <div class="star star-active"></div>
                                </div>
                            </div>
                        </a>
                        <a href="{{route('postView', ['id' => $allInfoHot[1]['id']])}}" class="news-item" style="background-image: url('<?= $allInfoHot[1]['img'] ?>');">
                            <div class="gradient">
                                <div class="title"><?= $allInfoHot[1]['title'] ?></div>
                                <div class="meta"><span class="author">by <?= $allInfoHot[1]['author'] ?></span> | <span class="time"><?= $allInfoHot[1]['time'] ?></span></div>
                                <div class="stars-rating-wrapper">
                                    <div class="star"></div>
                                    <div class="star star-active"></div>
                                    <div class="star star-active"></div>
                                    <div class="star star-active"></div>
                                    <div class="star star-active"></div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 big-col">
                        <a href="{{route('postView', ['id' => $allInfoHot[2]['id']])}}" class="news-item" style="background-image: url('<?= $allInfoHot[2]['img'] ?>');">
                            <div class="gradient">
                                <div class="title"><?= $allInfoHot[2]['title'] ?></div>
                                <div class="meta"><span class="author">by <?= $allInfoHot[2]['author'] ?></span> | <span class="time"><?= $allInfoHot[2]['time'] ?></span></div>
                                <div class="stars-rating-wrapper">
                                    <div class="star"></div>
                                    <div class="star star-active"></div>
                                    <div class="star star-active"></div>
                                    <div class="star star-active"></div>
                                    <div class="star star-active"></div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-3">
                        <a href="{{route('postView', ['id' => $allInfoHot[3]['id']])}}" class="news-item" style="background-image: url('<?= $allInfoHot[3]['img'] ?>');">
                            <div class="gradient">
                                <div class="title"><?= $allInfoHot[3]['title'] ?></div>
                                <div class="meta"><span class="author">by <?= $allInfoHot[3]['author'] ?></span> | <span class="time"><?= $allInfoHot[3]['time'] ?></span></div>
                                <div class="stars-rating-wrapper">
                                    <div class="star"></div>
                                    <div class="star star-active"></div>
                                    <div class="star star-active"></div>
                                    <div class="star star-active"></div>
                                    <div class="star star-active"></div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
