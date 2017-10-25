<template>
    <div class="header">
        <div class="container">
            <div class="header-top">
                <div class="header-logo">
                    <h1>
                        <a :href="'/homepage'" class="eshop-title">
                            {{ setting.sitename  }}
                        </a>
                    </h1>
                </div>
                <div class="header-right">
                    <ul>
                        <li class="phone">{{ setting.phone }}</li>
                        <li class="mail"><a :href="setting.email">{{ setting.email }}</a></li>
                        <li class="checkout">
                            <a :href="'/show/carts'">
                                <i class="ion text-danger ion-android-cart text-left"></i>
                                <span class="item-count text-right">{{ cartCount }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
    export default {
        name: 'FrontHeader',
        props: {
            setting: {
                type: Object,
                required: true,
            },
            cartCount: {
                type: Number,
                required: true,
            }
        }
    }
</script>
