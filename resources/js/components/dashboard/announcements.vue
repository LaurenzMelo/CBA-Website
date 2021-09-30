<template>
    <div class="col-md-12">
        <div class="card mb-5 mt-2 border shadow">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="font-weight-bold"> Announcements </h4>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addAnnouncementModal" @click="clearForm"> Create New Announcement </button>
                </div>
                <div class="mt-4">
                    <table class="table">
                        <thead>
                        <tr class="text-center">
                            <th scope="col"> Title </th>
                            <th scope="col"> Description </th>
                            <th scope="col"> Date </th>
                            <th scope="col"> Action </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="a in announcements" :key="a.id">
                            <td class="w-20"> {{ a.title }} </td>
                            <td class="w-50"> {{ a.description }} </td>
                            <td class="w-15 text-center"> {{ formatDate(a.announcement_date) }} </td>
                            <td class="w-15 text-center">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editAnnModal" @click="getAnn(a)"><i class="far fa-edit"></i></button>
                                <button type="button" class="btn btn-danger" @click="deleteAnnouncement(a)"><i class="fas fa-times"></i></button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Add Announcement Modal -->
        <div class="modal fade" id="addAnnouncementModal" tabindex="-1" role="dialog" aria-labelledby="addAnnouncementModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Add New Announcement </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="saveAnnouncement">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="font-weight-bold"> Title </label>
                                <input type="text" v-model="form.title" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold"> Description </label>
                                <textarea class="form-control" v-model="form.description" rows="4" required></textarea>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold"> Announcement Date </label>
                                <v-date-picker
                                    v-model="form.announcement_date"
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
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Announcement Modal -->
        <div class="modal fade" id="editAnnModal" tabindex="-1" role="dialog" aria-labelledby="editAnnModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editAnnModalLabel"> Edit - <span class="font-weight-bold">{{ specific_ann.title }}</span> </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="editForm" @submit.prevent="editAnn">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="font-weight-bold"> Title </label>
                                <input type="text" v-model="form.title" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold"> Description </label>
                                <textarea class="form-control" v-model="form.description" rows="4" required></textarea>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold"> Announcement Date </label>
                                <v-date-picker
                                    v-model="form.announcement_date"
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
            announcements: [],
            form: {
                title: '',
                description: '',
                announcement_date: '',
            },
            specific_ann: [],
            masks: {
                input: 'MMM DD YYYY',
            },
        }
    },
    mounted() {
        this.getAnnouncement();
    },
    methods: {
        editAnn() {
            Swal.fire({
                title: 'Edit Announcement?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post('api/announcements/editAnn', {
                        id: this.form.id,
                        title: this.form.title,
                        description: this.form.description,
                        announcement_date: moment(this.form.announcement_date).format('YYYY-MM-DD 00:00:00')
                    }).then(response => {
                        this.form.title = '';
                        this.form.description = '';
                        this.form.announcement_date = '';

                        Swal.fire(
                            'Success!',
                            'Announcement is edited.',
                            'success'
                        )
                        $('#editAnnModal').modal('hide')
                        this.getAnnouncement()
                    })

                }
            });
        },
        getAnn(ann) {
            this.specific_ann = ann;
            this.form.id = ann.id;
            this.form.title = ann.title;
            this.form.description = ann.description;
            this.form.announcement_date = ann.announcement_date;
        },
        clearForm() {
            this.form.id = '';
            this.form.title = '';
            this.form.description = '';
            this.form.announcement_date = '';
        },
        deleteAnnouncement(a) {
            Swal.fire({
                title: 'Delete Announcement?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post('api/announcements/delete', {
                        id: a.id
                    }).then(response => {
                        Swal.fire(
                            'Success!',
                            'Announcement is deleted.',
                            'success'
                        )
                        this.getAnnouncement()
                    })
                }
            });
        },
        saveAnnouncement() {
            Swal.fire({
                title: 'Save Announcement?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post('api/announcements/store', {
                        title: this.form.title,
                        description: this.form.description,
                        announcement_date: moment(this.form.announcement_date).format('YYYY-MM-DD 00:00:00')
                    }).then(response => {
                        this.form.title = '';
                        this.form.description = '';
                        this.form.announcement_date = '';

                        Swal.fire(
                            'Success!',
                            'Announcement is saved.',
                            'success'
                        )
                        $('#addAnnouncementModal').modal('hide')
                        this.getAnnouncement()
                    })

                }
            });
        },
        getAnnouncement() {
            axios.get('api/announcements/getAnnouncement')
                .then(response => {
                    this.announcements = response.data
                })
        },
        formatDate(date){
            return moment(date).format('MMM. DD, YYYY')
        }
    },
}
</script>
