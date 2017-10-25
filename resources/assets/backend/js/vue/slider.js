import axios from 'axios';
import Vue from 'vue';

axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};

new Vue({
    el: '#sliders',
    data: {
        sliders: []
    },
    mounted() {
        this.getSliders();
    },
    methods: {
        getSliders() {
            axios.get(`/api/slider`)
                .then((response) => {
                    this.sliders = response.data;
                })
                .catch(() => {
                    this.fetchError = 'Error on fetching Products';
                });
        },
    }
});