<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    @include('home.css')
   <style type="text/css">
    .div_center
    {
        display:flex;
        justify-content:center;
        align-items:center;
        margin:60px;
    }
    table
    {
        border:2px solid black;
        text-align:center;
        width:800px;
    }
    th
    {
        border:2px solid black;
        color: white;
        background-color: black;
        font-size:19px;
        font-weight: bold;
    }
    td
    {
        border:1px solid skyblue;
        padding:10px;
    }
    </style>
</head> 
<body>
    <div class="hero_area">
        <!-- header section starts -->
        @include('home.header')
    </div>
    <div class="div_center">
        <table >
            <tr>
                <th>Product Name</th>
                <th>price</th>
                <th>Delivery</th>
                <th>Image</th>
            </tr>
            @foreach($order as $order)
            <tr>
                <td>{{$order->product->title}}</td>
                <td>{{$order->product->price}}</td>
                <td>{{$order->status}}</td>
                <td><img width="300" height="200" src="products/{{$order->product->image}}"></td>
            </tr>
            @endforeach
        </table>
</div>
    @include('home.footer')
</body>
</html>