@extends('layouts.master')
@section("title")
الاقسام
@endsection
@section('css')
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
            <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/  الاقسام</span>
        </div>
    </div>

</div>

<!-- breadcrumb -->
@endsection
@section                                                                                                              ('content')
<!-- row -->
<div class="row">
    @if ($errors->has('section_name'))
    <span class="text-danger">{{ $errors->first('section_name') }}</span>
    @endif
    <!--div-->
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <a class="modal-effect btn btn-primary" data-effect="effect-scale" data-toggle="modal" href="#modaldemo1">اضافه قسم</a>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>


            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table key-buttons text-md-nowrap">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">العدد</th>
                                <th class="border-bottom-0"> الاسم</th>
                                <th class="border-bottom-0"> الوصف</th>
                                <th class="border-bottom-0"> العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $number = 0 ?>
                            @foreach                                      ($sections as $section)
                            <?php $number++ ?>
                            <tr>
                                <td>{{ $number}}</td>
                                <td>{{$section->section_name}}</td>
                                <td>{{$section->description}}</td>
                                <td>


                                    <a data-id="{{$section->id}}" data-section_name="{{$section->section_name}}" data-description="{{$section->description}}"
                                        href="#modaldemo2" class="modal-effect btn btn-primary text-light" data-effect="effect-scale" data-toggle="modal">تعديل</a>

                                    <a data-id="{{$section->id}}" data-section_name="{{$section->section_name}}"
                                        href="#modaldemo3" class="modal-effect btn btn-danger text-light" data-effect="effect-scale" data-toggle="modal">حذف</a>

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
    <!-- Basic modal -->
    <div class="modal" id="modaldemo1">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">اضافه قسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>

                <form class="mr-2" action="{{route('sections.store')}}" method="POST">
                  @csrf                                                                                                                                              <!-- Laravel CSRF token for form security -->

                    <div class="form-group">
                        <label for="name">الاسم:</label>
                        <input type="text" id="name" name="section_name" class="form-control" required />
                    </div>

                    <div class="form-group d-none">

                        <input type="text" name="created_by" class="form-control" value="{{Auth::user()->name}}" />
                    </div>

                    <div class="form-group">
                        <label for="description">الوصف:</label>
                        <textarea id="description" name="description" class="form-control" rows="4"></textarea>
                    </div>

                    <div class="d-flex justify-content-end my-3 ml-2">
                        <button type="submit" class="btn btn-success ml-2 ">تاكيد</button>

                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- End Basic modal -->
    <!-- Basic modal -->
    <div class="modal" id="modaldemo2">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">تعديل القسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form class="mr-2" action="{{route('sections.update')}}" method="POST">
                       @csrf                        <!-- Laravel CSRF token for form security -->

                        <div class="form-group">
                            <label for="section_name">الاسم:</label>
                            <input type="text" id="section_name" name="section_name" class="form-control" />
                        </div>

                        <div class="form-group d-none">
                            <input type="number" name="id" id="id" class="form-control" />
                        </div>

                        <div class="form-group">
                            <label for="description">الوصف:</label>
                            <textarea id="description" name="description" class="form-control" rows="4"></textarea>
                        </div>

                        <div class="d-flex justify-content-end my-3 ml-2">
                            <button type="submit" class="btn btn-primary ml-2 ">حفظ</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Basic modal -->

    <!-- Basic modal -->
    <div class="modal" id="modaldemo3">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">حذف القسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form class="mr-2" action="{{route('sections.destroy')}}" method="POST">
                       @csrf           <!-- Laravel CSRF token for form security -->

                        <div class="form-group">
                            <label for="section_name">الاسم:</label>
                            <input type="text" id="section_name" name="section_name" class="form-control" />
                        </div>

                        <div class="form-group d-none">
                            <input type="number" name="id" id="id" class="form-control" />
                        </div>

                        <div class="d-flex justify-content-end my-3 ml-2">
                            <button type="submit" class="btn btn-danger ml-2 ">حذف</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Basic modal -->

</div>

@endsection
@section    ('js')
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
<script>
    $('#modaldemo2').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)

        var id = button.data('id')
        var section_name = button.data('section_name')
        var description = button.data('description')
        console.log(section_name);
        var model = $(this)

        model.find('.modal-body #id').val(id);
        model.find('.modal-body #section_name').val(section_name);
        model.find('.modal-body #description').val(description);


    })
</script>

<script>
    $('#modaldemo3').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)

        var id = button.data('id')
        var section_name = button.data('section_name')

        var model = $(this)

        model.find('.modal-body #id').val(id);
        model.find('.modal-body #section_name').val(section_name);


    })
</script>
@endsection
