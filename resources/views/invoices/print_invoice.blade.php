@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
                <!-- breadcrumb -->
                <div class="breadcrumb-header justify-content-between">
                    <div class="my-auto">
                        <div class="d-flex">
                            <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ طباعه الفاتوره</span>
                        </div>
                    </div>
                    
                </div>
                <!-- breadcrumb -->
@endsection
@section('content')
                <!-- row -->
                <div class="row row-sm">
                    <div class="col-md-12 col-xl-12">
                        <div class=" main-content-body-invoice" >
                            <div class="card card-invoice" id="print">
                                <div class="card-body">
                                    
                                    <div class="row mg-t-20">
                                        
                                        <div class="col-md" >
                                            <label class="tx-gray-600 ">معلومات الفاتوره </label>
                                            <p class="invoice-info-row mt-3"><span> رقم الفاتوره</span> <span>{{$data->invoice_number}}</span></p>
                                            <p class="invoice-info-row"><span>تاريخ الاصدار :</span> <span>{{$data->invoice_Date}}</span></p>
                                            <p class="invoice-info-row"><span>تاريخ الاستحقاق :</span> <span>{{$data->due_date}}</span></p>
                                            <p class="invoice-info-row"><span>القسم :</span> <span>{{$data->sections->section_name}}</span></p>
                                        </div>
                                    </div>
                                    <div class="table-responsive mg-t-40">
                                        <table class="table table-invoice border text-md-nowrap mb-0">
                                            <thead>
                                                <tr>
                                                    
                                                    <th class="w-25">العدد </th>
                                                    <th class="w-25">المنتج </th>
                                                    <th >قيمه التحصيل</th>
                                                    <th >قيمه العموله</th>
                                                    <th >الاجمالى</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                 <tr>
                                                    <td>1</td>
                                                    <td >{{$data->product}}</td>
                                                    <td >{{$data->Amount_collection}}</td>
                                                    <td >{{$data->Amount_commission}}</td>
                                                    <td > <?php echo $data->Amount_collection + $data->Amount_commission ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="valign-middle" colspan="2" rowspan="4">
                                                        <div class="invoice-notes">
                                                            <label class="main-content-label tx-13">Notes</label>
                                                           <p> {{$data->note}}
                                                           </p>
                                                        </div><!-- invoice-notes -->
                                                    </td>
                                                    <td class="tx-right"> الاجمالى </td>
                                                     <td > <?php echo $data->Amount_collection + $data->Amount_commission ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="tx-right">الضريبه({{$data->Rate_VAT}} )</td>
                                                    <td class="tx-right" colspan="2">{{$data->Value_VAT}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="tx-right">الخصم</td>
                                                    <td class="tx-right" colspan="2">{{$data->Discount}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="tx-right tx-uppercase tx-bold tx-inverse"> العموله بعد الضريبه</td>
                                                    <td class="tx-right" colspan="2">
                                                        <h4 class="tx-primary tx-bold">{{$data->Total}}</h4>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr class="mg-b-40">
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div><!-- COL-END -->
                    <div class="w-100 d-flex flex-direction-row justify-content-end ml-3 mb-5 m-3">
                        <button class="btn btn-primary " id="print_Button" onclick="printDiv()">طباعة</button>
                    </div>
                </div>
                <!-- row closed -->
            </div>
            <!-- Container closed -->
        </div>
        <!-- main-content closed -->
@endsection
@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>


    <script type="text/javascript">
        function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }

    </script>
@endsection
