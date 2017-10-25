import axios from 'axios';
import Vue from 'vue';
import VuePagination from '../components/Pagination.vue';

axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};
/*
const productCategory = new Vue({
    el: '#productCategory',
    data: {
        finds: [],
    },
    methods: {
        addFind(e) {
            e.preventDefault();
            this.finds.push({ value: '' });
        },
        removeInput(index) {
            this.finds.splice(index, 1);
        }
    }
});*/
new Vue({
    el: '#productApp',
    data: {
        url: null,
        products: [],
        loading: false,
        error: false,
        fetchError: null,
        query: null,
        pagination: {
            total: 0,
            per_page: 5,
            from: 1,
            to: 0,
            current_page: 1
        },
        offset: 4,
        mainCategories: [],
        subCategories: [],
        finds: [],
        category: {
            subcategories: [],
        },
    },
    mounted() {
        this.getMainCategory();
        this.getProducts(this.pagination.current_page, this.pagination.per_page);
        if(this.currentUrl.includes('products') && this.currentUrl.includes('category') && this.currentUrl.includes('edit')) {
            const categoryId = this.currentUrl[5];
            this.getProductCategory(categoryId);
        }
    },
    components: {
      VuePagination,
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
                return this.currentUrl[5];
            }
        },
    },
    methods: {
        addFind(e) {
            e.preventDefault();
            this.finds.push({ value: '' });
        },
        removeInput(index) {
            this.finds.splice(index, 1);
        },
        getProductCategory(categoryId) {
            axios.get(`/api/category/${categoryId}`)
                .then((response) => {
                    this.category = response.data;
                })
                .catch(() => {
                    this.fetchError = 'Error on fetching Products';
                });
        },
        removeCategory(index) {
            this.category.subcategories.splice(index, 1);
        },
        getProducts() {
            if(this.query) {
                this.url = `/api/product?page=${this.pagination.current_page}&&per_page=${this.pagination.per_page}&&filter=${this.query}`;
            } else {
                this.url = `/api/product?page=${this.pagination.current_page}&&per_page=${this.pagination.per_page}`;
            }
            axios.get(this.url)
                .then((response) => {
                    this.products   = response.data.data;
                    this.pagination = response.data;
                    this.loading = false;
                })
                .catch(() => {
                    this.fetchError = 'Error on fetching Products';
                });
        },
        getMainCategory() {
            axios.get(`/api/category`)
                .then((response) => {
                    this.mainCategories = response.data;
                })
                .catch(() => {
                    this.fetchError = 'Error on fetching Products';
                });
        },
        getSubCategories(event) {
            console.log(event.target.value);
            axios.get(`/api/sub-category/${event.target.value}`)
                .then((response) => {
                    this.subCategories = response.data;
                })
                .catch(() => {
                    this.fetchError = 'Error on fetching Products';
                });
        },
        search() {
            this.error = null;
            this.loading = true;
            console.log('Hello how you doign');
            this.getProducts();
        },
    }
});