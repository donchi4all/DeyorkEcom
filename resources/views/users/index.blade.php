
 @extends('layouts.app')

@section('title')
    All Products
@endsection

@section('body')

<section class="vbox">
    <section class="scrollable padder">
        <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
            <li><a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Users</li>
        </ul>
        <div class="m-b-md">
            <h3 class="m-b-none">Users Data</h3>
        </div>
        <section class="panel panel-default">

            <div class="clearfix"></div>

          @include('flash::message')

        <div class="clearfix"></div>

            <header class="panel-heading">
                All Users Data
                <button onClick ="$('#table').tableExport({type:'pdf',escape:'false',pdfFontSize:12,separator: ','});" class="btn btn-default btn-xs pull-right">PDF</i></button>
                <button onClick ="$('#table').tableExport({type:'csv',escape:'false'});" class="btn btn-default btn-xs pull-right">CSV</button>
                <button onClick ="$('#table').tableExport({type:'excel',escape:'false'});" class="btn btn-default btn-xs pull-right">Excel</i></button>
                <button onClick ="$('#table').tableExport({type:'sql',escape:'false',tableName:'orders'});" class="btn btn-default btn-xs pull-right">SQL</i></button>
                <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i>
            </header>

 
          

            <div class="table-responsive">
        
              @include('users.table')
          
                   
          
            </div>
        </section>
    </section>
 </section>




@endsection