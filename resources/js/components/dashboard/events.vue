<template>
    <div class="col-md-12">
        <div class="card mb-5 mt-2 border shadow">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="font-weight-bold"> Events </h4>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addEventModal" @click="clearForm"> Create New Event </button>
                </div>
                <div class="table-report mt-4">
                    <table class="table">
                        <thead>
                        <tr class="text-center">
                            <th scope="col"> Event's Title </th>
                            <th scope="col"> Summary </th>
                            <th scope="col"> Date </th>
                            <th scope="col"> Action </th>
                        </tr>
                        </thead>
                        <tbody>
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['auth'],
    data() {
        return {

        }
    },
    computed: {

    },
    created() {

    }
}
</script>
