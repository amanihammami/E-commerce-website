<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
    <style>
        .div_deg
        {
            display:flex;
            justify-content: center;
            align-items:center;
            margin-top = 60px;
        }
        .table_deg
        {
            border:2px;
        }
        th
        {
            background-color:skyblue;
            color:white;
            font-size:19px;
            font-weight:bold;
            padding:15px;
        }
        td
        {
            border:1px solid skyblue;
            text-align:center;
            color:white;
        
        }
        input[type='search']
        {
            width : 500px;
            height : 60px;
            margin-left : 200px;
        }
    </style>
  </head>
  <body>
    @include('admin.header')
    @include('admin.sidebar')
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
          <form action="{{url('product_search')}}" method="get"> 
            @csrf
                    <input type="search" name="search">
                    <input  class="btn btn-success" type="submit" value = "search">
            </form>
            <div class="div_deg">
                
                <table class="table_deg">
                    <tr>
                        <th>Product Title</th>
                        <th>description</th>
                        <th>image</th>
                        <th>price</th>
                        <th>category</th>
                        <th>quantity</th>
                        <th>Edit</th>
                        
                        <th>delete</th>
                    </tr>
                    @foreach($product as $products)
                    <tr>
                        <td>{{$products->title}}</td>
                        <td>{!!Str::limit($products->description,50)!!}</td>
                        <td><img height="120px" widht="120px" src="products/{{$products->image}}">
                        </td>
                        <td>{{$products->price}}</td>
                        <td>{{$products->category}}</td>
                        <td>{{$products->quantity}}</td>
                        <td><a class="btn btn-danger" href="{{url('update_product',$products->slug)}}" >Edit</td>
                        <td><a class="btn btn-danger"onclick="confirmation(event)" href="{{url('delete_product',$products->id)}}" >Delete

                        </a></td>
                    </tr>
                    @endforeach
                </table>
                <!-- Latest compiled and minified CSS -->

                
            </div>
            <div class="div_deg">
            {{$product->onEachSide(1)->links()}}
            </div>
        </div>
      </div>
    </div>
    <!-- JavaScript files-->
    <script type="text/javascript">
        function confirmation(ev)
        {
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');
            console.log(urlToRedirect);
            swal({
                titre:"Are You sure to delete this ",
                text:"this delete will be permanent",
                icon:"warning",
                buttons:true,
                dangerMode:true,
            })
            .then((willcancel)=>{
                if(willcancel)
                {
                    window.location.href=urlToRedirect;
                }
            })
        }
     </script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" 
    integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
     crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="{{asset('admincss/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/popper.js/umd/popper.min.js')}}"> </script>
    <script src="{{asset('admincss/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
    <script src="{{asset('admincss/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('admincss/js/charts-home.js')}}"></script>
    <script src="{{asset('admincss/js/front.js')}}"></script>
  </body>
</html>
