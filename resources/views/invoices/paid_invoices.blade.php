@extends('layouts.master')
@section("title")
الفواتير
@endsection
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/  الفواتير المدفوعه </span>
        </div>
    </div>

</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">

    <!--div-->
    <div class="col-xl-12">
        <div class="card mg-b-20">

            <div class="card-body">
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
                                <th class="border-bottom-0"> العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $number = 0 ?>
                            @foreach($invoices as $invoice)
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
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> العمليات
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{route('invoiceedit',['id'=>$invoice->id])}}">تعديل</a>
                                            <a class="dropdown-item" href="{{route('invoice.destroy',['id'=>$invoice->id])}}">حذف</a>
                                            <a class="dropdown-item" href="{{route('invoice.show',['id'=>$invoice->id])}}">نحديث الحاله</a>
                                            <a class="dropdown-item" href="{{route('invoice_archive',['id'=>$invoice->id])}}"> ارشفه الفاتوره</a>
                                            <a class="dropdown-item" href="{{route('print_invoice',['id'=>$invoice->id])}}"> طباعه الفاتوره </a>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--/div-->


</div>

<!-- row closed -->
<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
@endsection
