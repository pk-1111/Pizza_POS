$(document).ready(function () {
    $('.statusChange').change(function () {
        $changeStatus = $(this).val();

        $orderCode = $(this).parents('tr').find('.orderCode').val();

        $data = {
            'order_code': $orderCode,
            'status': $changeStatus
        };

        $.ajax({
            type: 'get',
            url: '/admin/orderBoard/changeStatus',
            data: $data,
            dataType: 'json',
            success: function (res) {
                res.status == 'success' ? location.reload() : ''
            }
        })
    })  // end


    // order-confirm

    $('#btn-order-confirm').click(function () {
        $orderList = [];
        $orderCode = $('#orderCode').text();

        $('#productTable tbody tr').each(function (index, row) {
            $productId = $(row).find(".productId").val();
            $productOrderCount = $(row).find(".productOrderCount").val();


            $orderList.push({

                'product_id': $productId,
                'order_count': $productOrderCount,
                'order_code': $orderCode,

            })
        })

        $.ajax({
            type: 'get',
            url: '/order/confirmOrder',
            data: Object.assign({}, $orderList),
            dataType: 'json',
            success: function (res) {
                if (res.status == 'success') {
                    location.href = '/user/payment'
                }
            }
        })
    }) // end


    // order-reject

    $('#btn-order-cancle').click(function () {


        $data = {
            'orderCode': $('#orderCode').text()
        }

        $.ajax({
            type: 'get',
            url: '/order/cancleOrder',
            data: $data,
            dataType: 'json',
            success: function (res) {
                if (res.status == 'success') {
                    location.href = '/user/payment'
                }
            }
        })
    })
})
