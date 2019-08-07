@extends('layouts.app')

@section('title')
    All Orders
@endsection

@section('body')

<section class="vbox">
    <section class="scrollable padder">
        <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
            <li><a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Workset</li>
        </ul>
        <div class="m-b-md">
            <h3 class="m-b-none">Orders Data</h3>
        </div>
        <section class="panel panel-default">
     <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

            <header class="panel-heading">
                All Orders Data
                <button onClick ="$('#table').tableExport({type:'pdf',escape:'false',pdfFontSize:12,separator: ','});" class="btn btn-default btn-xs pull-right">PDF</i></button>
                <button onClick ="$('#table').tableExport({type:'csv',escape:'false'});" class="btn btn-default btn-xs pull-right">CSV</button>
                <button onClick ="$('#table').tableExport({type:'excel',escape:'false'});" class="btn btn-default btn-xs pull-right">Excel</i></button>
                <button onClick ="$('#table').tableExport({type:'sql',escape:'false',tableName:'orders'});" class="btn btn-default btn-xs pull-right">SQL</i></button>
                <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i>
            </header>

 
    <p><a  class="btn btn-lg btn-success"  href="{{ route('order.cart') }}"> Add to Cart
    @if (Cart::instance('default')->count() > 0)
    <span class="cart-count"><span class="badge badge-danger">{{ Cart::instance('default')->count() }}</span></span>
    @endif
    </a></p>
            <div class="table-responsive">
                <table class="table table-striped m-b-none" data-ride="datatables" id="table">
                    <thead>
                        <tr>
                            <th width="">Name</th>
                            <th width="">Phone</th>
                            <th width="">Address(s)</th>
                            <th width="">Quantity</th>
                            <th width="">Order Code</th>
                            <th width="">Status</th>
                            <th width="150px">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($orders as $order )
                            <tr>
                                <td> <a href="{{ route('user.show',$order->user_id) }} ">{{ $order->user['name'] }}</a></td>
                                <td>{{ \App\Order::orderShipping($order->id)->get('email') }}</td>
                                <td>{{ \App\Order::orderShipping($order->id)->get('address') }} </td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->order_code}}</td>
                                <td>{{ $order->status }}</td>
                                
                                <td>
                                 
                                    @if (auth()->user()->type == "admin")
                                    
                                  {{ Form::open(['route' => ['order.destroy', $order->id], 'method' => 'delete', 'style'=>'display:inline-block']) }}
                                    <button type="submit" class="btn btn-sm btn-icon btn-danger" onclick="return confirm('Are you sure you want to delete this?')" ><i class="fa fa-trash-o"></i></button>
                                    {{ Form::close() }}
                                    <a href="{{ route('order.edit',$order->id) }}" class="btn btn-sm btn-icon btn-warning"><i class="fa fa-edit"></i></a>
                                    @endif
                                    <a href="{{ route('order.show',$order->id) }}" class="btn btn-sm btn-icon btn-success"><i class="fa fa-eye"></i></a>
                                    <a href="{{ route('order.print',$order->id) }}" class="btn btn-sm btn-icon btn-info"><i class="fa fa-print"></i></a>
                              
                         
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </section>
 </section>







@endsection