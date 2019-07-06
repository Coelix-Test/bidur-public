<div class="top-row">
    <div class="top-row-inner">
        <div class="menu-col-wrap">
            <div class="logo-wrap">
                <a href="/">
                    <img src="/img/logo-yellow.png" alt="">
                </a>
            </div>
            <ul class="menu-list menu">
                <li><a href="/">דף בית</a></li>
                <li><a href="/about-us">אודות</a></li>
                <li><a href="/contact-us">צור קשר</a></li>
            </ul>
        </div>

        <div class="socials-wrap">
            <a href="#" class="telegram"></a>
            <a href="#" class="youtube"></a>
            <a href="#" class="facebook"></a>
            <a href="#" class="instagram"></a>
        </div>

        <div class="auth-btns">
            @if(!Auth::check())
                <a href="{{route('register')}}" class="btn-common btn-red register-popup-trigger">הרשמה</a>
                <a href="{{route('login')}}" class="btn-common btn-border-dark login-popup-trigger">כניסה</a>
                @else
                <a href="{{route('logout')}}" class="btn-common btn-red">logout</a>
            @endif


        </div>

    </div>

    <div class="top-row-inner-mob">
        <div class="menu-wrap">
            <div class="menu-btn toggle-mnu toggle-nav item-menu-nav">
                <span></span>
            </div>


            <div id="nav-panel" class="main-nav modal fade">
    			<div class="modal-content">
    				<div class="main-nav-content">
    					<ul id="menu-primary-menu" class="menu">
    						<li class="menu-item menu-item-has-children">
    							<a href="/">דף בית</a>
    						</li>
    						<li class="menu-item">
    							<a href="/about-us">אודות</a>
    						</li>
    						<li class="menu-item">
    							<a href="/contact-us">צור קשר</a>
    						</li>
    					</ul>
    				</div>
    			</div>
    		</div>


        </div>
        <a href="/" class="logo-wrap">
            <img src="/img/logo-yellow.png" alt="">
        </a>
        <div class="socials-wrap">
          <a href="#" class="telegram"></a>
          <a href="#" class="youtube"></a>
          <a href="#" class="facebook"></a>
          <a href="#" class="instagram"></a>
        </div>
    </div>
</div><!-- top row end -->
