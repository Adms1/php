@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card p-10">
                <div class="card-body row justify-content-center">
                    <div class="col-sm-12">
                        <div class="text-center">
                            <img src="{{ asset('images/middle-icon.png') }}" width="100px">
                        </div>
                        <div>
                            <span id="otp" val="{{ Session::get('otp') }}" style="display: none;"></span>
                            <div class="form-group">
                                <div class="text-center font-18">
                                    Please enter varification code 
                                    <br>
                                    sent to 
                                    <span id="mobile_num" class="weight-600 mb-20"><b>{{$tutor->TutorPhoneNumber}}</b></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <input name="txtOTP" type="text" id="txtOTP" class="form-control text-center" placeholder="Verification Code">
                            </div>
                            <div class="help-block verification-error"></div>
                            <div class="form-group text-center mb-20">
                                <input type="submit" name="btnVerify" value="{{ trans('admin.ca_verify_code') }}" id="btnVerify" tabindex="2" class="btn btn-primary">
                            </div>
                            <div class="form-group text-center">
                                <input type="button" class="btn btn-primary" id="btnresend" name="btnresend" value="{{ trans('admin.ca_resend_code') }}">
                            </div>
                        </div>
                        <div class="success-block otp-success"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        /**** Ajax call to re-send otp ****/ 
        $('body').on('click', '#btnresend', function(){
            var mobile = {{Session::get('mobile')}};
            $("#ajax_loader").css("display", "block");
            $('.verification-error').html('');
            $('.otp-success').html('');
            success-block
            $.ajax({
                url:"{{route('resendotp')}}",
                type:'POST',
                dataType:'json',
                data:{'TutorPhoneNumber':mobile},
                success:function(data) {
                    $("#ajax_loader").css("display", "none");
                    if (data.success) {
                        $('#txtOTP').empty();
                        $('#otp').attr('val', data.data);
                        $('.otp-success').html("{{ trans('auth.otp_success') }}")
                    }
                },
            });
        });

        /**** verify otp then active tutor ****/ 
        $('body').on('click', '#btnVerify', function(){
            var otp = $("#otp").attr('val');
            var txtOTP = $("#txtOTP").val();
            if (otp == txtOTP) {
                window.location.href = "{{route('active_tutor', Session::get('tutor_id'))}}";
            } else {
                $('.verification-error').html("{{ trans('auth.otp_failed') }}")
            }
        });
    });
</script>
@stop
