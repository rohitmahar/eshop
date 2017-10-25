<template>
    <div>
        <shop-slider :sliders="sliders"></shop-slider>
        <promotion-bar :setting="setting"></promotion-bar>
        <featured-products
                :products="products"
                :paginate-handler="paginateHandler"
                :loading="loading"
                :error="error"
                :pagination="pagination"
        >
        </featured-products>
        <social-share-banner></social-share-banner>
    </div>
</template>

<script type="text/javascript">
    import ShopSlider from '../components/ShopSlider.vue';
    import PromotionBar from '../components/PromotionBar.vue';
    import FeaturedProducts from '../containers/FeaturedProducts.vue';
    import SocialShareBanner from '../components/SocialShareBanner.vue';

    export default {
        name: 'HomePage',
        components: {
            ShopSlider,
            FeaturedProducts,
            SocialShareBanner,
            PromotionBar,
        },
        props: {
            sliders: {
                type: Array,
                required: true,
            },
            setting: {
                type: Object,
                required: true,
            },
            products: {
                type: Array,
                required: true,
            },
            paginateHandler: {
                type: Function,
                required: true,
            },
            loading: {
                type: Boolean,
                required: true,
            },
            error: {
                type: String,
                required: true,
            },
            pagination: {
                required: true,
                type: Object,
            },
        },
    }
</script>
