
@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
                <!-- breadcrumb -->
                <div class="breadcrumb-header justify-content-between">
                    <div class="my-auto">
                        <div class="d-flex">
                            <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ معلومات عن الفاتوره</span>
                        </div>
                    </div>
                    
                </div>
                <!-- breadcrumb -->
@endsection
@section('content')
                <!-- row -->
                <div class="row">
                    <div class=" tab-menu-heading">
                        <div class="tabs-menu1">
                        <!-- Tabs -->
                        <ul class="nav panel-tabs main-nav-line">
                            <li><a href="#tab1" class="nav-link active" data-toggle="tab">معلومات الفاتوره</a></li>
                            <li><a href="#tab2" class="nav-link" data-toggle="tab">حالات الدفع</a></li>
                            <li><a href="#tab3" class="nav-link" data-toggle="tab">المرففات</a></li>
                        </ul>
                    </div>
                    </div>
                    <div class="panel-body tabs-menu-body border d-flex justify-content-end w-100">
                        <div class="tab-content w-100">
                            <div class="tab-pane active mt-5 w-100" id="tab1">

                                <table class="table">
                                  <thead>
                                    <tr>
                                      <th>رقم الفاتوره</th>
                                     
                                        <th class="border-bottom-0">تاريخ القاتوره</th>
                                        <th class="border-bottom-0">تاريخ الاستحقاق</th>
                                        <th class="border-bottom-0"> المنتج</th>
                                        <th class="border-bottom-0">القسم</th>
                                        <th class="border-bottom-0">الخصم</th>
                                        <th class="border-bottom-0">نسبه ضريبه</th>
                                        <th class="border-bottom-0">فيمه الضريبه</th>
                                        <th class="border-bottom-0"> قيمه العموله</th>
                                        <th class="border-bottom-0">فيمه التحصيل</th>
                                        <th class="border-bottom-0"> الاجمالى</th>
                                        <th class="border-bottom-0"> الحاله</th>
                                        <th class="border-bottom-0"> الملاحظات</th>

                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <th>{{$invoice->invoice_number}}</th>
                                      <td>{{$invoice->invoice_Date}}</td>
                                      <td>{{$invoice->due_date}}</td>
                                      <td>{{$invoice->product}}</td>
                                      <td>{{$invoice->sections->section_name}}</td>
                                      <td>{{$invoice->Discount}}</td>
                                      <td>{{$invoice->Rate_VAT}}</td>
                                      <td>{{$invoice->Value_VAT}}</td>
                                       <td>{{$invoice->Amount_commission}}</td>
                                       <td>{{$invoice->Amount_collection}}</td>
                                      <td>{{$invoice->Total}}</td>
                                      
                                      <td>@if    ($invoice->Value_Status == 1)
                                           <span class="text-success">{{$invoice->Status}}</span>
                                          @elseif    ($invoice->Value_Status == 2)
                                        <span class="text-danger">{{$invoice->Status}}</span>
                                           @endif
                                      </td>
                                        <td>{{$invoice->note}}</td>
                                       
                                    </tr>
                                    
                                  </tbody>
                                </table>

                               
                            </div>

                            <div class="tab-pane w-100 mt-5" id="tab2">
                                 <table class="table">
                                      <thead>
                                            <tr>
                                              <th>رقم الفاتوره</th>
                                                <th class="border-bottom-0"> المنتج</th>
                                                <th class="border-bottom-0">القسم</th>
                                                <th class="border-bottom-0"> الحاله</th>
                                                <th class="border-bottom-0"> تاريح الدفع</th>
                                                <th class="border-bottom-0"> الملاحظات</th>
                                                <th class="border-bottom-0"> تاريخ الاضافه</th>
                                                <th class="border-bottom-0"> اسم المستخدم</th>

                                            </tr>
                                      </thead>
                                      <tbody>

                                          @foreach($invoicedetails as $invoicedetail)
                                            <tr>
                                                  <th>{{$invoicedetail->invoice_number}}</th>
                                                  <td>{{$invoicedetail->product}}</td>
                                                  <td>{{$invoicedetail->sections->section_name}}</td>
                                      
                                                  <td>@if                ($invoicedetail->value_status == 0)
                                                       <span class="text-success">{{$invoicedetail->status}}</span>
                                                @elseif                ($invoicedetail->value_status == 1)
                                                    <span class="text-warning">{{$invoicedetail->status}}</span>
                                          @elseif                ($invoicedetail->value_status == 2)
                                                    <span class="text-danger">{{$invoicedetail->status}}</span>
                                           @endif        
                                                  </td>
                                                    <td>{{$invoice->Payment_Date}}</td>
                                                    <td>{{$invoice->note}}</td>
                                                    <td>{{$invoicedetail->created_at}}</td>
                                                    <td>{{$invoicedetail->user}}</td>
                                       
                                            </tr>
                                    @endforeach
                                      </tbody>
                                </table>
                            </div>

                            <div class="tab-pane w-100 mt-5" id="tab3">

                                <form enctype="multipart/form-data" class="mb-3" action="{{ route('storeattachment') }}" method="POST">
                               @csrf <!-- Include the CSRF token -->
                                <div class="col-sm-12 col-md-12">
                                    <input type="file" name="pic" class="dropify w-100" accept=".pdf,.jpg,.png,image/jpeg,image/png" data-height="70" />
                                </div>
                                <input type="hidden" name="invoice_number" value="{{ $invoice->invoice_number }}">
                                <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                                <button type="submit" class="btn btn-primary mt-3">تاكيد</button>
                            </form>


                                 <table class="table">
                                  <thead>
                                    <tr>
                                     
                                        <th class="border-bottom-0"> اسم الملف</th>
                                        <th class="border-bottom-0"> قام بالاضافه</th>
                                        <th class="border-bottom-0">تاريخ الاضافه</th>
                                        <th class="border-bottom-0"> العمليات</th>
                                        

                                    </tr>
                                  </thead>
                                  <tbody>

                                      @if($invoiceattachment)
                                      @foreach($invoiceattachment as $item)
                                      
                                    <tr>
                                      <th>{{$item->file_name}}</th>
                                      <td>{{$item->created_by}}</td>
                                      <td>{{$item->created_at}}</td>
                                      <td>
                                          <a class="btn btn-dark text-light" href="{{ route('openfile', ['id' => $invoice->invoice_number , 'filename' => $item->file_name]) }}"> عرض </a>
                                          <a href="{{ route('downloadfile', ['id' => $invoice->invoice_number , 'filename' => $item->file_name]) }}" class="btn btn-success text-light"> تحميل </a>
                                          <a href="{{ route('deletefile', ['id' => $invoice->invoice_number , 'filename' => $item->file_name]) }}" class="btn btn-danger text-light"> حذف </a>
                                      </td>
                                       
                                    </tr>
                                      @endforeach
                                    @endif
                                  </tbody>
                                </table>
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
@endsection
