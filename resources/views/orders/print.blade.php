@extends('layouts.app')

@section('body')

<section class="vbox bg-white">
    <header class="header b-b b-light hidden-print">
        <button href="#" class="btn btn-sm btn-info pull-right" onClick="window.print();">Print</button>
        <p>Invoice</p>
    </header>
    <section class="scrollable wrapper" id="print">
        <div class="row">
            <div class="col-xs-6">
                <h2 style="margin-top: 0px">DONSOFT <b>NIG</b></h2>
                <p>{{\App\Setting::settings()->get('address')}}<br>
                    95014 Cuperino, CA<br>
                    United States
                </p>
            </div>
            <div class="col-xs-6 text-right">
                <h4>INVOICE</h4>
            </div>
        </div>
        <div class="well m-t" style="margin-bottom: 50px">
            <div class="row">
                <div class="col-xs-6">
                    <strong>TO:</strong>
                    <h4>{{ $order->name }}</h4>
                    <p>
                        {{ $order->address }}
                    </p>
                </div>
                <div class="col-xs-6 text-right">
                    <p class="h4">#{{ $order->id }}</p>
                    {{-- <h5>{{ $order->delivery_date }}</h5> --}}
                    <p class="m-t m-b">Order date: <strong>{{date('d-m-Y', strtotime($order->created_at))}}</strong><br>
                    Order Code: <strong>#{{$order->order_code}}</strong>
                    </p>
                </div>
            </div>
        </div>
        <div class="line"></div>
        <table class="table">
            <thead>
            <tr>
                <th> Name</th>
                <th width="60">QTY</th>
                <th>Price</th>
                <th width="120">TOTAL</th>
            </tr>
            </thead>
            <tbody>
              
         @foreach ($orderProduct as $item)
            <tr>
              
                <td>{{ $item->name}}</td>
                <td>{{ $item->qty}}</td>
                <td>{{ $item->price}}</td>
                <td>{{ $item->total}}</td>
                
                @endforeach
                
            </tr>
            <tr>
                <td colspan="2" class="text-right"><strong>Subtotal</strong></td>
                <td>{{\App\Order::presentPrice($order->subtotal)}}</td>
            </tr>
            <tr>
                <td colspan="2" class="text-right no-border"><strong>VAT Included in Total</strong></td>
                <td>{{ \App\Order::presentPrice($order->total - $order->subtotal)  }}</td>
            </tr>
            <tr>
                <td colspan="2" class="text-right no-border"><strong>Total</strong></td>
                <td><strong>{{ \App\Order::presentPrice($order->total)  }}</strong></td>
            </tr>
            </tbody>
        </table>
        <div class="row">
            <div class="col-xs-8">
                <p><i> Buy goods  will not be returned after 20 days of delivery</i></p>

                <p>Recvied By:  __________________ </p>
            </div>
        </div>
    </section>
</section>

@endsection