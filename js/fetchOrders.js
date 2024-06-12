// fetchOrders.js

$(document).ready(function() {
    function fetchOrders() {
        $.ajax({
            url: 'fetch_orders.php',
            method: 'GET',
            success: function(response) {
                let orders = JSON.parse(response);
                let ordersHtml = '';

                orders.forEach(function(order) {
                    ordersHtml += `<li class="collection-item avatar">
                        <i class="mdi-content-content-paste red circle"></i>
                        <span class="collection-header">Order No. ${order.id}</span>
                        <p><strong>Date:</strong> ${order.date}</p>
                        <p><strong>Payment Type:</strong> ${order.payment_type}</p>
                        <p><strong>Address:</strong> ${order.address}</p>
                        <p><strong>Status:</strong> ${order.status}</p>
                        ${order.description ? `<p><strong>Note:</strong> ${order.description}</p>` : ''}
                        <a href="#" class="secondary-content"><i class="mdi-action-grade"></i></a>
                    </li>`;

                    order.order_details.forEach(function(detail) {
                        ordersHtml += `<li class="collection-item">
                            <div class="row">
                                <div class="col s7">
                                    <p class="collections-title"><strong>#${detail.item_id}</strong> ${detail.item_name}</p>
                                </div>
                                <div class="col s2">
                                    <span>${detail.quantity} Pieces</span>
                                </div>
                                <div class="col s3">
                                    <span>Rs. ${detail.price}</span>
                                </div>
                            </div>
                        </li>`;
                    });

                    ordersHtml += `<li class="collection-item">
                        <div class="row">
                            <div class="col s7">
                                <p class="collections-title">Total</p>
                            </div>
                            <div class="col s2">
                                <span></span>
                            </div>
                            <div class="col s3">
                                <span><strong>Rs. ${order.total}</strong></span>
                            </div>
                        </div>
                    </li>`;
                });

                $('#issues-collection').html(ordersHtml);
            }
        });
    }

    setInterval(fetchOrders, 5000); // 每5秒刷新一次订单列表
    fetchOrders(); // 页面加载时首次调用
});
