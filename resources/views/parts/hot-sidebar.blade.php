<div class="hot-sidebar">

    <div class="tab-switchers tab-switchers-border-type">
        <div class="swithcer-item ico-hot active">
            <span class="caption">חם</span>
            <svg width="18" height="20" viewBox="0 0 18 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M4.88844 20C3.5555 17.2264 4.26534 15.6371 5.2898 14.1398C6.41169 12.5 6.70082 10.8768 6.70082 10.8768C6.70082 10.8768 7.58274 12.0233 7.22994 13.8164C8.78799 12.0821 9.08203 9.31876 8.84676 8.26047C12.3685 10.7216 13.8737 16.0506 11.8453 20C22.6338 13.8959 14.5288 4.76228 13.1178 3.73343C13.5881 4.76224 13.6774 6.50393 12.7272 7.34918C11.1187 1.24999 7.14178 0 7.14178 0C7.61214 3.14539 5.4368 6.58485 3.33913 9.15488C3.26544 7.90066 3.18714 7.03519 2.52759 5.83497C2.37954 8.11339 0.638302 9.97066 0.166777 12.2535C-0.471924 15.345 0.645202 17.6086 4.88844 20Z"/>
            </svg>
        </div>
    </div>

    <div class="news-block wide-image-news">
        @include('parts/news-item-small')
    </div>

    <div class="banner" style="background-image: url('https://via.placeholder.com/375x600');"></div>

    <div class="news-block wide-image-news">

        @for ($i = 0; $i < 3; $i++)
            @include('parts/news-item-small')
        @endfor
    </div>

</div>
