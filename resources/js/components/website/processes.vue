<template>
    <div class="other-bg">
        <div class="container mb-5">
            <div class="col-md-10 pt-4">
                <h2 class="font-weight-bold mt-4 color-blue-green mb-4"> Processes </h2>
                <div class="row mb-5 pl-3" v-for="n in loop">
                    <h5 class="font-weight-bold"> Process {{ n }} </h5>
                    <p class="text-indent text-justify">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eget nisl enim. Nulla id risus tempor,
                        sagittis urna quis, mollis est. Suspendisse potenti. Maecenas ipsum nulla, auctor a libero a, efficitur dictum mauris.
                        Proin tempus luctus justo sed commodo. Quisque lacinia lacus elit, eu hendrerit metus porttitor at.
                        Pellentesque varius est tortor, at faucibus ante tempus ac.
                    </p>
                    <button type="button" class="btn btn-primary mr-4"> Video Tutorial </button>
                    <button type="button" class="btn btn-primary mr-4"> Audio Tutorial </button>
                    <button type="button" class="btn btn-primary mr-4"> Download Process {{ n }} </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            loop: ["1", "2", "3", "4", "5"],
        }
    }
}
</script>
