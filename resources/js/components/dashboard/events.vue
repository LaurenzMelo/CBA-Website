<template>
    <div class="col-md-12">
        <div class="card mb-5 mt-2 border shadow">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="font-weight-bold"> Events </h4>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addEventsModal"> Create New Event </button>
                </div>
                <div class="table-report mt-4">
                    <table class="table">
                        <thead>
                        <tr class="text-center">
                            <th scope="col"> Event's Title </th>
                            <th scope="col"> Summary </th>
                            <th scope="col"> Date </th>
                            <th scope="col"> Type </th>
                            <th scope="col"> Action </th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for="event in all_events" :key="event.id">
                                <td class="w-15 text-center"> {{ event.name }} </td>
                                <td class="w-30"> {{ event.summary }} </td>
                                <td class="w-10 text-center"> {{ formatDate(event.event_date) }} </td>
                                <td class="w-10 text-center">{{ event.type }}</td>
                                <td class="w-15 text-center">
                                    <button type="button" class="btn btn-success" @click="viewEvent(event)" data-toggle="modal" data-target="#viewEventModal"><i class="far fa-eye"></i></button>
                                    <button type="button" class="btn btn-danger" @click="deleteEvent(event)"><i class="fas fa-times"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Add Event Modal -->
        <div class="modal fade" id="addEventsModal" tabindex="-1" role="dialog" aria-labelledby="addEventsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addEventsModalLabel"> Add New Event </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="addForm" @submit.prevent="saveEvent">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold"> Event Name </label>
                                        <input type="text" v-model="form.name" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold"> Summary </label>
                                        <input type="text" v-model="form.summary" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold"> Target Audience </label>
                                        <input type="text" v-model="form.audience" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold"> Event Date </label>
                                        <v-date-picker
                                            v-model="form.date"
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
                                        <label class="font-weight-bold"> Pubmats Image </label>
                                        <input type="file" class="form-control" name="events_file" id="events_file_id" accept=".jpeg, .jpg, .png" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold"> Event type </label>
                                        <input type="text" v-model="form.type" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="font-weight-bold"> Full Details </label>
                                <div v-for="(con, counter) in content" :key="counter" class="mb-4">
                                    <div class="d-flex justify-content-between mb-2">
                                        <label style="text-indent: 10px"> Paragraph {{counter+1}} </label>
                                        <button 
                                            type="btn" 
                                            class="btn btn-sm btn-danger" 
                                            @click="deleteParagraph(counter)"
                                            v-if="counter != 0"
                                        >
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>                                
                                    <textarea class="form-control" v-model="con.paragraph" required></textarea>
                                </div>
                                <div class="text-center"> 
                                    <button type="btn" class="btn btn-success mt-2" @click="addParagraph"> Add Another Paragraph </button>
                                </div>
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

        <!-- View Event Modal -->
        <div class="modal fade" id="viewEventModal" tabindex="-1" role="dialog" aria-labelledby="viewEventModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewEventModalLabel"><span class="font-weight-bold">{{ view_event.name }}</span> </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body pl-5 pr-5">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold"> Event Name </label>
                                    <p class="text-indent"> {{ view_event.name }} </p> 
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold"> Event Date </label>
                                    <p class="text-indent"> {{ formatDate(view_event.event_date) }} </p> 
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold"> Type </label>
                                    <p class="text-indent"> {{ view_event.type }} </p> 
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold"> Audience </label>
                                    <p class="text-indent"> {{ view_event.target_audience }} </p> 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold"> Event Summary: </label>
                                    <p class="text-indent text-justify"> {{ view_event.summary }} </p> 
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold"> Full Details: </label>
                                    <p class="text-justify text-indent mt-4 mb-2" v-for="(con, index) in view_content" :key="index">
                                        {{ con.paragraph }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div>
                            <h5 class="font-weight-bold text-center mt-4 mb-3"> Uploaded Pubmat Image </h5>
                            <img :src="view_event.pubmat_img" height="100%" width="100%">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="closeViewModal()" data-toggle="modal" data-target="#editEventModal">Edit</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Event Modal -->
        <div class="modal fade" id="editEventModal" tabindex="-1" role="dialog" aria-labelledby="editEventModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editEventModalLabel"> Edit - <span class="font-weight-bold">{{ view_event.name }}</span> </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editEvent">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold"> Event Name </label>
                                        <input type="text" v-model="form.name" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold"> Summary </label>
                                        <input type="text" v-model="form.summary" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold"> Target Audience </label>
                                        <input type="text" v-model="form.audience" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold"> Event Date </label>
                                        <v-date-picker
                                            v-model="form.date"
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
                                        <label class="font-weight-bold"> Event type </label>
                                        <input type="text" v-model="form.type" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="font-weight-bold"> Content </label>
                                <div v-for="(con, counter) in content" :key="counter" class="mb-4">
                                    <div class="d-flex justify-content-between mb-2">
                                        <label style="text-indent: 10px"> Paragraph {{counter+1}} </label>
                                        <button 
                                            type="btn" 
                                            class="btn btn-sm btn-danger" 
                                            @click="deleteParagraph(counter)"
                                            v-if="counter != 0"
                                        >
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>                                
                                    <textarea class="form-control" v-model="con.paragraph" rows="4" required></textarea>
                                </div>
                                <div class="text-center"> 
                                    <button type="btn" class="btn btn-success mt-2" @click="addParagraph"> Add Another Paragraph </button>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="closeEditModal()" data-dismiss="modal">Close</button>
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
            all_events: [],
            view_event: [],
            form: {
                name: '',
                summary: '',
                audience: '',
                date: '',
                type: '',
            },
            view_content:  [{
                paragraph: '',
            }],
            content: [{
                paragraph: '',
            }],
            masks: {
                input: 'MMM DD YYYY',
            },
        }
    },
    mounted() {
        this.getEvents();
    },
    methods: {
        closeEditModal() {
            this.form.name = '';
            this.form.summary = '';
            this.form.audience = '';
            this.form.date = '';
            this.form.type = '';
            this.content = [
                { paragraph: '' }
            ];
        },
        closeViewModal() {
            $('#viewEventModal').modal('hide')
            this.form.name = this.view_event.name;
            this.form.summary = this.view_event.summary;
            this.form.audience = this.view_event.target_audience;
            this.form.date = this.view_event.event_date;
            this.form.type = this.view_event.type;
            this.content = JSON.parse(this.view_event.full_details);
        },
        editEvent(event) {
            Swal.fire({
                title: 'Edit Event?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post('api/events/editEvent', {
                        id: this.view_event.id,
                        name: this.form.name,
                        summary: this.form.summary,
                        event_date: moment(this.form.date).format('YYYY-MM-DD'),
                        full_details: JSON.stringify(this.content),
                        target_audience: this.form.audience,
                        type: this.form.type
                    }).then(response => {
                        this.closeEditModal();
                        this.getEvents();

                        Swal.fire(
                            'Success!',
                            'Event is edited.',
                            'success'
                        )
                        $('#editEventModal').modal('hide')
                    })
                }
            });
        },
        viewEvent(event) {
            this.view_event = event;
            this.view_content = JSON.parse(event.full_details)
        },
        deleteEvent(event) {
            Swal.fire({
                title: 'Delete Event?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post('api/events/delete', {
                        id: event.id
                    }).then(response => {
                        Swal.fire(
                            'Success!',
                            'Event is deleted.',
                            'success'
                        )
                        this.getEvents();
                    })
                }
            });
        },
        saveEvent() {
            Swal.fire({
                title: 'Save Event?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    let formData = new FormData()
                    var file = document.querySelector('#events_file_id');

                    formData.append('events_file', file.files[0]);
                    formData.append('name', this.form.name);
                    formData.append('summary', this.form.summary);
                    formData.append('event_date', moment(this.form.date).format('YYYY-MM-DD'));
                    formData.append('full_details', JSON.stringify(this.content));
                    formData.append('target_audience', this.form.audience);
                    formData.append('type', this.form.type);

                    axios.post('api/events/store', formData)
                    .then(response => {
                        if(response.data['message'] === 'Event is saved.') {
                            this.form.summary = '';
                            this.form.name = '';
                            this.form.date = '';
                            this.form.type = '';
                            this.form.audience = '';
                            this.content = [
                                { paragraph: '' }
                            ];
                            document.getElementById("addForm").reset();
                            this.getEvents();

                            Swal.fire(
                                'Success!',
                                'Event is saved.',
                                'success'
                            )
                            $('#addEventsModal').modal('hide')
                        } else {
                            Swal.fire(
                                'Failed!',
                                'Event is not saved.',
                                'error'
                            )
                        }
                    });
                }
            });
        },
        getEvents() {
            axios.get('api/events/getEvents')
            .then(response => {
                this.all_events = response.data
            })
        },
        addParagraph() {
            this.content.push({
                paragraph: '',
            })
        },
        deleteParagraph(counter) {
            this.content.splice(counter, 1);
        },
        formatDate(date){
            return moment(date).format('MMM. DD, YYYY')
        }
    },
}
</script>
