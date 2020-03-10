@extends('back-end.layout.app')
@php

    $pageTitle = "تعديل حساب اليوم" ;
 @endphp  
@section('title')
    {{ $pageTitle }}
@endsection

@section('content')

    @component('back-end.layout.header')
        @slot('nav_title')
            {{ $pageTitle }}
           
        @endslot
    @endcomponent

        @component('back-end.shared.create')
        <form id="defaultForm" method="post" class="form-horizontal ls_form" action="{{ route($routeName.'.update' , ['id' => $row]) }}"
                    data-bv-message="This value is not valid"
                    data-bv-feedbackicons-valid="fa fa-check"
                    data-bv-feedbackicons-invalid="fa fa-bug"
                    data-bv-feedbackicons-validating="fa fa-refresh"
                    enctype="multipart/form-data"
                    >  
                    @csrf
                    {{method_field('PUT')}}
                @include('back-end.'.$folderName.'.form')  
                  
                @php $input = "date"; @endphp
                <div class="form-group">
                    <label class="col-lg-3 control-label">تاريخ</label>
                    <div class="col-lg-2">
                        <input type="date" class="form-control" name="{{ $input }}" value="{{ isset($row) ? $row->{$input} : '' }}" />
                        @error($input)
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                        <div class="col-lg-9 col-lg-offset-3">
                            <button type="submit" class="btn btn-primary" onclick="myFunction()">تعديل</button>
                        </div>
                    </div>
            </form>  
        @endcomponent                    
@endsection
@push('css')
      <!-- Responsive Style For-->
  <link href="{{asset('panel/assets/css/rtl-css/responsive-rtl.css')}}" rel="stylesheet">
  <!-- Responsive Style For-->
  <link rel="stylesheet" href="{{asset('panel/assets/css/rtl-css/plugins/summernote-rtl.css')}}">
  <!-- Custom styles for this template -->


    <!-- Plugin Css Put Here -->
  
    <link rel="stylesheet" href="{{asset('panel/assets/css/rtl-css/plugins/fileinput-rtl.css')}}">
@endpush
@push('js')
     <!--Upload button Script Start-->
   <script src="{{asset('panel/assets/js/fileinput.min.js')}}"></script>
   <!--Upload button Script End-->

<!--Auto resize  text area Script Start-->
<script src="{{asset('panel/assets/js/jquery.autosize.js')}}"></script>
 <!--Auto resize  text area Script Start-->
<script src="{{asset('panel/assets/js/pages/sampleForm.js')}}"></script>


<!-- summernote Editor Script For Layout start-->
<script src="{{asset('panel/assets/js/summernote.min.js')}}"></script>
<!-- summernote Editor Script For Layout End-->

<!-- Demo Ck Editor Script For Layout Start-->
<script src="{{asset('panel/assets/js/pages/editor.js')}}"></script>
<!-- Demo Ck Editor Script For Layout ENd-->
@endpush