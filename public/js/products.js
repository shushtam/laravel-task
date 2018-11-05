$(document).ready(function () {
    $(".btn-select-image").on('click', function (e) {
        e.preventDefault();
        $(".edit-general-image").trigger('click');
    });
    $(".show-images").on('click', function (e) {
        let images = $(this).attr("data-images");
        let modalBody = $(".images-modal .modal-body");
        images = JSON.parse(images);
        modalBody.empty();
        if (images.length > 0) {
            for (let image in images) {
                modalBody.append("<img src='/images/products/" + images[image].name + " '>")
            }
        }
        else {
            modalBody.append("<p>No images</p>");
        }
    });
    $(".show-order").on('click', function (e) {
        let product = $(this).attr("data-product");
        let modalBody = $(".order-modal .product-details");
        product = JSON.parse(product);
        modalBody.empty();
        modalBody.append("<p>Name: " + product.name + "</p><p>Price: " + product.price + "</p>" + "<input type='hidden' name='product_id' value='" + product.id + "'> ");
    });
    $(".make-order").on('click', function (e) {
        let account_name = $("input[name=account_name]").val(),
            account_password = $("input[name=account_password]").val(),
            create_profile = $("input[name=create_profile]").is(':checked') ? 1 : 0,
            billing_street = $("input[name=billing_street]").val(),
            billing_city = $("input[name=billing_city]").val(),
            billing_zip = $("input[name=billing_zip]").val(),
            billing_country = $("input[name=billing_country]").val(),
            product_id = $("input[name=product_id]").val();
        $(".invalid-feedback").addClass("hidden").prev().removeClass("is-invalid");
        $.ajax({
            url: "/make-order",
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "json",
            data: {
                account_name: account_name,
                account_password: account_password,
                create_profile: create_profile,
                billing_street: billing_street,
                billing_city: billing_city,
                billing_zip: billing_zip,
                billing_country: billing_country,
                product_id: product_id
            },
            success: function (result) {
                window.location.href = "/home";
            },
            error: function (result) {
                $.each(result.responseJSON.errors, function (key, val) {
                    let elem = $("span." + key);
                    elem.removeClass("hidden").find("strong").text(val[0]);
                    elem.prev().addClass("is-invalid");
                });
            }
        });
    });

});