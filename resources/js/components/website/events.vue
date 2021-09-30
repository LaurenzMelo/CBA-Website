<template>
    <div class="other-bg">
        <div class="container-fluid mb-5">
            <div class="col-md-12 pt-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <div class="font-avenir font-index-big text-center font-index-mobile-fit">
                                <span style="color: #F6B239; text-shadow: 4px 4px #2B4D59">UP</span> <span style="color: #2B4D59; text-shadow: 4px 4px #F6B239">NEXT</span>
                            </div>
                            <div v-if="upcoming.length !== 0">
                                <div v-for="event in upcoming" :key="event.id" class="p-3 pl-4 pr-4 d-flex align-items-center justify-content-between mb-4" style="border-bottom: 5px solid #F6B239; border-radius: 25px">
                                    <div>
                                        <h6 class="font-weight-bold">{{ event.name }}</h6>
                                        <h6>{{ formatDate(event.event_date)}}</h6>
                                    </div>
                                    <div>
                                        <a data-toggle="modal" data-target="#viewActiveEventModal" class="cursor-pointer" @click="transferEvent(event)"><i class="far fa-eye fa-3x color-blue-green"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div v-else>
                                <div class="text-center">  
                                    <h4>Empty</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <div class="font-avenir font-index-big text-center font-index-mobile-fit">
                                <span style="color: #888888; letter-spacing: -6px">PREVIOUS</span>
                            </div>
                            <div v-if="done.length !== 0">
                                <div v-for="event in done" :key="event.id" class="p-3 pl-4 pr-4 d-flex align-items-center justify-content-between mb-4" style="border-bottom: 5px solid #888888; border-radius: 25px">
                                    <div>
                                        <h6 class="font-weight-bold">{{ event.name }}</h6>
                                        <h6>{{ formatDate(event.event_date)}}</h6>
                                    </div>
                                    <div>
                                        <a data-toggle="modal" data-target="#viewActiveEventModal" class="cursor-pointer" @click="transferEvent(event)"><i class="fas fa-eye fa-3x" style="color: #888888"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div v-else>
                                <div class="text-center">  
                                    <h4>Empty</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="viewActiveEventModal" tabindex="-1" role="dialog" aria-labelledby="viewActiveEventModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewEventModalLabel"><span class="font-weight-bold">{{ chosen_event.name }}</span> </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body pl-5 pr-5">
                        <img :src='chosen_event.pubmat_img' height='100%' width='100%'>
                        <div>
                            <h4 class="text-center mt-4">
                                {{ formatDate(chosen_event.event_date) }}
                            </h4>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-6 text-center">
                                <label class="font-weight-bold">
                                    Type
                                </label>
                                <h6>
                                    {{ chosen_event.type }}
                                </h6>
                            </div>
                            <div class="col-md-6 text-center">
                                <label class="font-weight-bold">
                                    Target Audience
                                </label>
                                <h6>
                                    {{ chosen_event.target_audience }}
                                </h6>
                            </div>
                        </div>
                        <div class="mt-4">
                            <label class="font-weight-bold">
                                Definition: 
                            </label>
                            <p class="text-justify text-indent mt-4 mb-2" v-for="(con, index) in paragraph_content" :key="index">
                                {{ con.paragraph }}
                            </p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="viewInactiveEventModal" tabindex="-1" role="dialog" aria-labelledby="viewInactiveEventModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewEventModalLabel"><span class="font-weight-bold">{{ chosen_event.title }}</span> </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body pl-5 pr-5">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
                upcoming: [],
                done: [],
                chosen_event: [],
                paragraph_content:  [{
                    paragraph: '',
                }],
            }
        },
        mounted() {
          this.getDetailedEvent();
        },
        methods: {
            transferEvent(event) {
                this.chosen_event = event
                this.paragraph_content = JSON.parse(event.full_details)
                console.log(this.chosen_event)
            },
            getDetailedEvent() {
                axios.get('//' + window.location.host + '/events/getDetailedEvents')
                .then(response => {
                    this.upcoming = response.data.upcoming;
                    this.done = response.data.done;
                })
            },
            formatDate(date){
                return moment(date).format('MMM. DD, YYYY')
            }
        }
    }
</script>


