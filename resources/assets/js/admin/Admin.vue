<template>
    <div id="admin-wrap">
        <nav class="admin-nav">
            <div class="title">מערכת ניהול - ישראל בידור</div>
            <ul class="nav-menu">
                <li>
                    <router-link :to="{ name: 'edit-main-page' }">עמוד ראשי</router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'post-new' }">פוסט חדש</router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'posts' }">כל הפוסטים</router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'surveys' }">שאלונים</router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'users' }">משתמשים</router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'tags' }">תגים</router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'mails' }">מיילים</router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'insta-slider' }">Instagram Sliders</router-link>
                </li>
            </ul>
        </nav>

        <router-view class="admin-content" id="admin_content" :key="$route.path"></router-view>
    </div>
</template>

<style lang="scss">
    .admin-nav{
        height: 415px;
        display: flex;
        justify-content: center;
        -ms-align-items: center;
        align-items: center;
        text-align: center;
        flex-direction: column;
        background: url('/img/admin-nav.png') no-repeat center;
        -webkit-background-size: cover;
        background-size: cover;
        .nav-menu{
            display: flex;
            list-style-type: none;
            background-color: #fff;
            border-radius: 5px;
            padding: 0;
            margin: 0;
            overflow: hidden;
            li{
              padding: 5px;
                position: relative;
                border-left: 1px solid transparent;
                &:after{
                    content: '';
                    display: block;
                    width: 1px;
                    height: calc(100% - 32px);
                    background: #000;
                    position: absolute;
                    top: 14px;
                    left: -1px;
                }
                &:last-child{
                    border: none;
                    &:after{
                        display: none;
                    }
                }
            }
            a{
              border-radius: 5px;
                display: flex;
                text-decoration: none;
                color: #333;
                font-size: 16px;
                padding: 0 20px;
                height: 50px;
                -ms-align-items: center;
                align-items: center;
                justify-content: center;
                text-align: center;

                &:hover,
                &.router-link-exact-active{
                    background: #EB5757;
                    color: #fff;
                }
            }
        }
        .title{
            font-weight: bold;
            color: #fff;
            font-size: 80px;
        }
    }
</style>
