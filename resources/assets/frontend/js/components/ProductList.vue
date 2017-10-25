<template>
    <div>
        <div class="col-md-3 col-md-3 col-xs-12" v-for="product in products">
            <div class="feature-product">
                <div class="image-section">
                    <a :href="`product/${product.id}/detail`">
                        <img id="myImg" :src="product.image" :alt="product.title" class="img-responsive">
                    </a>
                </div>
                <div class="product-price text-center">
                    <h4 class="product-name">{{ product.title }}</h4>
                    <p class="price-part" style="padding:4px;font-size: 14px;">
                        <small>NRs</small> {{ product.price }}
                        <!--{{ shortDescription(product.description) }}...-->
                    </p>
                </div>
                <div class="text-center">
                    <a v-if="product.discount_percentage !== '0.00'"
                       href="javascript:void(0)" class="pull-left">
                        <button class="e-btn discount-view">
                            {{ product.discount_percentage }}% OFF
                        </button>
                    </a>
                    <a :href="`/product/${product.id}/detail`">
                        <button class="e-btn add-to-cart">
                            <i class="ion ion-android-cart"></i>
                            Detail
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
    export default {
        name: 'ProductList',
        props: {
            products: {
                type: Array,
                required: true,
            }
        }
    }
</script>