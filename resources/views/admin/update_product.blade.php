<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
    <style type="text/css">
        .div_deg
        {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top:60px; 
        }
        h1 
        {
            color:white;
        }
        label
        {
            display: inline-block;
            width:250px;
            font-size:15px!important;
            color:white!important;
        }
        input[type='text']
        {
            width: 350px;
            heigth: 50px;
        }
        textarea
        {
            width: 450px;
            heigth: 80px;
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
          <h2>Update Product</h2>
            <div class="div_deg">
               
                <form action="{{url('edit_product',$data->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="input_deg">
                        <label>product title</label>
                            <input type="text" name="title" value="{{$data->title}}" > </input>
                    </div>
                    <div class="input_deg">
                        <label>description</label>
                            <textarea  name="description" value="{{$data->description}}"> </textarea>
                    </div>
                    <div class="input_deg">
                        <label>Current image</label>
                        <img width="80" src="{{ asset('products/'.$data->image) }}" alt="Current image">
                    </div>
                    <div class="input_deg">
                        <label>New image</label>
                        <input  type="file" name="image" >
                    </div>
                    
                    <div class="input_deg">
                        <label>price</label>
                        <input type="text" name="price" value="{{$data->price}}" > </input>
                    </div>
        
                    
                    <div class="input_deg">
                        <label>category</label>
                        <select name="category" >
                          
                            <option value="{{$data->category}}">{{$data->category}}</option>
                            @foreach($category as $category)
                            <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input_deg">
                        <label>quantity</label>
                        <input type="number" name="qty" value="{{$data->quantity}}"> </input>
                    </div>
                    <div >
                    
                        <input class="btn btn-success" type="submit" value=update_product >
                    </div>
                    
                    
                    
                </form>
            </div>
        </div>
      </div>
    </div>
    <!-- JavaScript files-->
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
