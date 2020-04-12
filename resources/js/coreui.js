/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import 'perfect-scrollbar';
import '@coreui/coreui/dist/js/coreui';

import 'jquery-confirm';

// Vue.component('slugify', require('./components/HotashSLUG.vue').default);

import 'sumoselect';

// var $ = jQuery;
// require( 'jszip' );
import 'datatables.net';
import 'datatables.net-bs4';
// import 'datatables.net-editor-bs4';
import 'datatables.net-buttons-bs4';
import 'datatables.net-buttons/js/buttons.colVis.js';
import 'datatables.net-buttons/js/buttons.flash.js';
import 'datatables.net-buttons/js/buttons.html5.js';
import 'datatables.net-buttons/js/buttons.print.js';
// import 'datatables.net-responsive-bs4';
import 'datatables.net-select-bs4';

$(document).ready(function(){
    $('select[selector]').SumoSelect({
        search: true,
    });
    
    $('.delete-action').click(function(e) {
        e.preventDefault();
        var $this = $(this);
        $.confirm({
            icon: 'fa fa-warning',
            title: 'Are You Sure To Delete?',
            content: 'Something is going to be deleted.',
            type: 'red',
            typeAnimated: true,
            buttons: {
                tryAgain: {
                    text: 'Delete',
                    btnClass: 'btn-red',
                    action: function() {
                        $this.parents('form').submit();
                    }
                },
                close: function() {}
            }
        });
    });
    $('.remove-action').click(function(e) {
        e.preventDefault();
        var $this = $(this);
        $.confirm({
            icon: 'fa fa-warning',
            title: $this.data('title') || 'Are You Sure To Remove?',
            content: $this.data('content') || 'Something is going to be removed.',
            type: 'red',
            typeAnimated: true,
            buttons: {
                tryAgain: {
                    text: 'Remove',
                    btnClass: 'btn-red',
                    action: function() {
                        $this.parents($this.data('target')).fadeOut(350, function(){
                            $(this).remove();
                        });
                    }
                },
                close: function() {}
            }
        });
    });

});