<template>
    <div class="other-bg">
        <div class="container-fluid mb-5">
            <div class="col-md-12 pt-4">
                <button type="button" class="btn btn-secondary mb-5" @click="goBack"> Go Back </button>
                <div class="container">
                    <h4 class="font-weight-bold"> All Announcements </h4>
                    <hr class="m-0 hr-10">

                    <div v-if="announcement.length === 0">
                        <div class="mt-3 text-center">
                            Empty
                        </div>
                    </div>
                    <div v-else>
                        <div class="mt-4 ml-3" v-for="a in announcement" :key="a.index">
                            <div class="font-weight-bold color-blue-green"> {{ a.title }} </div>
                            <div> {{ formatDate(a.announcement_date) }} </div>
                            <div class="text-indent text-justify mt-2" style="width:95%"> {{ a.description }} </div>
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
        props: ['all'],
        data() {
            return {
                announcement: this.all,
            }
        },
        mounted() {
            console.log(this.announcement)
        },
        methods: {
            goBack() {
                location.replace('/');
            },
            formatDate(date){
                return moment(date).format('MMM. DD, YYYY')
            }
        }
    }
</script>
