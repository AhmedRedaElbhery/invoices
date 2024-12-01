@extends('layouts.master')
@section('css')
<!--- Internal Select2 css-->
<link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
<!---Internal Fileupload css-->
<link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
<!---Internal Fancy uploader css-->
<link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
<!--Internal Sumoselect css-->
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}" />
<!--Internal  TelephoneInput css-->
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}" />
@endsection
@section('title')
اضافة فاتورة
@stop
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                تعديل فاتورة</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
@if (session()->has('Add'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('Add') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<!-- row -->
<div class="row">

    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                @if                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 (session()->has('success'))
                <div class="alert alert-success"> {{ session('success') }}
                </div>
@endif
                <form action="{{ route('invoices.update') }}" method="post" enctype="multipart/form-data"
                    autocomplete="off">
                    {{ csrf_field() }}
                    {{-- 1 --}}
                    <div class="row">
                        <div class="col">
                            <label for="inputName" class="control-label">رقم الفاتورة</label>

                            <input readonly type="text" class="form-control" id="inputName" name="invoice_number"
                                title="يرجي ادخال رقم الفاتورة" required value="{{$data->invoice_number}}" />
                        </div>

                        <div class="col">
                            <label>تاريخ الفاتورة</label>
                            <input readonly class="form-control fc-datepicker" name="invoice_Date" placeholder="YYYY-MM-DD"
                                type="text" required value="{{$data->invoice_Date}}" />
                        </div>

                        <div class="col">
                            <label>تاريخ الاستحقاق</label>
                            <input readonly class="form-control fc-datepicker" name="due_date" placeholder="YYYY-MM-DD"
                                type="text" required value="{{$data->due_date}}" />
                        </div>

                    </div>

                    {{-- 2 --}}
                    <div class="row">
                        <div class="col">
                            <label for="inputName" class="control-label">القسم</label>
                            <select readonly name="Section" class="form-control SlectBox">
                                @foreach($sections as $section)
                                @if ($data->section_id == $section->id)
                                <option value="{{ $section->id }}" selected>{{ $section->section_name }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="col">
                            <label for="inputName" class="control-label">المنتج</label>
                            <select readonly id="product" name="product" class="form-control">
                                <option value="{{ $data->id }}" selected>{{ $data->product }}</option>
                            </select>
                        </div>

                        <div class="col">
                            <label for="inputName" class="control-label">مبلغ التحصيل</label>
                            <input type="text" class="form-control" id="inputName" name="Amount_collection"
                                value="{{$data->Amount_collection}}" readonly />
                        </div>
                    </div>


                    {{-- 3 --}}
                    <div class="row">

                        <div class="col">
                            <label for="inputName" class="control-label">مبلغ العمولة</label>
                            <input readonly type="text" class="form-control form-control-lg" id="Amount_Commission"
                                name="Amount_Commission"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                required value="{{$data->Amount_commission}}" />
                        </div>

                        <div class="col">
                            <label for="inputName" class="control-label">الخصم</label>
                            <input readonly type="text" class="form-control form-control-lg" id="Discount" name="discount"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                value="{{$data->Discount}}" required />
                        </div>

                        <div class="col">
                            <label for="inputName" class="control-label">نسبة ضريبة القيمة المضافة</label>
                            <select readonly name="rate_vat" id="Rate_VAT" class="form-control">
                                <option value="{{ $data->Rate_VAT }}">{{ $data->Rate_VAT }}</option>
                            </select>
                        </div>

                    </div>

                    {{-- 4 --}}
                    <div class="row">
                        <div class="col">
                            <label for="inputName" class="control-label">قيمة ضريبة القيمة المضافة</label>
                            <input type="text" class="form-control" id="Value_VAT" name="value_vat" readonly value="{{$data->Value_VAT}}" />
                        </div>

                        <div class="col">
                            <label for="inputName" class="control-label">الاجمالي شامل الضريبة</label>
                            <input type="text" class="form-control" id="Total" name="total" readonly value="{{$data->Total}}" />
                        </div>
                    </div>

                    {{-- 5 --}}
                      <div class="row">
                        <div class="col">
                            <label for="exampleTextarea">ملاحظات</label>
                            <textarea class="form-control" id="exampleTextarea" name="note" rows="3" readonly>value="{{$data->note}}"</textarea>
                        </div>
                    </div><br />



                </form>

                <form action="{{route('updatestatus')}}" method="POST">
                  @csrf
                    <input type="text" class="form-control d-none" id="inputName" name="id" value="{{$data->id}}" />
                    <div class="d-flex">
                        <div class="form-group w-50">
                            <label for="selectedInput">Selected Input:</label>
                            <select name="status_number" id="selectedInput" class="form-control">
                                <option value="" disabled="disabled">اختر الحاله</option>
                                <option value="0">مدفوعه</option>
                                <option value="1">مدفوعه جزئيا</option>
                            </select>
                        </div>

                        <div class="col">
                            <label>تاريخ الاستحقاق</label>
                            <input class="form-control fc-datepicker" name="pay_date" placeholder="YYYY-MM-DD"
                                type="text" required />
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection
@section('js')
<!-- Internal Select2 js-->
<script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<!--Internal Fileuploads js-->
<script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
<!--Internal Fancy uploader js-->
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
<!--Internal  Form-elements js-->
<script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
<script src="{{ URL::asset('assets/js/select2.js') }}"></script>
<!--Internal Sumoselect js-->
<script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
<!--Internal  Datepicker js -->
<script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
<!--Internal  jquery.maskedinput js -->
<script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
<!--Internal  spectrum-colorpicker js -->
<script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
<!-- Internal form-elements js -->
<script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>




@endsection
