<p>Chào bạn <strong>{!! $name !!}!</strong></p>
<p>Đây là thông tin đơn hàng  <b>{!! $code_order !!}</b></p>
<p>Họ tên người nhận: {!! $name !!}</p>
<p>Địa chỉ người nhận: {!! $address !!}</p>
<p>SĐT người nhận: {!! $phone !!}</p>
<p>Ghi chú: {!! $note !!}</p>
<p>Số lượng sản phẩm đã đặt {!! $count_item !!}</p>
<p style="color:red;"><strong>Tổng tiền: {!! number_format($total, 0, ",", ".") !!}<sup>đ</sup></strong></p>
<p>Phương thức thanh toán: {!! $payment_method !!}</p>
<p>Cảm ơn quý khách đã đặt hàng. Shop sẽ liên hệ lại với bạn và giao hàng trong thời gian nhanh nhất.</p>
