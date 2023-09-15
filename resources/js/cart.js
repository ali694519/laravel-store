
(function($) {

 $('.item-quantity').on('change',function(e) {

        $.ajax({

            url:'/carts/'+ $(this).data('id'), // data-id
            method: 'put',
            data: {
                quantity: $(this).val(),
                _token: csrf_token
            }
        });

    });

    $('.remove-item').on('click',function(e) {
        let id = $(this).data('id');
        $.ajax({
            url:'/carts/'+ id, // data-id
            method: 'delete',
            data: {
                _token: csrf_token
            },
            success: response => {
                $(`#${id}`).remove();
            }
        });

    });


     $('.add-to-cart').on('submit',function(e) {
        var product_id = $('input[name="product_id"]').val();
        var quantity = $('select[name="quantity"]').val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url:'/carts/',
            method: 'post',
            data: {
                product_id: product_id,
                quantity: quantity,
                _token: _token
            },
           success: function(response) {
            alert('Product added to cart');
            },
            error: function(error) {
                alert('Error adding product to cart');
            }
        });

    });



 })(jQuery);



