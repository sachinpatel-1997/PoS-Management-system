@extends('layouts.admin_layout.admin_layout')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add Invoice</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/')  }}">Home</a></li>
                        <li class="breadcrumb-item active">Add Invoice</li>
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
                            <h3>Add Invoice
                                <a class="btn btn-success float-right" href="{{route('invoice.view')}}"><i
                                        class="fa fa-list"></i> View Invoice</a>
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
                                <div class="form-group col-md-2">
                                    <label for="invoice_no">Invoice No</label>
                                    <input type="text" name="invoice_no" id="invoice_no" value="{{$invoice_no}}"
                                        class="form-control"  style="background-color: #D8FA3C" />
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="date">Date</label>
                                    <input type="date" value="{{ $date }}" name="date" id="date" class="form-control datepicker"
                                        placeholder="YYYY-MM-DD">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="category_id">Select Category</label>
                                    <select name="category_id" id="category_id" class="form-control select2">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="product_id">Select Product</label>
                                    <select name="product_id" id="product_id" class="form-control select2">
                                        <option value="">Select Product</option>
                                         @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="product_id">Stock(Pcs/Kg))</label>
                                    <input type="text" name="current_stock_qty" id="current_stock_qty"
                                        class="form-control"  style="background-color: #D8FA3C">
                                </div>
                                <div class="form-group col-md-2" style="padding-top: 30px;">
                                    <a class="btn btn-primary addeventmor"><i class="fa fa-plus-circle"> Add
                                            Item</i></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('invoice.store') }}" method="post" id="myForm">
                                @csrf
                                <table class="table-m table-bordered" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Category</th>
                                            <th>Product Name</th>
                                            <th width="7%">Pcs/Kg</th>
                                            <th width="10%">Unit Price</th>
                                            <th width="17%">Total Price</th>
                                            <th width="10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="addRow" class="addRow">

                                    </tbody>
                                    <tbody>
                                        <tr>
                                            <td class="text-right" colspan="4">Discount </td>
                                            <td>
                                                <input type="text" name="discount_amount" id="discount_amount" class="form-control form-control-sm discount_amount text-right" placeholder="Enter Discount Amount">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-right" colspan="4">Grand Total </td>
                                            <td>
                                                <input type="text" name="estimated_amount" value="0"
                                                    id="estimated_amount"
                                                    class="form-control form-control-sm text-right estimated_amount text-right"
                                                     style="background-color: #D8FDBA" />
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <br>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <textarea name="description" id="description" class="form-control"
                                            placeholder="Write your description here..."></textarea>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="paid_status">Paid Status</label>
                                        <select name="paid_status" id="paid_status" class="form-control">
                                            <option value="">Select Status</option>
                                            <option value="full_paid">Full Paid</option>
                                            <option value="full_due">Full Due</option>
                                            <option value="partial_paid">Partial Paid</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <input type="text" name="paid_amount" class="form-control paid_amount" style="display: none; margin-top: 30px;" placeholder="Enter partial amount">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="customer_id">Select Customer</label>
                                        <select name="customer_id" id="customer_id" class="form-control select2">
                                            <option value="">Select Customer</option>
                                            @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->name }}({{ $customer->mobile_no }}, {{ $customer->address }})</option>
                                            @endforeach
                                            <option value="0">New Customer</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row new_customer" style="display: none;">
                                    <div class="form-group col-md-4">
                                        <input type="text" name="name" id="name" class="form-control form-control-sm" placeholder="Write customer name....">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" name="mobile_no" id="mobile_no" class="form-control form-control-sm" placeholder="Write customer number...">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" name="address" id="address" class="form-control form-control-sm" placeholder="Write customer address...">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary" id="storeButton">Invoice
                                        Store</button>
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
            <input type="hidden" name="date" value="@{{ date }}">
            <input type="hidden" name="invoice_no" value="@{{ invoice_no }}">
            <td>
                <input type="hidden" name="category_id[]" value="@{{ category_id }}"> @{{ category_name }}
            </td>
            <td>
                <input type="hidden" name="product_id[]" value="@{{ product_id }}"> @{{ product_name }}
            </td>
            <td>
                <input type="number" min="1" name="selling_qty[]" value="1" class="form-control form-control-sm text-right selling_qty">
            </td>
            <td>
                <input type="number" min="1" name="unit_price[]" value="" class="form-control form-control-sm text-right unit_price">
            </td>
            <td>
                <input class="form-control form-control-sm text-right selling_price" name="selling_price[]" value="0" readonly>
            </td>
            <td><a class="btn btn-danger btn-sm removeeventmore"><i class="fa fa-window-close"></i></a></td>
        </tr>
    </script>
@endsection
