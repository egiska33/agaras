global.$ = global.jQuery = require('jquery');
global.jsPDF = require('jspdf');

require('pdfjs-dist');

require('./bootstrap');

global.html2canvas = require('./libs/html2canvas.js');

require('./components/swController.js');
require('./components/offlineDB.js');
require('./components/helpers.js');
require('./components/indexedDBSync.js');

import mixins from "./components/mixins";

global.mixins = mixins;

window.Vue = require('vue');

Vue.config.productionTip = false;
Vue.config.devtools = false;

Vue.component('routes-index', require('./components/offline/routes/index.vue'));

Vue.component('sellers-index', require('./components/offline/sellers/index.vue'));
Vue.component('sellers-create', require('./components/offline/sellers/create.vue'));
Vue.component('sellers-edit', require('./components/offline/sellers/edit.vue'));

Vue.component('animals-index', require('./components/offline/animals/index.vue'));
Vue.component('animals-create', require('./components/offline/animals/create.vue'));
Vue.component('animals-create-by-id', require('./components/offline/animals/createById.vue'));
Vue.component('animals-insert-id', require('./components/offline/animals/insertId.vue'));
Vue.component('animals-edit', require('./components/offline/animals/edit.vue'));

Vue.component('documents-index', require('./components/offline/documents/index.vue'));

Vue.component('documents-kv-show', require('./components/offline/documents/kv/show.vue'));
Vue.component('documents-kv-edit', require('./components/offline/documents/kv/edit.vue'));

Vue.component('documents-pi-show', require('./components/offline/documents/pi/show.vue'));
Vue.component('documents-pi-edit', require('./components/offline/documents/pi/edit.vue'));

Vue.component('documents-pp-show', require('./components/offline/documents/pp/show.vue'));
Vue.component('documents-pp-edit', require('./components/offline/documents/pp/edit.vue'));

Vue.component('documents-sf-show', require('./components/offline/documents/sf/show.vue'));
Vue.component('documents-sf-vat-show', require('./components/offline/documents/sf/show-vat.vue'));
Vue.component('documents-sf-edit', require('./components/offline/documents/sf/edit.vue'));

Vue.component('documents-vg-show', require('./components/offline/documents/vg/show.vue'));
Vue.component('documents-vg-edit', require('./components/offline/documents/vg/edit.vue'));

Vue.component('documents-application', require('./components/offline/documents/application.vue'));
Vue.component('documents-print', require('./components/offline/documents/print.vue'));

Vue.component('documents-explanation', require('./components/offline/static/docsExplain.vue'));
Vue.component('documents-faq', require('./components/offline/static/faq.vue'));
Vue.component('documents-how-to', require('./components/offline/static/howTo.vue'));

const app = new Vue({
    el: '#main-content'
});

$(document).ready(() => {
    $('.navbar-collapse').on('show.bs.collapse', function() {
        $('.fa-bars').addClass('glyphicon glyphicon-remove').removeClass('fa fa-bars');
    });

    $('.navbar-collapse').on('hide.bs.collapse', function() {
        $('.glyphicon-remove').addClass('fa fa-bars').removeClass('glyphicon-remove');
    });

    $(document).on('click', (event) => {
        var clickedElem = $(event.target);

        if(clickedElem.parents('.navbar').length == 0)
        {
            $('.navbar-collapse').collapse('hide');
        }
    });
});
