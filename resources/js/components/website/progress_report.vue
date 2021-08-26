<template>
    <div class="other-bg">
        <div class="container-fluid mb-5">
            <div class="col-md-12 pt-4">
                <button type="button" class="btn btn-secondary mb-5" @click="goBack"> Go Back </button>
                <div class="container">
                    <h4 class="font-weight-bold"> All Progress Reports </h4>
                    <hr class="m-0 hr-10">

                    <div v-if="pr_report.length === 0">
                        <div class="mt-3 text-center">
                            Empty
                        </div>
                    </div>
                    <div v-else>
                        <div class="mt-4 ml-2" v-for="report in pr_report" :key="report.index">
                            <div class=" d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="font-weight-bold color-blue-green"> {{ report.title }} </div>
                                    <div> {{ formatDate(report.event_date) }} </div>
                                    <div class="text-indent text-justify mt-2 ml-2" style="width:90%"> {{ report.description }} </div>
                                </div>
                                <div>
                                    <a :href="report.file" :download="report.title" v-if="report.file !== null">
                                        <button class="btn btn-yellow" type="submit"><i class="fas fa-file-download"></i></button>
                                    </a>
                                    <span v-else></span>
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
        props: ['p_report'],
        data() {
            return {
                pr_report: this.p_report,
            }
        },
        mounted() {

        },
        methods: {
            removePath(path) {
                console.log(path)
            },
            goBack() {
                location.replace('/');
            },
            formatDate(date){
                return moment(date).format('MMM. DD, YYYY')
            }
        }
    }
</script>
