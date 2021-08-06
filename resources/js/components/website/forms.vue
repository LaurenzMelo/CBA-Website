<template>
    <div class="other-bg">
        <div class="container mb-5">
            <div class="col-md-12 pt-4">
                <h2 class="font-weight-bold mt-4 color-blue-green mb-4"> Downloadable Forms </h2>
                <div class="row" v-for="n in loop" style="margin-bottom:40px">
                    <div class="col-md-7">
                        <h5 class="font-weight-bold"> Form {{ n }} </h5>
                        <p class="text-indent text-justify">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eget nisl enim. Nulla id risus tempor,
                            sagittis urna quis, mollis est. Suspendisse potenti. Maecenas ipsum nulla, auctor a libero a, efficitur dictum mauris.
                        </p>
                    </div>
                    <div class="col-md-4 offset-md-1">
                        <div class="nav-red text-center">
                            <h6 class="font-weight-bold pt-1 pb-1" style="color: #FFFFFF"> How to accomplish Form {{ n }} </h6>
                        </div>
                        <div> How to Accomplish Form 1</div>
                        <div> Video Tutorial </div>
                        <div> Audio Tutorial </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            loop: ["1", "2", "3"],
        }
    }
}
</script>
