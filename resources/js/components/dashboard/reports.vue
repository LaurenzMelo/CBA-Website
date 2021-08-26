<template>
    <div class="col-md-12">
        <div class="card mb-5 mt-2 border shadow">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex justify-content-center">
                        <h4 class="font-weight-bold"> Reports </h4>
                        <select class="form-control mr-2 ml-2" v-model="report_option">
                            <option value="" selected disabled> Pick One </option>
                            <option value="All"> All Reports </option>
                            <option value="Transparency"> Transparency Reports </option>
                            <option value="Progress"> Progress Reports </option>
                        </select>
                    </div>
                    <div>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#addReportModal"> Create New Report </button>
                    </div>
                </div>
                <div class="table-report mt-4">
                    <table class="table">
                        <thead>
                        <tr class="text-center">
                            <th scope="col"> Title </th>
                            <th scope="col"> Description </th>
                            <th scope="col"> Event Date </th>
                            <th scope="col"> Type </th>
                            <th scope="col"> Action </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(report, index) in present_reports" :key="index">
                            <td class="w-20"> {{ report.title }} </td>
                            <td class="w-30"> {{ report.description }} </td>
                            <td class="w-20 text-center"> {{ formatDate(report.event_date) }} </td>
                            <td class="w-15 text-center"> {{ report.type }} </td>
                            <td class="w-15 text-center">
                                <button type="button" class="btn btn-success"><i class="far fa-edit"></i></button>
                                <button type="button" class="btn btn-danger" @click="deleteReport(report)"><i class="fas fa-times"></i></button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Add Report Modal -->
        <div class="modal fade" id="addReportModal" tabindex="-1" role="dialog" aria-labelledby="addReportModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Add New Report </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="saveReport">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="font-weight-bold"> Title </label>
                                <input type="text" v-model="form.title" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold"> Description </label>
                                <input type="text" v-model="form.description" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold"> Event Date </label>
                                <v-date-picker
                                    v-model="form.event_date"
                                    :masks="masks"
                                    color="blue"
                                    is-dark
                                    class="mt-1"
                                >
                                    <template v-slot="{ inputValue, inputEvents }">
                                        <div class="form-group">
                                            <input
                                                :value="inputValue"
                                                v-on="inputEvents"
                                                class="border p-2 rounded focus:outline-none focus:border-indigo-300 form-control"
                                                required
                                            />
                                        </div>
                                    </template>
                                </v-date-picker>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold"> Type </label>
                                <select class="form-control" v-model="form.type"  required>
                                    <option value="Progress"> Progress Report </option>
                                    <option value="Transparency"> Transparency Report </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold"> File </label>
                                <input type="file" class="form-control" name="report_file" id="report_file_id" accept=".pdf" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
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
            progress_reports: [],
            transparency_reports: [],
            all_reports: [],
            present_reports: [],
            report_option: '',
            form: {
                title: '',
                description: '',
                event_date: '',
                type: '',
            },
            masks: {
                input: 'MMM DD YYYY',
            },
        }
    },
    watch: {
      report_option() {
          if (this.report_option === 'Transparency') {
              this.present_reports = this.transparency_reports
          } else if (this.report_option === 'Progress') {
              this.present_reports = this.progress_reports
          } else {
              this.present_reports = this.all_reports
          }
        }
    },
    mounted() {
        this.getReports();
    },
    methods: {
        deleteReport(report) {
            Swal.fire({
                title: 'Delete Report?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post('api/reports/delete', {
                        id: report.id
                    }).then(reponse => {
                        Swal.fire(
                            'Success!',
                            'Report is deleted.',
                            'success'
                        )
                        this.getReports();
                    })
                }
            });
        },
        saveReport() {
            Swal.fire({
                title: 'Save Report?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    let formData = new FormData()
                    var file = document.querySelector('#report_file_id');

                    formData.append('report_file', file.files[0]);
                    formData.append('title', this.form.title);
                    formData.append('description', this.form.description)
                    formData.append('event_date', moment(this.form.event_date).format('YYYY-MM-DD 00:00:00'))
                    formData.append('type', this.form.type)

                    axios.post('api/reports/store', formData)
                    .then(response => {
                        if(response.data['message'] === 'Report is saved.') {
                            this.form.title = '';
                            this.form.description = '';
                            this.form.event_date = '';
                            this.form.type = '';

                            Swal.fire(
                                'Success!',
                                'Report is saved.',
                                'success'
                            )
                            $('#addReportModal').modal('hide')
                            this.getReports()
                        } else {
                            Swal.fire(
                                'Failed!',
                                'Report is not saved.',
                                'error'
                            )
                        }
                    });
                }
            });
        },
        getReports() {
            axios.get('api/reports/getReports')
            .then(response => {
                const reports = response.data
                this.all_reports = reports
                this.transparency_reports = reports.filter(report => report.type == 'Transparency')
                this.progress_reports = reports.filter(report => report.type == 'Progress')
            })
        },
        formatDate(date){
            return moment(date).format('MMM. DD, YYYY')
        }
    },
}
</script>
