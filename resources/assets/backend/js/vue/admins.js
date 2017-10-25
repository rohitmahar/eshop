import axios from 'axios';
import Vue from 'vue';

axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};

new Vue({
    el: '#admins',
    data: {
        admins: []
    },
    mounted() {
        this.getAdmins();
    },
    methods: {
        getAdmins() {
            axios.get('/api/admin')
                .then((response) => {
                    this.admins = response.data;
                })
                .catch(() => {
                    this.fetchError = 'Error on fetching admins';
                });
        },
    }
});