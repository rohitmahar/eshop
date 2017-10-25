<template>
    <div class="navbar-wrapper">
        <div class="container-fluid">
            <nav class="navbar navbar-fixed-top">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li><a href="/homepage" class="">Home</a></li>
                            <li class="dropdown" v-for="category in categories">
                                <a href="javascript:void(0)"
                                   class="dropdown-toggle"
                                   data-toggle="dropdown"
                                   role="button"
                                   aria-haspopup="true"
                                   aria-expanded="false"
                                >
                                    {{ category.title }} <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li v-for="subCategory in category.children">
                                        <a v-bind:href="getUrl(subCategory)"
                                        >
                                            {{ subCategory.title }}
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="/terms-conditions" class="">Terms</a></li>
                            <li><a href="/contact" class="">Contact</a></li>
                        </ul>
                        <ul class="nav navbar-nav pull-right" v-if="authUserName">
                            <li class=" dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    {{ userName }} <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="/profile/setting">Settings</a></li>
                                    <li><a href="/profile/purchase">Purchases</a></li>
                                    <li>
                                        <a href="javascript:void(0)" @click="logout">
                                            Logout
                                            <i class="ion ion-log-out"></i></a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav pull-right" v-else>
                            <li class=""><a href="/login">Login / Register</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</template>

<script type="text/javascript">
    import axios from 'axios';

    export default{
        data() {
            return {
                currentLoggedInUserName: this.userName,
            }
        },
        props: {
            userName: {
                type: String,
                required: false,
            },
            categories: {
                type: Array,
                required: true,
            }
        },
        computed: {
            authUserName: {
                get() {
                    return this.currentLoggedInUserName;
                },
                set(userName) {
                    this.currentLoggedInUserName = userName;
                },
            },
        },
        methods: {
            getUrl(category) {
                return `/category/${category.id}/products`;
            },
            logout() {
                axios.post('/logout')
                    .then(() => {
                        this.authUserName = '';
                        window.location.reload();
                    });
            },
        }
    };
</script>