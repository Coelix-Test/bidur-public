{{--@extends('layouts.app')--}}


    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>סיסמה אבודה?</title>
    <style>
      html {
        height:100%;
      }
      body {
        margin:0;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        padding:24px 24px;
        height:100%;
        font-family: sans-serif;
        direction: rtl;
        position: relative;
        box-sizing: border-box;
      }
      .back {
        position: absolute;
        top:24px;
        right:24px;
        color:#333;
        cursor: pointer;
        font-size: 20px;
      }
      .card-header {
        font-size: 32px;
        font-weight: 700;
        color: #F2C94C;
        margin-bottom: 8px;
        text-align: center;
      }
      .reset-password {

      }
      .reset-password .form-group.row {
        width:100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
      }
      .reset-password label,
      .reset-password input,
      .reset-password button {
        width:100%;
        margin-bottom: 12px;
      }
      .reset-password label {
        text-align: center;
        font-size: 24px;
      }
      .reset-password input {
        outline: none;
        padding: 6px 12px;
        border: 1px solid #333;
        border-radius: 5px;
        font-size: 20px;
        box-sizing: border-box;
      }
      .reset-password button {
        padding:12px 24px;
        background: linear-gradient(285.95deg, #D3A01D 1.57%, #F2C94C 98.82%);
        color:#fff;
        font-size: 18px;
        font-weight: 600;
        border-style: solid;
        border-radius: 10px;
        border-width:2px;
        border-color:#F2C94C;
        outline:none;
        cursor:pointer;
      }
      .reset-password button:hover {
        border-style: solid;
        border-color:#F2C94C;
        color:#F2C94C;
        background: #fff;
      }
    </style>
</head>
<body>

    <div class="container">
      <div class="back" onclick="history.back()">לדף הראשי</div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('לאפס את הסיסמה') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" class="reset-password" action="{{ route('password.email') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('כתובת דוא"ל') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('שלח קישור לאיפוס סיסמה') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>
</html>
