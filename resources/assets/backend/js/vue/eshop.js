import axios from 'axios';
import Vue from 'vue';
import VuePagination from '../components/Pagination.vue';

axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};

const eshopBackend = new Vue({
    data: {
        finds: [],
        findsCategories: [],
        category: {
            subcategories: [],
        },
        mainCategories: [],
        currentUrl: null,
        subCategories: [],
        customers: [],
        sliders: [],
        loading: false,
        error: false,
        query: '',
        url: '',
        orders: [],
        admins: [],
        products: [],
        url: null,
        pagination: {
            total: 0,
            per_page: 5,
            from: 1,
            to: 0,
            current_page: 1
        },
        offset: 4
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
    mounted() {
        this.getAdmins();
        this.getSliders();
        this.getPaginatedOrders();
        this.getCustomers();
        this.getProducts();
        this.getMainCategory();
        if(this.currentUrl.includes('products') && this.currentUrl.includes('category') && this.currentUrl.includes('edit')) {
            const categoryId = this.currentUrl[5];
            this.getProductCategory(categoryId);
        }
    },
    components: {
      VuePagination,
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
        removeInput(index) {
            this.finds.splice(index, 1);
        },
        getAdmins() {
            axios.get('/api/admin')
                .then((response) => {
                    this.admins = response;
                })
                .catch(() => {
                    this.fetchError = 'Error on fetching admins';
                });
        },
        getPaginatedOrders() {
            this.url = `/api/product/order?page=${this.pagination.current_page}&&per_page=${this.pagination.per_page}`;
            axios.get(this.url)
                .then((response) => {
                    this.orders = response.data.data;
                    this.pagination = response.data;
                    this.loading = false;
                })
                .catch(() => {
                    this.fetchError = 'Error on fetching Products';
                });
        },
        // methods For Customers
        getCustomers() {
            if(this.query) {
                this.url = `/api/customer?page=${this.pagination.current_page}&&per_page=${this.pagination.per_page}&&filter=${this.query}`;
            } else {
                this.url = `/api/customer?page=${this.pagination.current_page}&&per_page=${this.pagination.per_page}`;
            }
            axios.get(this.url)
                .then((response) => {
                    this.customers = response.data.data;
                    this.pagination = response.data;
                    this.loading = false;
                })
                .catch(() => {
                    this.fetchError = 'Error on fetching Products';
                });
        },
        search() {
            this.error = '';
            this.customers = [];
            this.loading = true;
            this.getCustomers();
        },
        // methods For Sliders
        getSliders() {
            axios.get(`/api/slider`)
                .then((response) => {
                    this.sliders = response.data;
                })
                .catch(() => {
                    this.fetchError = 'Error on fetching Products';
                });
        },
        getEditUrl: function(slider_id) {
            return '/backend/sliders/'+ slider_id + '/edit';
        },
        getShowUrl: function(slider_id) {
            return '/backend/sliders/' + slider_id ;
        },
        getDeleteConfirmUrl: function(slider_id) {
            return '/backend/sliders/'+slider_id+'/confirm';
        },
        // Product Edit Category methods
        addFind(e) {
            e.preventDefault();
            this.finds.push({ value: '' });
        },
        removeCategory(index) {
            this.category.subcategories.splice(index, 1);
        },

        // Javascriot For Category
        getMainCategory() {
            axios.get(`/api/category`)
                .then((response) => {
                    this.mainCategories = response.data;
                })
                .catch(() => {
                    this.fetchError = 'Error on fetching Products';
                });
        },
        getSubCategories(categoryId) {
            axios.get(`/api/sub-category/${categoryId}`)
                .then((response) => {
                    this.subCategories = response.data;
                })
                .catch(() => {
                    this.fetchError = 'Error on fetching Products';
                });
        },
        // methods for products
        getProducts() {
            if(this.query) {
                this.url = `/api/product?page=${this.pagination.current_page}&&per_page=${this.pagination.per_page}&&filter=${this.query}`;
            } else {
                this.url = `/api/product?page=${this.pagination.current_page}&&per_page=${this.pagination.per_page}`;
            }
            axios.get(this.url)
                .then((response) => {
                    this.products   =   response.data.data;
                    this.pagination = response.data;
                    this.loading = false;
                })
                .catch(() => {
                    this.fetchError = 'Error on fetching Products';
                });
        },
        search() {
            this.error = '';
            this.loading = true;
            this.getProducts();
        },
        editUrl: function(product_id) {
            return '/admin/products/edit/'+ product_id ;
        },
        showUrl: function(product_id) {
            return '/admin/products/show/' + product_id ;
        },
        deleteUrl: function(product_id) {
            return '/admin/products/delete/' + product_id;
        },
    }
});
eshopBackend.$mount('#app');