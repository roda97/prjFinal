/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

//import store from './stores/global-store' 

import Vuetify from 'vuetify';

Vue.use(Vuetify)

import { Form, HasError, AlertError } from 'vform'
import tinymce from 'vue-tinymce-editor'
import { ToggleButton } from 'vue-js-toggle-button'
import Butter from 'buttercms';
import JsonCSV from 'vue-json-csv'
import * as VueGoogleMaps from 'vue2-google-maps'

Vue.use(VueGoogleMaps, {
    load: {
      key: 'YOUR_API_TOKEN',
      libraries: 'places', 
    },
})
 
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component('tinymce', tinymce)
Vue.component('ToggleButton', ToggleButton)
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('downloadCsv', JsonCSV)

window.Form = Form;

import VueClipboard from 'vue-clipboard2';
VueClipboard.config.autoSetContainer = true // add this line
Vue.use(VueClipboard);

import * as VeeValidate from 'vee-validate';
Vue.use(VeeValidate);

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import swal from 'sweetalert2'
window.Swal = swal;

import BootstrapVue from 'bootstrap-vue'
Vue.use(BootstrapVue);

import "chart.js";
import "hchs-vue-charts";
Vue.use(window.VueCharts);

// butter cms forum
const butter = Butter('0fac2fd390ce0c591a8a9ef13eefdb5e9dc8a777');

const toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
});

window.toast = toast;

window.Fire = new Vue();

import VueProgressBar from 'vue-progressbar'
Vue.use(VueProgressBar,{
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '3px',
})

//const dashboard = Vue.component('dashboard', require('./components/Dashboard.vue').default);
const home = Vue.component('home', require('./components/Home.vue').default);
const profile = Vue.component('profile', require('./components/Profile.vue').default);
const users = Vue.component('user', require('./components/Users.vue').default);
const projects = Vue.component('projects', require('./components/Projects.vue').default);
const news = Vue.component('news', require('./components/News.vue').default);
const newsadd = Vue.component('newsadd', require('./components/NewsAdd.vue').default);
const scientific = Vue.component('scientific', require('./components/Scientific.vue').default);
const partners = Vue.component('partners', require('./components/Partners.vue').default);
const awards = Vue.component('awards', require('./components/Awards.vue').default);
const teams = Vue.component('teams', require('./components/Teams.vue').default);
const labs = Vue.component('awards', require('./components/Labs.vue').default);
const patents = Vue.component('patents', require('./components/Patent.vue').default);
const roles = Vue.component('roles', require('./components/Roles.vue').default);
const missionEdit = Vue.component('missionEdit', require('./components/MissionEdit.vue').default);
const aboutEdit = Vue.component('aboutEdit', require('./components/AboutEdit.vue').default);

const associateResearchers = Vue.component('associateResearchers', require('./components/AssociateResearchersToProjects.vue').default);
const associatePartners = Vue.component('associatePartners', require('./components/AssociatePartnersToProjects.vue').default);

const cv_degrees = Vue.component('cv_degrees', require('./components/CienciaVitaeVue/CienciaVitae_Degrees.vue').default);
const cv_person_info = Vue.component('cv_person_info', require('./components/CienciaVitaeVue/CienciaVitae_Person_Info.vue').default);
const cv_mailingadresses = Vue.component('cv_mailingadresses', require('./components/CienciaVitaeVue/CienciaVitae_MailingAddresses.vue').default);
const cv_outputs = Vue.component('cv_outputs', require('./components/CienciaVitaeVue/CienciaVitae_Outputs.vue').default);
const cv_phones = Vue.component('cv_phones', require('./components/CienciaVitaeVue/CienciaVitae_Phones.vue').default);
const cv_web = Vue.component('cv_web', require('./components/CienciaVitaeVue/CienciaVitae_Web.vue').default);
const cv_privileges = Vue.component('cv_privileges', require('./components/CienciaVitaeVue/CienciaVitae_Privileges.vue').default);
const cv_language_competency = Vue.component('cv_language_competency', require('./components/CienciaVitaeVue/CienciaVitae_Language_Competency.vue').default);
const cv_author = Vue.component('cv_author', require('./components/CienciaVitaeVue/CienciaVitae_Author.vue').default);
const cv_citation = Vue.component('cv_citation', require('./components/CienciaVitaeVue/CienciaVitae_Citation.vue').default);
const cv_employment = Vue.component('cv_employments', require('./components/CienciaVitaeVue/CienciaVitae_Employment.vue').default);
const cv_groups = Vue.component('cv_groups', require('./components/CienciaVitaeVue/CienciaVitae_Groups.vue').default);

const routes = [
    //{path: '/dashboard', component: dashboard},
    {path: '/home', component: home},
    {path: '/cv_groups', component: cv_groups},
    {path: '/profile', component: profile},
    {path: '/users', component: users},
    {path: '/projects', component: projects},
    {path: '/news', component: news},
    {path: '/newsadd', component: newsadd},
    {path: '/scientific', component: scientific},
    {path: '/partners', component: partners},
    {path: '/awards', component: awards},
    {path: '/teams', component: teams},
    {path: '/labs', component: labs},
    {path: '/associateResearchers', component: associateResearchers},
    {path: '/associatePartners', component: associatePartners},
    {path: '/patents', component: patents},
    {path: '/roles', component: roles},
    {path: '/missionEdit', component: missionEdit},
    {path: '/aboutEdit', component: aboutEdit},

    /* CIENCIA VITAE */
    {path: '/cv_degrees', component: cv_degrees},
    {path: '/cv_person_info', component: cv_person_info},
    {path: '/cv_mailingadresses', component: cv_mailingadresses},
    {path: '/cv_outputs', component: cv_outputs},
    {path: '/cv_phones', component: cv_phones},
    {path: '/cv_web', component: cv_web},
    {path: '/cv_privileges', component: cv_privileges},
    {path: '/cv_language_competency', component: cv_language_competency},
    {path: '/cv_author', component: cv_author},
    {path: '/cv_citation', component: cv_citation},
    {path: '/cv_employment', component: cv_employment},
    {path: '/cv_groups', component: cv_groups},

];

const router = new VueRouter({
    linkActiveClass:'active',
    mode:'history',
    routes
  });


Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);

const app = new Vue({
    el: '#app',
    router,
    //store,
    vuetify: new Vuetify(),
    data:{
        search:'',
        aux:''
    },
    methods:{
        searchit: _.debounce(() => {
            Fire.$emit("searching");
        },500),
        
        searchPermission(){
            axios.get('api/searchPermission')
              .then(response => {
                this.aux = response.data;
                console.log("awdawd")
                console.log(this.aux)
                //this.$store.commit("setSearchPermission", response.data);
              });
        },
    },
    mounted(){
        this.searchPermission();
    }

});