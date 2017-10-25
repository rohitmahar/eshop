import axios from 'axios';
import Vue from 'vue';
import VuePagination from '../components/Pagination.vue';

axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};

new Vue({
    el: '#customers',
    data: {
        customers: [],
        loading: false,
        error: false,
        query: '',
        url: '',
        pagination: {
            total: 0,
            per_page: 5,
            from: 1,
            to: 0,
            current_page: 1
        },
        offset: 4
    },
    mounted() {
        this.getCustomers();
    },
    components: {
        VuePagination,
    },
    methods: {
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
        }
    }
});