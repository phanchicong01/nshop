<?php
/**
 * Created by Chí Công
 * User: phanchicong01@gmail.com
 * Date: 06-Dec-16
 * Time: 10:51
 */
?>
@if (Session::has('flash_level'))
    @if(Session::get('flash_level') == 'error_msg')
        <div class="alert alert-danger alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <div class="{!! Session::get('flash_level') !!}">
                {!! Session::get('flash_messages') !!}
            </div>
        </div>
@section('javascript')
    <script>
        $(document).ready(function () {
            $('form').find('input').keyup(function () {
                $('form').find(".alert-danger").slideUp(500) ;
            });
        });
    </script>
@endsection
@else
    <div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <div class="{!! Session::get('flash_level') !!}">
            {!! Session::get('flash_messages') !!}
        </div>
    </div>
@endif
@endif
