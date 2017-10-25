<template>
    <!-- Footer Start -->
    <div class="footer">
        <div class="container">
            <div class="footer_top">
                <div class="span_of_4">
                    <div class="col-md-3 span1_of_4">
                        <h4>Shop</h4>
                        <ul class="f_nav">
                            <li v-for="category in categories">
                                <a v-bind:href="'/category/' + category.id + '/products'">{{ category.title }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-3 span1_of_4">
                        <h4>help</h4>
                        <ul class="f_nav">
                            <li><a :href="'terms-conditions'">Terms and Conditions</a></li>
                            <li><a :href="'contact'">Contact Us</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 span1_of_4">
                        <h4>account</h4>
                        <ul class="f_nav">
                            <li v-show="!(!!currentUser)"><a :href="'/login'">login</a></li>
                            <li v-show="!(!!currentUser)"><a :href="'/register'">create an account</a></li>
                            <li v-show="!!currentUser"><a :href="'/profile/purchase'">My Purchases</a></li>
                            <li v-show="!!currentUser"><a :href="'/profile/setting'">Profile Setting</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 span1_of_4">
                        <h4>Contact Information</h4>
                        <ul class="f_nav">
                            <li><a :href="'/homepage'">{{ setting.sitename  }} Pvt. Ltd.</a></li>
                            <li><a class="email" href="javascript:void(0)">{{ setting.email }}</a></li>
                            <li><a href="javascript:void(0)">Phone: {{ setting.phone }}</a></li>
                            <li><a href="javascript:void(0)">Address: {{ setting.address }}</a></li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <br><br><br>
            <div class="copyright text-center">
            <span class="footer-social">
                <a href="https://www.facebook.com/Estylesta-430291340680029/"><i class="ion ion-social-facebook-outline"></i></a>
                <a href=""><i class="ion ion-social-twitter-outline"></i></a>
                <a href=""><i class="ion ion-social-googleplus-outline"></i></a>
            </span>
                <p>&copy; 2017 <a :href="'/homepage'">{{ setting.sitename }}</a>. All Rights Reserved </p>
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
    export default {
        name: "ShopFooter",
        props: {
            setting: {
                type: Object,
                required: true,
            },
            currentUser: {
                type: [Object, String],
                required: false,
                default: () => {},
            },
            categories: {
                type: Array,
                required: true,
            }
        }
    }
</script>