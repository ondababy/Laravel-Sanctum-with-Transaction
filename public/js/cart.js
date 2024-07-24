$(document).ready(function () {
    const csrfToken = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        type: "GET",
        url: "/api/thrifts",
        dataType: 'json',
        success: function (data) {
            console.log(data);
            $.each(data, function (key, value) {
                id = value.item_id;
                var item = "<div class='item'><div class='itemDetails'><div class='itemImage'><img src=" + value.image + " width='200px', height='200px'/></div><div class='itemText'><h5>" + value.name + "</h5><p>Category: " + value.description + "</p><p class='price-container'>Price: Php <span class='price'>" + value.price + "</span></p><p>Stock: " + value.stock + "</p></div><input type='number' class='quantity' name='quantity' min='1' max=" + value.stock + "><p class='itemId'>" + value.id + "</p></div><button type='button' class='btn btn-primary add' >Add to cart</button></div>";
                $("#items").append(item);

            });
        },
        error: function () {
            console.log('AJAX load did not work');
            alert("error");
        }

    });

    $("#items").on('click', '.add', function () {
		var item = $(this).closest('.item');
        var productId = item.find('.itemId').text();
        var quantity = item.find('.qty').val();

		$.ajax({
            type: "POST",
            url: "/api/addtoCart",
            data: JSON.stringify({
                product_id: productId,
                quantity: quantity
            }),
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            contentType: "application/json",
            success: function (response) {
				(response.message, 'success');
			},
			error: function (xhr, status, error) {
                console.error("Error adding item to cart:", status, error);
                alert('Error adding item to cart.', 'danger');
            }
        });
    });

    // Checkout

    $('#checkoutBtn').click(function(e) {
        e.preventDefault();
        const csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: "POST",
            url: "/api/checkout",
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            contentType: "application/json",
            success: function(response) {
                if (response.code === 200) {
                    window.location.href = '/';
                    alert('Successfully ordered!');
                } else {
                    alert(response.error);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error status:', status);
                console.error('Error details:', error);
                alert('Error processing checkout. Status: ' + status + '. Error: ' + error);
            }
        });
    });
});
