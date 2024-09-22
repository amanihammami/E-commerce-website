<!DOCTYPE html>
<html>
<head> 
    @include('admin.css')
    <style type="text/css">
        .table_center {
            display: flex;
            justify-content: center;
            text-align: center;
        }
        th {
            background-color: skyblue;
            padding: 10px;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            color:white;
        }
        td 
        {
            color:white;
            padding: 10px;
            border: 1px solid skyblue;
            text-align: center;
        }
    </style>
</head>
<body>
    @include('admin.header')
    @include('admin.sidebar')
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <div class="table_center">
                    <table>
                        <tr>
                            <th>Customer name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Product title</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Change Status</th>
                            <th>print PDF</th>
                        </tr>
                        @foreach($data as $data)
                        <tr>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->rec_address }}</td>
                            <td>{{ $data->phone }}</td>
                            <td>{{ $data->product->title }}</td>
                            <td>{{ $data->product->price }}</td>
                            <td><img width="150" src="products/{{ $data->product->image }}"></td>
                            <td>
                                @if($data->status=='in progress')
                                <span style="color:red">{{ $data->status }}</span>
                                @elseif($data->status=='On_the_way')
                                <span style="color:skyblue">{{ $data->status }}</span>
                                @else($data->status=='Delivered')
                                <span style="color:yellow">{{ $data->status }}</span>
                                @endif
                            </td>
                            <td>
                               
                                <a class="btn btn-primary" href="{{url('On_the_way',$data->id)}}" >On_the_way</a>
                                <a class="btn btn-success" href="{{url('Delivered',$data->id)}}" >Delivered</a>
                        </td>
                        <td><a class="btn btn-secondary"href="{{url('print_pdf',$data->id)}}" >print PDF</a>                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- JavaScript files-->
    <script src="{{ asset('admincss/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/popper.js/umd/popper.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/jquery.cookie/jquery.cookie.js') }}"> </script>
    <script src="{{ asset('admincss/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('admincss/js/charts-home.js') }}"></script>
    <script src="{{ asset('admincss/js/front.js') }}"></script>
</body>
</html>