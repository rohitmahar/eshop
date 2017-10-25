<template>
    <div class="container">
        <div class="main-content">
            <div class="online-strip">
                <div class="col-md-4 follow-us">
                    <h3>Follow us :
                        <a class="facebook" href="https://www.facebook.com/Estylesta-430291340680029/"><i class="ion ion-social-facebook"></i></a>
                        <a class="twitter" href="#"><i class="ion ion-social-twitter"></i></a>
                        <a href="google-plus"><i class="ion ion-social-googleplus"></i></a>
                    </h3>
                </div>
                <div class="col-md-4 shipping-grid">
                    <div class="shipping">
                        <img :src="imageLink" alt="Easy Shop"/>
                    </div>
                    <div class="shipping-text">
                        <h3>Free Shipping</h3>
                        <p>Inside Kathmandu Valley.</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="col-md-4 online-order">
                    <p>Order online</p>
                    <h3>Tel: {{ setting.phone }}</h3>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
    export default {
        name: 'PromotionBar',
        data() {
            return {
                imageLink: 'frontend/images/shipping.png',
            }
        },
        props: {
            setting: {
                required: true,
                type: Object,
            }
        }
    }
</script>