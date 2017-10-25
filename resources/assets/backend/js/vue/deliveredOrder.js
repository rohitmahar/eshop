import axios from 'axios';
import Vue from 'vue';
import VuePagination from '../components/Pagination.vue';

axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};

new Vue({
    el: '#deliveredOrders',
    data: {
        orders: [],
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
        this.getPaginatedDeliveredOrders();
    },
    components: {
      VuePagination,
    },
    methods: {
        getPaginatedDeliveredOrders() {
            this.url = `/api/product/delivered-order?page=${this.pagination.current_page}&&per_page=${this.pagination.per_page}`;
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
    }
});