<template>
    <div class="bg">
        <div class="container-fluid mb-5">
            <div class="col-md-12 pt-4">
                <div class="row">
                    <div class="col-md-3">
                        <h4 class="font-weight-bold mt-4"> Announcement </h4>
                        <hr class="m-0 hr-15">
                        <div v-if="announcements.length === 0">
                            <div class="mt-3 text-center">
                                Empty
                            </div>
                        </div>
                        <div v-else>
                            <div class="mt-3 ml-2" v-for="a in announcements" :key="a.index">
                                <div class="font-weight-bold color-blue-green"> {{ a.title }} </div>
                                <div> {{ formatDate(a.announcement_date) }} </div>
                                <div class="text-indent text-justify mt-2" style="width:95%"> {{ a.description }} </div>
                                <hr>
                            </div>
                            <div class="d-flex justify-content-end">
                                <a href="/announcements/all" class="blue-link">See All Announcements</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 shadow">
                        <div class="col-md-12 mb-4">
                            <div class="font-avenir font-index-big text-right">
                                <span style="color: #F6B239">CBA</span><span style="color: #2B4D59">SC</span><span style="color: #39998E">.</span>
                            </div>
                            <div class="mb-4 text-center">
                                <span class="font-weight-bold" style="letter-spacing: 2px; font-size:18px"> College Of Business Administration Student Council</span>
                            </div>
                            <p class="text-indent text-justify">
                                The College of Business Administration Student Council dedicates itself to continue to advance and be steadfast in fighting for the rights and welfare of the students.
                            </p>
                            <p class="text-indent text-justify">
                                The College of Business Administration Student Council is and will continually be known as the highest student-body in the CBA Community that has passion to serve the students, faculty, and administration; and has eyes for innovation, growth, and improvement.
                            </p>
                        </div>
                        <div class="text-center mt-5 mb-5">
                            <a href="https://bit.ly/UEMlaCBA21-22" class="olOffice">
                                <h3 class="font-weight-bold mb-0">Online <span style="color: #2B4D59">BA</span><span style="color: #F6B239">SC</span> Office</h3>
                                <h6 class="mt-0">Click Here</h6>
                            </a>
                        </div>
                        <div class="col-md-12 mt-4">
                            <h4 class="font-weight-bold"> Newsletter </h4>
                            <div class="mb-4">
                                <span> Published: MM-DD-YYYY </span>
                            </div>
                            <img src="images/magazine-page.png" alt="Newsletter Page" class="mb-3" style="height: 100%; width: 100%;">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div>
                            <h4 class="font-weight-bold mt-4 ml-4"> Transparency Report </h4>
                            <hr class="m-0 hr-15 ml-4">
                            <div v-if="transparency_reports.length === 0">
                                <div class="mt-3 text-center">
                                    Empty
                                </div>
                            </div>
                            <div v-else>
                                <div class="mt-4 ml-2" v-for="report in transparency_reports" :key="report.index">
                                    <div class=" d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="font-weight-bold color-blue-green"> {{ report.title }} </div>
                                            <div> {{ formatDate(report.event_date) }} </div>
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
                                <div class="d-flex justify-content-end">
                                    <a href="#" class="blue-link">See All Reports</a>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5">
                            <h4 class="font-weight-bold mt-4 ml-4"> Progress Report </h4>
                            <hr class="m-0 hr-15 ml-4">
                            <div v-if="progress_reports.length === 0">
                                <div class="mt-3 text-center">
                                    Empty
                                </div>
                            </div>
                            <div v-else>
                                <div class="mt-4 ml-2" v-for="report in progress_reports" :key="report.index">
                                    <div class=" d-flex justify-content-between align-items-center">
                                        <div class="mr-2">
                                            <div class="font-weight-bold color-blue-green"> {{ report.title }} </div>
                                            <div> {{ report.description }} </div>
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
                                <div class="d-flex justify-content-end">
                                    <a href="#" class="blue-link">See All Reports</a>
                                </div>
                            </div>
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
                transparency_reports: [],
                progress_reports: [],
                announcements: [],
            }
        },
        mounted() {
          this.getProgressReports();
          this.getTransparencyReports();
          this.getAnnouncements();
        },
        methods: {
            getAnnouncements() {
                axios.get('//' + window.location.host + '/announcements/getThreeAnnouncement')
                    .then(response => {
                        this.announcements = response.data
                    })
            },
            getProgressReports() {
                axios.get('//' + window.location.host + '/reports/getProgressReports')
                .then(response => {
                    this.progress_reports = response.data;
                })
            },
            getTransparencyReports() {
                axios.get('//' + window.location.host + '/reports/getTransparencyReports')
                    .then(response => {
                        this.transparency_reports = response.data;
                    })
            },
            formatDate(date){
                return moment(date).format('MMM. DD, YYYY')
            }
        }
    }
</script>
