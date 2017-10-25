<template>
    <div class="men">
        <div class="container">
            <div class="row filter-section">
                <h3 class="text-center featured-title" v-cloak>
                    <span>{{ categoryTitle }}</span>
                </h3>
                <div class="col-md-4">
                    <span>Sort By</span>
                    <select class="sort-products" @change="sortCategoryProducts()" v-model="selectedCategoryProduct">
                        <option value="price">Price</option>
                        <option value="title">Name</option>
                    </select>
                </div>
                <div class="col-md-4 text-center">
                    <input type="text" name="search"
                           placeholder="Search Products"
                           class="text-center"
                           v-model="query"
                           @change="searchByCategory()"
                           style="width:300px;margin: 40px 0;"
                    >
                    <button class="btn btn-default" type="button" disabled="disabled" v-cloak
                            v-if="loading">
                        searching...
                    </button>
                </div>
                <div class="col-md-4">
                    <vue-pagination
                            v-bind:pagination="pagination"
                            v-on:click.native="paginateHandler"
                    >
                    </vue-pagination>
                </div>
            </div>
            <div class="alert alert-danger" v-cloak v-if="error">
                {{ error }}
            </div>
            <div class="row product-row" v-if="products.length != 0">
                <product-list
                        :products="products"
                >
                </product-list>
                <div class="clearfix"></div>
                <vue-pagination
                        v-bind:pagination="pagination"
                        v-on:click.native="paginateHandler"
                >
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
        name: 'CategoryProducts',
        data() {
            return {
                query: null,
                selectedCategoryProduct: null,
                pagination: {
                    total: 0,
                    per_page: 8,
                    from: 1,
                    to: 0,
                    current_page: 1
                },
            };
        },
        props: {
            categoryTitle: {
                type: String,
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
        },
        methods: {
            shortDescription,
            sortCategoryProducts() {
                this.$root.$emit('SORT_Category_PRODUCTS', this.selectedCategoryProduct);
            },
            searchByCategory() {
                this.$root.$emit('SEARCH_PRODUCT_BY_CATEGORY', this.query);
            },
        },
        components: {
            VuePagination,
            ProductList,
        },
    }
</script>