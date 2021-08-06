<template>
    <div class="other-bg">
        <div class="container mb-5">
            <div class="col-md-12 pt-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="col-md-12 border shadow p-5">
                            <h4 class="font-weight-bold text-center mb-4 color-red"> College Of Business Administration </h4>
                            <div class="mb-4" v-for="head in cba_heads">
                                <h6 class="font-weight-bold color-blue-green mb-0">{{ head.position }}</h6>
                                <div class="d-flex justify-content-between">
                                    <div>{{ head.name }}</div>
                                    <div>{{ head.email }}</div>
                                </div>
                            </div>
                            <h6 class="font-weight-bold color-blue-green mb-3 mt-5">Department Chairs</h6>
                            <div class="mb-4 pl-3" v-for="dept in dept_chairs">
                                <h6 class="font-weight-bold color-blue-green mb-0">{{ dept.department }}</h6>
                                <div class="d-flex justify-content-between">
                                    <div>{{ dept.name }}</div>
                                    <div>{{ dept.email }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-12 border shadow p-5">
                            <h4 class="font-weight-bold text-center mb-4 color-yellow"> CBA Student Council A.Y. 2021-2022 </h4>
                            <div class="row d-flex justify-content-around mt-5">
                                <img src="images/fb.svg" class="social-icons" alt="fb-icon">
                                <img src="images/ig.svg" class="social-icons" alt="ig-icon">
                                <img src="images/twitter.svg" class="social-icons" alt="twitter-icon">
                                <img src="images/gmail.svg" class="social-icons" alt="gmail-icon">
                            </div>
                            <h5 class="font-weight-bold mt-5 text-center color-blue-green"> ONLINE CBASC OFFICE </h5>
                            <a href="https://bit.ly/UEMlaCBA21-22"><h6 class="text-center">https://bit.ly/UEMlaCBA21-22</h6></a>
                            <img src="images/mountains2.jpg" height="100%" width="100%" alt="mountains" class="mt-4">
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
            cba_heads: [
                {
                    position: 'College Dean',
                    name: 'Dean Veronica N. Elizalde',
                    email: 'email@ue.edu.ph'
                },
                {
                    position: 'Associate Dean',
                    name: 'Assoc. Dean Angelito C. Descalzo',
                    email: 'email@ue.edu.ph'
                },
                {
                    position: 'College Secretary',
                    name: 'College Sec. Ofelia D. Nilo',
                    email: 'email@ue.edu.ph'
                },
                {
                    position: 'OJT College Evaluator',
                    name: 'Mr. Ernesto Cobalito',
                    email: 'email@ue.edu.ph'
                }
            ],
            dept_chairs: [
                {
                    department: 'Department 1',
                    name: 'Juan Dela Cruz',
                    email: 'email@ue.edu.ph'
                },
                {
                    department: 'Department 2',
                    name: 'Maria Clara',
                    email: 'email@ue.edu.ph'
                },
                {
                    department: 'Department 3',
                    name: 'Jose Rizal',
                    email: 'email@ue.edu.ph'
                }
            ]
        }
    },
    methods: {
        check() {
            console.log(this.cba_heads)
        }
    },
    mounted() {
        this.check();
    }
}
</script>
