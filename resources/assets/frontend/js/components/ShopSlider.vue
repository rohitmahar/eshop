<template>
    <div id="slider" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
            <div class="item" :class="index == 0 ? 'active' : ''"  v-for="(slider, index) in sliders">
                <img :src="slider.image" :alt="slider.title">
                <div class="carousel-caption">
                    <h4>{{ slider.title }}</h4>
                    <p>{{ slider.description }}</p>
                </div>
            </div>
        </div>
        <a class="left carousel-control" href="#slider" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"><i class="ion ion-chevron-left"></i></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#slider" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"><i class="ion ion-chevron-right"></i></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</template>

<script type="text/javascript">
    export default {
        name: 'ShopSlider',
        props: {
            sliders: {
                required: true,
                type: Array,
            },
        },
    };
</script>