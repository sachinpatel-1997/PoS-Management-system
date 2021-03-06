@extends('layouts.admin_layout.admin_layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Add Purchase</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/')  }}">Home</a></li>
                            <li class="breadcrumb-item active">Add Purchase</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <section class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3>Add Purchase
                                    <a class="btn btn-success float-right" href="{{route('purchase.view')}}"><i
                                            class="fa fa-list"></i> View Purchase</a>
                                </h3>
                            </div>
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="date">Date</label>
                                            <input type="date" name="date" id="date" class="form-control datepicker" placeholder="YYYY-MM-DD">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="purchase_no">Purchase_no</label>
                                            <input type="text" name="purchase_no" id="purchase_no" class="form-control"/>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="supplier_id">Select Supplier</label>
                                            <select name="supplier_id" id="supplier_id" class="form-control select2">
                                                <option value="">Select Supplier</option>
                                                @foreach ($suppliers as $supplier)
                                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="category_id">Select Category</label>
                                            <select name="category_id" id="category_id" class="form-control select2">
                                                <option value="">Select Category</option>
                                                 @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="product_id">Select Product</label>
                                            <select name="product_id" id="product_id" class="form-control select2">
                                                <option value="">Select Product</option>
                                                 @foreach ($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2" style="padding-top: 30px;">
                                            <a class="btn btn-primary addeventmore"><i class="fa fa-plus-circle"> Add Item</i></a>
                                        </div>
                                    </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('purchase.store') }}" method="post" id="myForm">
                                    @csrf
                                    <table class="table-m table-bordered" width="100%">
                                        <thead>
                                        <tr>
                                            <th>Category</th>
                                            <th>Product Name</th>
                                            <th width="7%">Pcs/Kg</th>
                                            <th width="10%">Unit Price</th>
                                            <th>Description</th>
                                            <th width="10%">Total Price</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody id="addRow" class="addRow">

                                        </tbody>
                                        <tbody>
                                        <tr>
                                            <td colspan="5"></td>
                                            <td>
                                                <input type="text" name="estimated_amount" value="0" id="estimated_amount" class="form-control form-control-sm text-right estimated_amount" readonly style="background-color: #D8FDBA"/>
                                            </td>
                                            <td></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <br>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" id="storeButton">Store Purchase</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>
                <!-- /.row -->
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- html script -->
   
     <script id="document-template" type="text/x-handlebars-template">
        <tr class="delete_add_more_item" id="delete_add_more_item">
            <input type="hidden" name="date[]" value="@{{ date }}">
            <input type="hidden" name="purchase_no[]" value="@{{ purchase_no }}">
            <input type="hidden" name="supplier_id[]" value="@{{ supplier_id }}">
            <td>
                <input type="hidden" name="category_id[]" value="@{{ category_id }}"> @{{ category_name }}
            </td>
            <td>
                <input type="hidden" name="product_id[]" value="@{{ product_id }}"> @{{ product_name }}
            </td>
            <td>
                <input type="number" min="1" name="buying_qty[]" value="1" class="form-control form-control-sm text-right buying_qty">
            </td>
            <td>
                <input type="number" min="1" name="unit_price[]" value="" class="form-control form-control-sm text-right unit_price">
            </td>
            <td>
                <input type="text" name="description[]" class="form-control form-control-sm">
            </td>
            <td>
                <input class="form-control form-control-sm text-right buying_price" name="buying_price[]" value="0" readonly>
            </td>
            <td><a class="btn btn-danger btn-sm removeeventmore"><i class="fa fa-window-close"></i></a></td>
        </tr>
    </script>

   

@endsection
