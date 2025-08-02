
$(function (e) {
    var Visit       = $("#TABLE_HEADER_Visit").val();
    var Record      = $("#TABLE_HEADER_Record").val();
    var Copy        = $("#TABLE_HEADER_Duplicate").val();
    var Excel       = $("#TABLE_HEADER_Exel").val();
    var PDF         = $("#TABLE_HEADER_PDF").val();
    var VisitColumn = $("#TABLE_HEADER_VisitColumn").val();
    var Search      = $("#TABLE_HEADER_Search").val();
    var TO          = $("#TABLE_FOOTER_TO").val();
    var From        = $("#TABLE_FOOTER_FROM").val();
    var Pre         = $("#TABLE_FOOTER_PRE").val();
    var Next        = $("#TABLE_FOOTER_Next").val();
    var NotFound    = $("#TABLE_FOOTER_NOTFOUND").val();
    var FilterAs    = $("#TABLE_FOOTER_FilteredFrom").val();

    "use strict";
    $.extend(true, $.fn.dataTable.defaults, {
        language: {
            "sEmptyTable": NotFound,
            //"sInfo": "نمایش _START_ تا _END_ از _TOTAL_ رکورد",
            "sInfo": Visit + " _START_ " + TO + " _END_ " + From + " _TOTAL_ " + Record,
            "sInfoEmpty": Visit + " 0 " + TO + " 0 " + From + " 0 " + Record ,
            "sInfoFiltered": "(" + FilterAs + " _MAX_ " + Record + ")",
            "sInfoPostFix": "",
            "sInfoThousands": ",",
            "sLengthMenu": Visit + "_MENU_" + Record ,
            "sLoadingRecords": "در حال بارگزاری...",
            "sProcessing": "در حال پردازش...",
            "sSearch": Search,
            "sZeroRecords": NotFound,
            "oPaginate": {
                "sFirst": "ابتدا",
                "sLast": "انتها",
                "sNext": Next,
                "sPrevious": Pre,
            },

            "oAria": {
                "sSortAscending": ": فعال سازی نمایش به صورت صعودی",
                "sSortDescending": ": فعال سازی نمایش به صورت نزولی"
            }
        }
    });
    //______Basic Data Table
    $('#basic-datatable').DataTable({
        language: {
            searchPlaceholder: 'جستجو ....',
            sSearch: '',
        }
    });


    //______Basic Data Table
    $('#responsive-datatable').DataTable({
        language: {
            searchPlaceholder: Search,
            scrollX: "100%",
            sSearch: '',
        }
    });

    //______File-Export Data Table
    var table = $('#file-datatable').DataTable({
        buttons: [
            {extend: 'copy', text: Copy},
            {extend: 'excel', text: Excel},
            //{extend: 'pdf', text: PDF},
            {extend: 'colvis', text: VisitColumn},
        ],
        language: {
            searchPlaceholder: Search,
            scrollX: "100%",
            sSearch: '',
        }
    });
    table.buttons().container()
        .appendTo('#file-datatable_wrapper .col-md-6:eq(0)');

    //______Delete Data Table
    var table = $('#delete-datatable').DataTable({
        language: {
            searchPlaceholder: Search,
            sSearch: '',
        }
    });
    $('#delete-datatable tbody').on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });
    $('#button').on('click', function () {
        table.row('.selected').remove().draw(false);
    });
    $('#example3').DataTable({
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal({
                    header: function (row) {
                        var data = row.data();
                        return 'جزئیات برای  ' + data[0] + ' ' + data[1];
                    }
                }),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    tableClass: 'table'
                })
            }
        }
    });
    $('#example2').DataTable({
        responsive: true,
        language: {
            searchPlaceholder: Search,
            sSearch: '',
            lengthMenu: '_MENU_ آیتم / صفحه',
        }
    });


    //______Select2 
    $('.select2').select2({
        minimumResultsForSearch: Infinity
    });

});