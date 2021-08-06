<template>
    <div class="col-md-12">
        <div class="card mb-5 mt-2 border shadow">
            <div class="card-body">
                <h5 class="font-weight-bold">Admin Dashboard</h5>
                <span class="mt-2"> Welcome, <span class="font-weight-bold">{{ auth.name }}</span>! </span><br>
                <span>Today is <span class="font-weight-bold">{{ date_today }}</span></span><br><br>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['auth'],
    data() {
        return {
            date_today: '',
        }
    },
    computed: {
        getMonth() {
            this.date_today = moment().format('MMMM DD, YYYY')
        }
    },
    created() {
        this.getMonth;
    }
}
</script>
