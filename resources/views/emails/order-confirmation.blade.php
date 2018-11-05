Hi {{$order->customer->name}}<br>

Order number {{$order->order_number}} has been confirmed.<br>

Product<br>
<strong>Name: {{ $order->product->name }}</strong><br>
<strong>Price: {{ $order->product->price }}</strong><br>
<strong>Description: {{ $order->product->description }}</strong>
