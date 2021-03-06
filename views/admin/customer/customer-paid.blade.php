@extends('layouts.admin_layout.admin_layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Paid Customer List</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/')  }}">Home</a></li>
                            <li class="breadcrumb-item active">Customers</li>
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
                                <h3>Customer List
                                    <a class="btn btn-success float-right" href="{{route('customers.paid.pdf')}}"><i class="fa fa-download"></i> Download PDF</a>
                                </h3>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Sn</th>
                                        <th>Customer Name</th>
                                        <th>Invoice No.</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($allData as $key => $payment)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $payment['customer']['name'] }} ({{ $payment['customer']['mobile_no'] }})</td>
                                            <td>Invoice No #{{ $payment['invoice']['invoice_no'] }}</td>
                                            <td>{{ date("d-m-Y", strtotime($payment['invoice']['date'])) }}</td>
                                            <td>{{ $payment->paid_amount  }}???</td>
                                            <td>
                                                <a href="{{ route('customers.invoice.details.pdf', $payment->invoice_id) }}" id="details" title="details" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
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

@endsection
