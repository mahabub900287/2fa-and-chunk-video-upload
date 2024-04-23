@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4">
                <div class="card card-default">
                    <h4 class="card-heading text-center mt-4">Set up Google Authenticator</h4>

                    <div class="card-body" style="text-align: center;">
                        <p>Set up your two factor authentication by scanning the barcode below. Alternatively, you can use
                            the code <strong>{{ $secret }}</strong></p>
                        <div>
                            <img src="data:image/svg+xml;base64,{{ base64_encode($QR_Image) }}" alt="QR Code">
                        </div>
                        <p>You must set up your Google Authenticator app before continuing. You will be unable to login
                            otherwise</p>
                        <div>
                            <a href="{{ route('complete.registration') }}" class="btn btn-primary">Complete Registration</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
