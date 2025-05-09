$(document).ready(function () {
    // cek admin password
    $("#current_pwd").keyup(function () {
        var current_pwd = $("#current_pwd").val();
        // alert(current_pwd);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/check-current-password',
            data: { current_pwd: current_pwd },
            success: function (resp) {
                if (resp == "false") {
                    $("#verifyCurrentPwd").html("Current Password is Incorrect!");
                } else if (resp == "true") {
                    $("#verifyCurrentPwd").html("Current Password is Correct!");
                }
            }, error: function () {
                alert("Error");
            }
        })

    });

    //update cms status
    $(document).on("click", ".updateCmsPageStatus", function () {
        var status = $(this).find("i").attr("status");
        var page_id = $(this).attr("page_id");

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-cms-page-status',
            data: { status: status, page_id: page_id },
            success: function (resp) {
                if (resp['status'] == 0) {
                    $("#page-" + page_id).html("<i class='fas fa-toggle-off' style='color:grey' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    $("#page-" + page_id).html("<i class='fas fa-toggle-on' style='color:#3f6ed3' status='Active'></i>");
                }
            },
            error: function () {
                alert("Error");
            }
        });
    });



    //konfirmasi hapus

    $(document).on("click", ".confirmDelete", function () {
        var record = $(this).attr('record');
        var recordid = $(this).attr('recordid');
        Swal.fire({
            title: "Apakah Anda Yakin?",
            text: "Klik oke untuk Menghapus!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Oke"
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "TERHAPUS!",
                    text: "Operasi perintah berhasil!.",
                    icon: "success"
                })
                window.location.href = "/admin/delete-" + record + "/" + recordid;
            }
        });
    });
    // $(document).on("click",".confirmDelete",function(){


    //     var name = $(this).attr('name');
    //     if(confirm('Apakah Anda yakin untuk menghapus '+name+'?')){
    //         return true;
    //     }
    //     return false;

    // });

    //update subadmin status
    $(document).on("click", ".updateSubadminStatus", function () {
        var status = $(this).find("i").attr("status");
        var subadmin_id = $(this).attr("subadmin_id");

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-subadmin-status',
            data: { status: status, subadmin_id: subadmin_id },
            success: function (resp) {
                if (resp['status'] == 0) {
                    $("#subadmin-" + subadmin_id).html("<i class='fas fa-toggle-off' style='color:grey' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    $("#subadmin-" + subadmin_id).html("<i class='fas fa-toggle-on' style='color:#3f6ed3' status='Active'></i>");
                }
            },
            error: function () {
                alert("Error");
            }
        });
    });
    //update category status
    $(document).on("click", ".updateCategoryStatus", function () {
        var status = $(this).find("i").attr("status");
        var category_id = $(this).attr("category_id");

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-category-status',
            data: { status: status, category_id: category_id },
            success: function (resp) {
                if (resp['status'] == 0) {
                    $("#category-" + category_id).html("<i class='fas fa-toggle-off' style='color:grey' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    $("#category-" + category_id).html("<i class='fas fa-toggle-on' style='color:#3f6ed3' status='Active'></i>");
                }
            },
            error: function () {
                alert("Error");
            }
        });
    });
    //update Banner status
    $(document).on("click", ".updateBannerStatus", function () {
        var status = $(this).find("i").attr("status");
        var banner_id = $(this).attr("banner_id");

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-banner-status',
            data: { status: status, banner_id: banner_id },
            success: function (resp) {
                if (resp['status'] == 0) {
                    $("#banner-" + banner_id).html("<i class='fas fa-toggle-off' style='color:grey' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    $("#banner-" + banner_id).html("<i class='fas fa-toggle-on' style='color:#3f6ed3' status='Active'></i>");
                }
            },
            error: function () {
                alert("Error");
            }
        });
    });
    //update Brand status
    $(document).on("click", ".updateBrandStatus", function () {
        var status = $(this).find("i").attr("status");
        var brand_id = $(this).attr("brand_id");

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-brand-status',
            data: { status: status, brand_id: brand_id },
            success: function (resp) {
                if (resp['status'] == 0) {
                    $("#brand-" + brand_id).html("<i class='fas fa-toggle-off' style='color:grey' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    $("#brand-" + brand_id).html("<i class='fas fa-toggle-on' style='color:#3f6ed3' status='Active'></i>");
                }
            },
            error: function () {
                alert("Error");
            }
        });
    });
    //update product status
    $(document).on("click", ".updateProductStatus", function () {
        var status = $(this).find("i").attr("status");
        var product_id = $(this).attr("product_id");

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-product-status',
            data: { status: status, product_id: product_id },
            success: function (resp) {
                if (resp['status'] == 0) {
                    $("#product-" + product_id).html("<i class='fas fa-toggle-off' style='color:grey' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    $("#product-" + product_id).html("<i class='fas fa-toggle-on' style='color:#3f6ed3' status='Active'></i>");
                }
            },
            error: function () {
                alert("Error");
            }
        });
    });
    //update attribute status
    $(document).on("click", ".updateAttributeStatus", function () {
        var status = $(this).find("i").attr("status");
        var attribute_id = $(this).attr("attribute_id");

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-attribute-status',
            data: { status: status, attribute_id: attribute_id },
            success: function (resp) {
                if (resp['status'] == 0) {
                    $("#attribute-" + attribute_id).html("<i class='fas fa-toggle-off' style='color:grey' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    $("#attribute-" + attribute_id).html("<i class='fas fa-toggle-on' style='color:#f9f9f9' status='Active'></i>");
                }
            },
            error: function () {
                alert("Error");
            }
        });
    });

    // add attribute script
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><input type="text" name="size[]" id="size" placeholder="Ukuran" style="width: 120px">&nbsp;<input type="text" name="sku[]" id="sku" placeholder="Kode SKU"style="width: 120px">&nbsp;<input type="text" name="price[]" id="price" placeholder="Harga"style="width: 120px">&nbsp;<input type="text" name="stock[]" id="stock" placeholder="Stok"style="width: 120px">&nbsp;<a href="javascript:void(0);" class="remove_button"><i style="color:#f9f9f9" class="fas fa-eraser"></i></a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1

    // Once add button is clicked
    $(addButton).click(function () {
        //Check maximum number of input fields
        if (x < maxField) {
            x++; //Increase field counter
            $(wrapper).append(fieldHTML); //Add field html
        } else {
            alert('A maximum of ' + maxField + ' fields are allowed to be added. ');
        }
    });

    // Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function (e) {
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrease field counter
    });

});