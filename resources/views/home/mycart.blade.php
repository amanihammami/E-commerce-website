
<!DOCTYPE html>
<html>
<head>
    @include('home.css')
    <style type="text/css">
        .div_deg {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 60px;
        }
        table {
            border: 2px solid black;
            text-align: center;
            width: 800px;
        }
        th {
            border: 2px solid black;
            text-align: center;
            color: white;
            font-size: 20px;
            font-weight: bold;
            background-color: black;
        }
        td {
            border: 1px solid skyblue;
        }
        .carte_value {
            text-align: center;
            margin-bottom: 70px;
            padding: 18px;
        }
        .order_deg {
            
            padding-right: 100px;
            margin-top: -50px;
        }
        label {
            display: inline-block;
            width: 150px;
        }
        .div_gap {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px; /* Add appropriate padding value */
        }
    </style>
</head>
<body>
    <div class="hero_area">
        <!-- header section starts -->
        @include('home.header')
        <!-- end header section -->
    </div>
    <!-- end hero area -->
    
    <?php 
        $value = 0;
    ?>
  
    
    <div class="div_deg">
    
    
    

        <table>
            <tr>
                <th>Product Title</th>
                <th>Price</th>
                <th>Image</th>
            </tr>
        
            @foreach($cart as $cart)
            <tr>
                <td>{{ $cart->product->title }}</td>
                <td>{{ $cart->product->price }}</td>
                <td><img width="150" src="products/{{ $cart->product->image }}"></td>
            </tr>
            <?php
                $value += $cart->product->price;
            ?>
            @endforeach
        </table>
    </div>  
    

    <div class="carte_value">
        <h3>Total value of cart is: ${{ $value }}</h3>
    </div>
    <div class="order_deg" >
        <form action="{{url('confirm_order')}}" method="post">
            @csrf
            <div class="div_gap">
                <label>Receiver Name</label>
                <input type="text" name="name" value="{{Auth::user()->name}}">
            </div>
            <div class="div_gap">
                <label>Receiver Address</label>
                <textarea name="address"> {{Auth::user()->address}}</textarea>
            </div>
            <div class="div_gap">
                <label>Receiver Phone</label>
                <input type="text" name="phone"  value="{{Auth::user()->phone}}">
            </div>
            <div class="div_gap">
                <input class="btn btn-primary" type="submit" name="submit" value="cash on delivery">
                <a class="btn btn-success" href="{{url('stripe',$value)}}" > Pay Using Card </a>
            </div>
        </form>

    
    <!-- info section -->
    @include('home.footer')
  
</body>
</html>