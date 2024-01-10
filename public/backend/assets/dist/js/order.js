$(document).ready(function () {

    function checkall() {
        // Handle "Select All" checkbox
        $("#select_all").on("change", function () {
            var isChecked = $(this).prop("checked");
            $(".row-checkbox").prop("checked", isChecked);
        });

        $("body").on("click", "#sub_checkbox", function () {});

        $("#all_order").on("change", ".row-checkbox", function () {
            var allCheckboxes = $(".row-checkbox");
            $(".row-checkbox").each(function () {
                if ($(".row-checkbox").is(":checked")) {
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

    $("#status_filter").change(function () {
        all_orders_table.draw();
    });


    $("#date_filter").change(function () {
        all_orders_table.draw();
    });




    $("#payment_type").change(function () {
        all_orders_table.draw();
    });


    $("#bulk_form").submit(function (e) {
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
                    bulk_val == "trash"
                        ? "You Want To Trash Item"
                        : "You Want To Change Order Status"
                }  `,
                icon: "warning",
                buttons: ["No, cancel it!", "Yes, I am sure!"],
                dangerMode: true,
            }).then(function (isConfirm) {
                if (isConfirm) {
                    //=======ajax request here=====
                    $.ajax({
                        method: "GET",
                        url: "/bulk-status-change",
                        data: { ids: total_selected, bulk_val: bulk_val },
                        success: function (response) {
                            if (response.status == 200) {
                                all_orders_table.ajax.reload();
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
                    swal("Cancelled", "Your Data is safe :)", "error");
                }
            });
        }
    });


    function reset(){
        $("#reset").click(function(){
            all_orders_table.ajax.reload();
        })
    }

    reset();


    $("body").on('click',"#order_trash",function (){

        let id = $(this).data('id');
        swal({
            title: "Are you sure?",
            text: `You want to Trash data, If you do this your data you will recover it`,
            icon: `warning`,
            buttons: ["No, cancel it!", "Yes, I am sure!"],
            dangerMode: true,
        }).then(function (isConfirm) {
            if (isConfirm) {
                //=======ajax request here=====
                $.ajax({
                    method: "GET",
                    url: "/order-trash",
                    data: { id: id},
                    success: function (response) {
                        if (response.status == 200) {
                            all_orders_table.ajax().reload();
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



  










    //========reset of the code ===========//
});
