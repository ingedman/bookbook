
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
require('./toasted')
import VModal from 'vue-js-modal'

Vue.use(VModal);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));



// Card controls
Vue.component('review-card-controls', require('./components/ReviewCardControls.vue').default);
Vue.component('book-card-controls', require('./components/BookCardControls').default);
Vue.component('user-card-controls', require('./components/UserCardControls').default);
Vue.component('author-card-controls', require('./components/AuthorCardControls').default);

// Settings options
Vue.component('text-option', require('./components/settings/TextOption.vue').default);
Vue.component('textarea-option', require('./components/settings/TextAreaOption.vue').default);
Vue.component('select-option', require('./components/settings/SelectOption.vue').default);
Vue.component('upload-button', require('./components/upload/UploadButton.vue').default);
Vue.component('upload-modal', require('./components/upload/UploadModal.vue').default);

// Notifications components
Vue.component('notifications-drop-down', require('./components/NotificationsDropDown.vue').default);
Vue.component('notifications-item', require('./components/NotificationsItem.vue').default);

// Comment section
Vue.component('comments-section', require('./components/comments/CommentsSection.vue').default);

// Review editor
Vue.component('the-editor', require('./components/TheEditor.vue').default);

// Buttons
Vue.component('follow-button', require('./components/buttons/FollowButton.vue').default);
Vue.component('share-buttons', require('./components/buttons/ShareButtons.vue').default);
Vue.component('delete-user-button', require('./components/buttons/DeleteUserButton.vue').default);

// Toolbar search form
Vue.component('search-input', require('./components/SearchInput.vue').default);

// Report modal
Vue.component('report-model', require('./components/ReportModal.vue').default);

// User widget
Vue.component('user-profile-widget', require('./components/UserProfileWidget.vue').default);
Vue.component('profile-picture', require('./components/partials/ProfilePicture.vue').default);





//
// /*
//  create error and warning handlers
//  */
// Vue.config.errorHandler = function(err, vm, info) {
//     console.error(`Error: ${err.toString()}\nInfo: ${info}`);
// }
//
// Vue.config.warnHandler = function(msg, vm, trace) {
//     console.warn(`Warn1: ${msg}\nTrace: ${trace}`);
// }




/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const app = new Vue({
    el: '#app'
});



