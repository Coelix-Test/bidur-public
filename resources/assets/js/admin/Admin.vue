<template>
    <div id="admin-wrap">
        <nav class="admin-nav">
            <div class="title">Admin Panel</div>
            <ul class="nav-menu">
                <li>
                    <router-link :to="{ name: 'edit-main-page' }">Main Page</router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'post-new' }">New Post</router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'post-list' }">All Posts</router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'surveys' }">Surveys</router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'users' }">Users</router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'tags' }">Tags</router-link>
                </li>
            </ul>
        </nav>

        <router-view class="admin-content" id="admin_content"></router-view>
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
            border-radius: 10px;
            padding: 0;
            margin: 0;
            overflow: hidden;
            li{
                position: relative;
                border-left: 1px solid transparent;
                &:after{
                    content: '';
                    display: block;
                    width: 1px;
                    height: 34px;
                    background: #333;
                    position: absolute;
                    top: 7px;
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
                display: flex;
                text-decoration: none;
                color: #333;
                font-size: 18px;
                width: 185px;
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
