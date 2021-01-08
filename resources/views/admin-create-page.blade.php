@extends('layouts.app')

@section('content')
<div class="container py-5 mx-auto w-25">
    <div class="row justify-content-center">
    <h1>CREATE A PRODUCT</h1>
    </div>
    <form action="{{route('admin.create')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="Product_Name">Product Name</label>
            <input type="text" class="form-control" name="name" placeholder="Enter Product Name">
        </div>
        <div class="form-group">
            <label for="Product_Price">Product Price</label>
            <input type="text" class="form-control" name="price" placeholder="Enter Product Price">
        </div>
        <div class="form-group">
            <label for="Product_Image">Product Image</label>
            <input type="file" class="form-control" name="img" >
        </div>
        <div class="form-group">
            <label for="Product_Category">Product Category</label><br>
            <select name="category_id">
                <option value="0">Select Category</option>
                <option value="2">Phone</option>
                <option value="1">Laptop</option>
                <option value="4">TV</option>
                <option value="5">Camera</option>
                <option value="3">Headset</option>
            </select>
        </div>
        <div class="form-group">
            <label for="Product_Brand">Product Brand</label><br>
            <select name="brand_id">
                <option value="0">Select Brand</option>
                <option value="1">Apple</option>
                <option value="2">Dell</option>
                <option value="3">Remax</option>
                <option value="4">Samsung</option>
                <option value="5">Huawei</option>
                <option value="6">Others</option>
            </select>
        </div>
        <button type="submit" class="btn btn-secondary btn-lg">CREATE</button>
    </form>
</div>
@endsection
