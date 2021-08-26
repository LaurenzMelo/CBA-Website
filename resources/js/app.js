require('./bootstrap');

import moment from 'moment'
import VCalendar from 'v-calendar';
import Swal from 'sweetalert2'
import Vue from 'vue';

window.moment = moment
window.Vue = require('vue').default;
window.Swal = Swal;
Vue.use(VCalendar)

//website
Vue.component('index', require('./components/website/index.vue').default);
Vue.component('processes', require('./components/website/processes.vue').default);
Vue.component('forms', require('./components/website/forms.vue').default);
Vue.component('website-events', require('./components/website/events.vue').default);
Vue.component('blog', require('./components/website/blog.vue').default);
Vue.component('know_us', require('./components/website/know_us.vue').default);
Vue.component('directories', require('./components/website/directories.vue').default);
Vue.component('ind_blog', require('./components/website/ind_blog.vue').default);
Vue.component('all_announcement', require('./components/website/all_announcement.vue').default);
Vue.component('transparency_report', require('./components/website/transparency_report.vue').default);
Vue.component('progress_report', require('./components/website/progress_report.vue').default);

//dashboard
Vue.component('dashboard-index', require('./components/dashboard/index.vue').default);
Vue.component('dashboard-blogs', require('./components/dashboard/blogs.vue').default);
Vue.component('dashboard-events', require('./components/dashboard/events.vue').default);
Vue.component('dashboard-processes', require('./components/dashboard/processes.vue').default);
Vue.component('dashboard-reports', require('./components/dashboard/reports.vue').default);
Vue.component('dashboard-announcements', require('./components/dashboard/announcements.vue').default);
Vue.component('dashboard-newsletter', require('./components/dashboard/newsletter.vue').default);

const app = new Vue({
    el: '#app',
});
