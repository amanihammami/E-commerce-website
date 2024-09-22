<!DOCTYPE html>
<html>
    
    <body>
        <center>
            <h3>Customer name: {{$data->name}}</h3>
            <h3>Customer address: {{$data->rec_address}}</h3>
            <h3>Phone: {{$data->phone}}</h3>
            <h3>Product title: {{$data->product->title}}</h3>
            <h3>Price: {{$data->product->price}}</h3>
            <img height="250" width="300" src="products/{{$data->product->image}}" >
        </center>
    </body>
</html>