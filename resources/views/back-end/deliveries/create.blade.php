@extends('back-end.layout.app')
@php $pageTitle = "إضافه موظف توصيل " @endphp  
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
            <form id="defaultForm" method="post" class="form-horizontal ls_form" action="{{ route($routeName.'.store') }}"
               
                enctype="multipart/form-data"
                >  
                @csrf
                @include('back-end.'.$folderName.'.form')  
                <div class="form-group">
                        <div class="col-lg-9 col-lg-offset-3">
                            <button type="submit" class="btn btn-primary" onclick="myFunction()">إضافة</button>
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
    <script src="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>
<link href="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>
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
<script>
    var timepicker = new TimePicker('time', {
      lang: 'en',
      theme: 'dark'
    });
    timepicker.on('change', function(evt) {
      
      var value = (evt.hour || '00') + ':' + (evt.minute || '00');
      evt.element.value = value;
    
    });
    
    </script>
    <script>
        var timepicker2 = new TimePicker('time2', {
          lang: 'en',
          theme: 'dark'
        });
        timepicker2.on('change', function(evt) {
          
          var value = (evt.hour || '00') + ':' + (evt.minute || '00');
          evt.element.value = value;
        
        });
        
        </script>
@endpush