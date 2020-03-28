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

    $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, { className: 'btn btn-sm' });
    $.extend(true, $.fn.dataTable.defaults, {
        language: {
            paginate: {
                previous: '<i class="fa fa-angle-left"></i>',
                first: '<i class="fa fa-angle-double-left"></i>',
                last: '<i class="fa fa-angle-double-right"></i>',
                next: '<i class="fa fa-angle-right"></i>',
            },
        },
        columnDefs: [
            {
                orderable: false,
                className: 'select-checkbox',
                searchable: false,
                targets: 0,
            },
            {
                orderable: false,
                searchable: false,
                targets: -1
            },
        ],
        select: {
            style:    'multi+shift',
            selector: 'td:first-child'
        },
        order: [],
        scrollX: true,
        pagingType: 'numbers',
        pageLength: 25,
        dom: 'lBfrtip<"actions">',
        buttons: [
            {
                extend: 'selectAll',
                className: 'btn-primary',
                text: 'Select All',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'selectNone',
                className: 'btn-primary',
                text: 'Deselect All',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'copy',
                className: 'btn-light',
                text: 'Copy',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'csv',
                className: 'btn-light',
                text: 'CSV',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'excel',
                className: 'btn-light',
                text: 'Excel',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'print',
                className: 'btn-light',
                text: 'Print',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'colvis',
                className: 'btn-light',
                text: 'Columns',
                exportOptions: {
                    columns: ':visible'
                }
            },
        ],
    });

});