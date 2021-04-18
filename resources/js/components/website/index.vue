<template>
    <div>
        <div class="container-fluid mb-5">
            <div class="col-md-12 mt-4">
                <div class="row">
                    <div class="col-md-3">
                        <h4 class="font-weight-bold mt-4"> Announcement </h4>
                        <hr class="m-0 hr-15">
                        <div class="mt-3 ml-2" v-for="l in loop">
                            <div class="font-weight-bold" style="color:#39998E"> Announcement Title {{ l }}</div>
                            <div> MM-DD-YYYY </div>
                            <div class="text-indent text-justify mt-2" style="width:95%"> Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Donec feugiat lacus purus, ac elementum nisl finibus at.
                                Pellentesque quis elit id leo vehicula tempor.
                            </div>
                            <hr>
                        </div>
                    </div>
                    <div class="col-md-6 shadow">
                        <div class="col-md-12 mb-4">
                            <div class="font-avenir font-index-big text-right">
                                <span style="color: #DA674A">CBA</span><span style="color: #2B4D59">SC</span><span style="color: #39998E">.</span>
                            </div>
                            <div class="mb-4 text-center">
                                <span class="font-weight-bold" style="letter-spacing: 2px; font-size:18px"> College Of Business Administration Student Council</span>
                            </div>
                            <p class="text-indent text-justify">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Donec feugiat lacus purus, ac elementum nisl finibus at.
                                Pellentesque quis elit id leo vehicula tempor.
                                Praesent eu ipsum non urna volutpat vehicula.
                                Donec pulvinar dapibus vulputate. Quisque eget nisi dui.
                                Suspendisse tincidunt urna a urna convallis consectetur.
                                Ut tincidunt rhoncus quam, id vehicula magna fermentum ut.
                            </p>
                        </div>
                        <hr>
                        <div class="col-md-12 mt-4">
                            <h4 class="font-weight-bold"> Newsletter </h4>
                            <div class="mb-4">
                                <span> Published: MM-DD-YYYY </span>
                            </div>
                            <img src="images/magazine-page.png" alt="Newsletter Page" class="mb-3" style="height: 100%; width: 100%;">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h4 class="font-weight-bold mt-4 ml-4"> Transparency Report </h4>
                        <hr class="m-0 hr-15 ml-4">
                        <div class="mt-4 ml-2" v-for="l in loop">
                            <div class=" d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="font-weight-bold" style="color:#39998E"> Event Title {{ l }} </div>
                                    <div> MM-DD-YYYY </div>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-orange text-center"> Download Report </button>
                                </div>
                            </div>
                            <hr>
                        </div>
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
