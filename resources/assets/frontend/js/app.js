import Vue from 'vue';
import axios from 'axios';
import VuePagination from './components/Pagination.vue';
import EshopNavigation from './components/Navigation.vue';
import ShopHeader from './components/Header.vue';
import ShopFooter from './components/Footer.vue';
import HomePage from './pages/HomePage.vue';
import CategoryProducts from './pages/CategoryProducts.vue';
import TermsAndConditions from './pages/TermsAndConditions.vue';

axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};

require('../sass/app.scss');

const eshopApp = new Vue({
    data: {
        purchases: [],
        productCategoryTitle: '',
        selectedCategoryProduct: '',
        selectedItem: '',
        sliders: [],
        categories: [],
        slider_number: 0,
        products: [],
        categoryProducts: [],
        loading: false,
        error: '',
        query: '',
        url: '',
        pagination: {
            total: 0,
            per_page: 8,
            from: 1,
            to: 0,
            current_page: 1
        },
    },
    computed: {
        currentUrl() {
            return window.location.pathname.split('/');
        },
        checkCategoryUrl() {
            return this.currentUrl.includes('category') && this.currentUrl.includes('products');
        },
        returnCategoryId() {
            if(this.checkCategoryUrl) {
                return this.currentUrl[2];
            }
        },
    },
    mounted() {
        this.getSliders();
        this.getProductsByCategory();
        this.getAllProductCategories();
        this.getPaginatedPurchasedOrders();
        this.getProducts();
        this.$on('SORT_PRODUCT', (searchItem) => {
            this.query = '';
            this.selectedItem = searchItem;
            this.getProducts();
        });
        this.$on('SEARCH_PRODUCT', (query) => {
            this.error = '';
            this.products = [];
            this.loading = true;
            this.query = query;
            this.getProducts();
        });
        this.$on('SORT_Category_PRODUCTS', (sortItem) => {
            this.query = '';
            this.categoryProducts = [];
            this.selectedCategoryProduct = sortItem;
            this.getPaginatedProductsByCategory();
        });
        this.$on('SEARCH_PRODUCT_BY_CATEGORY', (query) => {
            this.error = '';
            this.categoryProducts = [];
            this.loading = true;
            this.query = query;
            this.getPaginatedProductsByCategory();
        });
    },
    components: {
        VuePagination,
        EshopNavigation,
        ShopHeader,
        ShopFooter,
        HomePage,
        CategoryProducts,
        TermsAndConditions,
    },
    methods: {
        sortCategoryProducts() {
            this.getPaginatedProductsByCategory();
        },
        shortDescription(description) {
            return  description.substring(0,50);
        },
        sortProducts() {
            this.query = '';
            this.getProducts();
        },
        getProductsByCategory() {
            if (this.returnCategoryId) {
                this.getPaginatedProductsByCategory();
            }
        },
        getPaginatedProductsByCategory() {
            let url;
            if(this.query) {
                url = `/api/category/${this.returnCategoryId}/products?page=${this.pagination.current_page}&&per_page=${this.pagination.per_page}&&filter=${this.query}`;
            }
            else if(this.selectedCategoryProduct) {
                url = `/api/category/${this.returnCategoryId}/products?page=${this.pagination.current_page}&&per_page=${this.pagination.per_page}&&sort=${this.selectedCategoryProduct}`;
            } else {
                url = `/api/category/${this.returnCategoryId}/products?page=${this.pagination.current_page}&&per_page=${this.pagination.per_page}`;
            }
            axios.get(url)
                .then((response) => {
                    this.categoryProducts = response.data.data;
                    this.pagination = response.data;
                    this.loading = false;
                })
                .catch(() => {
                    this.fetchError = 'Error on fetching Products';
                });
        },
        getProducts() {
            if(this.query) {
                this.url = `/api/product?page=${this.pagination.current_page}&&per_page=${this.pagination.per_page}&&filter=${this.query}`;
            }
            else if(this.selectedItem) {
                this.url = `/api/product?page=${this.pagination.current_page}&&per_page=${this.pagination.per_page}&&sort=${this.selectedItem}`;
            } else {
                this.url = `/api/product?page=${this.pagination.current_page}&&per_page=${this.pagination.per_page}`;
            }
            axios.get(this.url)
                .then((response) => {
                    this.products = response.data.data;
                    this.pagination = response.data;
                    this.loading = false;
                })
                .catch(() => {
                    this.fetchError = 'Error on fetching Products';
                });
        },
        search() {
            this.error = '';
            this.products = [];
            this.loading = true;
            this.getProducts();
        },
        searchByCategory() {
            this.error = '';
            this.products = [];
            this.loading = true;
            this.getPaginatedProductsByCategory();
        },
        getSliders() {
            axios.get('/api/slider')
                .then((response) => this.sliders = response.data)
                .catch(() => this.fetchError = 'Error on fetching Products' );
        },
        isActive() {
            if(this.sliders.id == 3) {
                return true;
            }
        },
        getAllProductCategories() {
            axios.get('/api/all-category')
                .then((response) => {
                    this.categories = response.data;
                    this.categories.map((category) => {
                        if(category.id == this.returnCategoryId) {
                            this.productCategoryTitle =  category.title + '`S';
                        } else {
                            category.children.map((subCategory) => {
                                if(subCategory.id == this.returnCategoryId) {
                                    this.productCategoryTitle =  subCategory.title;
                                }
                            })
                        }
                    })
                })
                .catch(() => {
                    this.fetchError = 'Error on fetching product categories';
                });
        },
        getPaginatedPurchasedOrders() {
            const userId = $('#authUserId').val();
            const url = `/api/product/purchased-order?page=${this.pagination.current_page}&&per_page=5&&user_id=${userId}`;
            axios.get(url)
                .then((response) => {
                    this.purchases = response.data.data;
                    this.pagination = response.data;
                    this.loading = false;
                })
                .catch(() => {
                    this.fetchError = 'Error on fetching Products';
                });
        },
    }
});
eshopApp.$mount('#app');