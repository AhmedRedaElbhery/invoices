@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

    <!-- Internal Spectrum-colorpicker css -->
    <link href="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.css') }}" rel="stylesheet">

    <!-- Internal Select2 css -->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

@section('title')
    تقرير الفواتير - مورا سوفت للادارة الفواتير
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">التقارير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تقرير
                الفواتير</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>خطا</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- row -->
<div class="row">

    <div class="col-xl-12">
        <div class="card mg-b-20">


            <div class="card-header pb-0">

                <form action="{{route('reports_search')}}" method="Get" role="search" autocomplete="off">
                    {{ csrf_field() }}

                    <div class="w-25 mb-3"> 
                        <p class="mg-b-10">البحث برقم الفاتورة</p>
                        <input type="text" class="form-control" id="invoice_number" name="invoice_number">
                    </div>
                    
                    <div class="mb-3" style="width: 120px;">
                        <button class="btn btn-primary btn-block">بحث</button>
                    </div>

                </form>

                @if(session('data'))
                    <div class="card-body w-100">
                        <div class="table-responsive">
                            <table id="example" class="table key-buttons text-md-nowrap">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">العدد</th>
                                        <th class="border-bottom-0">رقم الفاتوره</th>
                                        <th class="border-bottom-0">تاريخ القاتوره</th>
                                        <th class="border-bottom-0">تاريخ الاستحقاق</th>
                                        <th class="border-bottom-0"> المنتج</th>
                                        <th class="border-bottom-0">القسم</th>
                                        <th class="border-bottom-0">الخصم</th>
                                        <th class="border-bottom-0">نسبه ضريبه</th>
                                        <th class="border-bottom-0">فيمه الضريبه</th>
                                        <th class="border-bottom-0"> الاجمالى</th>
                                        <th class="border-bottom-0"> الحاله</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $number = 0 ?>
                                    @foreach(session('data') as $invoice)
                                    <tr>

                                        <td>{{++$number}}</td>
                                        <td><a href="{{route('invoices.details',['id'=>$invoice->id])}}">{{$invoice->invoice_number}}</a></td>
                                        <td>{{$invoice->invoice_Date}}</td>
                                        <td>{{$invoice->due_date}}</td>
                                        <td>{{$invoice->product}}</td>
                                        <td>{{$invoice->sections->section_name}}</td>
                                        <td>{{$invoice->Discount}}</td>
                                        <td>{{$invoice->Rate_VAT}}</td>
                                        <td>{{$invoice->Value_VAT}}</td>
                                        <td>{{$invoice->Total}}</td>
                                        <td>
                                            @if($invoice->Value_Status == 0)
                                            <span class="text-success">{{$invoice->Status}}</span>
                                            @elseif($invoice->Value_Status == 1)
                                            <span class="text-warning">{{$invoice->Status}}</span>

                                            @elseif($invoice->Value_Status == 2)
                                            <span class="text-danger">{{$invoice->Status}}</span>
                                            @endif
                                        </td>
                                        

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
            
        </div>
    </div>
</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>


@endsection


