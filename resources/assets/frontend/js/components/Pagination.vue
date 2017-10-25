<template>
    <div class="pull-right">
        <button class="btn-default page-btn" v-if="pagination.current_page > 1" v-on:click.prevent="changePage(pagination.current_page - 1)">
            <i class="ion ion-chevron-left"></i>
        </button>
        <span v-if="pagination.last_page > 1">{{pagination.current_page}} / {{pagination.last_page}}</span>
        <button class="btn-default page-btn" v-if="pagination.current_page < pagination.last_page" v-on:click.prevent="changePage(pagination.current_page + 1)">
            <i class="ion ion-chevron-right"></i>
        </button>
    </div>
</template>

<script type="text/javascript">
export default {
    props: {
        pagination: {
            type: Object,
            required: true,
        },
    },
    methods: {
        changePage(page) {
            this.pagination.current_page = page;
        },
    },
}
</script>
