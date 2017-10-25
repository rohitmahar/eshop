<template>
    <div class="men">
        <div class="container">
            <div class="row product-row" style="padding-top:40px;">
                <h3 class="text-center"> <span >Featured Products</span></h3>
                <div style="margin-bottom: 50px;"></div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <span>Sort By</span>
                    <select class="sort-products" @change="sort()" v-model="selectedItem">
                        <option value="price">Price</option>
                        <option value="title">Name</option>
                    </select>
                </div>
                <div class="col-md-4 text-center">
                    <input type="text" name="search"
                           placeholder="Search Products"
                           class="text-center"
                           v-model="query"
                           @change="search()"
                           style="width:300px;margin: 40px 0;"
                    >
                    <button class="btn btn-default" type="button" disabled="disabled" v-cloak
                            v-if="loading">
                        searching...
                    </button>
                </div>
                <div class="col-md-4">
                    <vue-pagination :pagination="pagination"
                                    @click.native="paginateHandler">
                    </vue-pagination>
                </div>
            </div>
            <div class="alert alert-danger" v-cloak role="alert" v-if="error">
                @{{ error }}
            </div>
            <div class="row product-row" v-if="products.length !== 0">
                <product-list
                        :products="products"
                >
                </product-list>
                <div class="clearfix"></div>
                <vue-pagination :pagination="pagination"
                                @click.native="paginateHandler">
                </vue-pagination>
            </div>
            <div class="row product-row text-center" v-else>
                No products found.
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
    import VuePagination from '../components/Pagination.vue';
    import ProductList from '../components/ProductList.vue';
    import { shortDescription } from '../utils/index';

    export default {
        name: 'FeaturedProducts',
        data() {
            return {
                query: null,
                selectedItem: null,
            };
        },
        props: {
            products: {
                required: true,
                type: Array,
            },
            paginateHandler: {
                type: Function,
                required: true,
            },
            loading: {
                required: true,
                type: Boolean,
            },
            error: {
                required: false,
                type: String,
            },
            pagination: {
                required: true,
                type: Object,
            }
        },
        components: {
            VuePagination,
            ProductList,
        },
        methods: {
            shortDescription,
            sort() {
                this.$root.$emit('SORT_PRODUCT', this.selectedItem);
            },
            search() {
                this.$root.$emit('SEARCH_PRODUCT', this.query);
            }
        },
    }
</script>