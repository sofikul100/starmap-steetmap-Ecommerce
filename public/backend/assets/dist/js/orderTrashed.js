$(document).ready(function (){
 
    $("#date_filter_trashed").change(function () {
        orders_trashed_table.draw();
    });

    function reset(){
        $("#reset").click(function(){
            orders_trashed_table.ajax.reload();
        })
    }

    reset();


    $("body").on('click','#restore_order',function (){
       
        let id = $(this).data('id');

        $.ajax({
            method: "GET",
            url: "/order-restore",
            data: { id: id},
            success: function (response) {
                if (response.status == 200) {
                    orders_trashed_table.ajax.reload();
                    toastr.success(response.message);
                }
            },
            error(error) {
                console.log(error);
            },
        });


    });


    function checkall() {
        // Handle "Select All" checkbox
        $("#select_all").on("change", function () {
            var isChecked = $(this).prop("checked");
            $(".row-checkbox-trash").prop("checked", isChecked);
        });

        $("body").on("click", ".row-checkbox-trash", function () {});

        $("#order_trashed_table").on("change", ".row-checkbox-trash", function () {
            var allCheckboxes = $(".row-checkbox-trash");
            $(".row-checkbox-trash").each(function () {
                if ($(".row-checkbox-trash").is(":checked")) {
                    $("#select_all").prop("checked", true);
                }
            });
            $("#select_all").prop(
                "checked",
                allCheckboxes.length === allCheckboxes.filter(":checked").length
            );
        });
    }

    checkall();


    $("#bulk_form_trash").submit(function(e){
        e.preventDefault();
        let bulk_val = $("#bluk_action").val();
        let total_selected = [];

        $("#sub_checkbox:checked").each(function () {
            total_selected.push($(this).attr("data-id"));
        });

        if (total_selected.length === 0) {
            toastr.error("No item selected yet!");
        } else {
            swal({
                title: "Are you sure?",
                text: ` ${
                    bulk_val == "delete"
                        ? "You Want To Delete Item, If you do this then your data is parmanently delete."
                        : "You Want To Restore Selected Item"
                }  `,
                icon: `${bulk_val == 'delete' ? 'warning' : 'success'}`,
                buttons: ["No, cancel it!", "Yes, I am sure!"],
                dangerMode: true,
            }).then(function (isConfirm) {
                if (isConfirm) {
                    //=======ajax request here=====
                    $.ajax({
                        method: "GET",
                        url: "/bulk-status-change-for-trashed",
                        data: { ids: total_selected, bulk_val: bulk_val },
                        success: function (response) {
                            if (response.status == 200) {
                                orders_trashed_table.ajax.reload();
                                toastr.success(response.message);
                                $("#select_all").prop("checked", false);
                                total_selected.empty();
                                
                            }
                            if (response.status == 400) {
                                toastr.error(response.message);
                            }
                        },
                        error(error) {
                            console.log(error);
                        },
                    });
                } else {
                    swal("Cancelled", `${bulk_val == 'delete' ? 'Your Data is safe :)' : 'Data is still in Trashed'}`, `${bulk_val == 'delete' ? 'error' : 'success'}`);
                }
            });
        }
    });


    $("body").on('click','#parmanent_delete',function (){
        let id = $(this).data('id');

        swal({
            title: "Are you sure?",
            text: `You want to delete data, If you do this your data will be parmanently Delete`,
            icon: `warning`,
            buttons: ["No, cancel it!", "Yes, I am sure!"],
            dangerMode: true,
        }).then(function (isConfirm) {
            if (isConfirm) {
                //=======ajax request here=====
                $.ajax({
                    method: "GET",
                    url: "/order-parmanent-delete",
                    data: { id: id},
                    success: function (response) {
                        if (response.status == 200) {
                            orders_trashed_table.ajax.reload();
                            toastr.success(response.message);     
                        }
                    },
                    error(error) {
                        console.log(error);
                    },
                });
            } else {
                swal("Cancelled", `Your Data is safe :) `,"error");
            }
        });
    });








});