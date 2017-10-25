<template>
    <div class="share-banner">
        <div class="container">
            <div class="row text-center">
                <h4 class="social-share">Share on</h4>
                <span><i class="ion ion-arrow-down-c"></i></span><br>
                <span>
                    <a :href="facebookShareLink">
                        <i class="ion social ion-social-facebook-outline"></i>
                    </a>
                    <a :href="twitterShareLink">
                        <i class="ion social ion-social-twitter-outline"></i>
                    </a>
                    <a :href="googleShareLink">
                        <i class="ion social ion-social-googleplus-outline"></i>
                    </a>
                </span>
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
    export default {
        name: 'SocialShareBanner',
        data() {
            return {
                facebookShareLink: 'https://www.facebook.com/dialog/feed?app_id=184683071273&link=http%3A%2F%2Festylesta.com&picture=http%3A%2F%2Festylesta.com%2Fimages%2Fstyle.jpg&name=Estylesta%20Clothes%20Shopping&caption=%20&description=Estylesta%20is%20providing%20awesome%20collection%20of%20clothes%20to%20make%20your%20style%20better.&redirect_uri=http%3A%2F%2Fwww.facebook.com%2F',
                twitterShareLink: 'https://twitter.com/home?status=Estylesta%20is%20ready%20for%20make%20your%20style%20better%20by%20providing%20stylish%20clothes,%20%23Style%20%23Clothes%20%23Nepal%20http%3A//estylesta.com',
                googleShareLink: 'https://plus.google.com/share?url=http%3A//estylesta.com',
            }
        },
    }
</script>