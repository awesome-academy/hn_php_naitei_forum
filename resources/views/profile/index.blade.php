@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10 mt-5 pt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4 bg-info rounded-left">
                                <div class="card-block text-center text-white">
                                    <i class="fas fa-user-tie fa-7x mt-5"></i>
                                    <p>Web Developer</p>
                                    <i class="far fa-edit fa-2x"></i>
                                </div>
                            </div>
                            <div class="col-sm-8 bg-white rounded-right">
                                <form action="{{ route('change-profile') }}" method="POST">
                                    @csrf
                                    <div class="input-group input-group-lg mt-2">
                                        <span class="input-group-text" id="inputGroup-sizing-lg">{{ trans('profile.email') }}</span>
                                        <input value="{{ Auth::user()->email }}" type="text" readonly class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
                                    </div>
                                    <div class="input-group input-group-lg mt-3">
                                        <span class="input-group-text" id="inputGroup-sizing-lg">{{ trans('profile.username') }}</span>
                                        <input value="{{ Auth::user()->name }}" name="username" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
                                    </div>
                                    <div class="input-group input-group-lg mt-3">
                                        <span class="input-group-text" id="inputGroup-sizing-lg">{{ trans('profile.old_password') }}</span>
                                        <input name="old_password" type="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
                                    </div>
                                    <div class="input-group input-group-lg mt-3">
                                        <span class="input-group-text" id="inputGroup-sizing-lg">{{ trans('profile.new_password') }}</span>
                                        <input name="new_passwword" type="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
                                    </div>
                                    <div class="input-group input-group-lg mt-3">
                                        <span class="input-group-text" id="inputGroup-sizing-lg">{{ trans('profile.confirm_password') }}</span>
                                        <input name="confirm_password" type="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
                                    </div>
                                    <hr class="bg-primary">
                                    <div class="d-flex float-right">
                                        <button type="button" class="btn btn-secondary">{{ trans('profile.cancel') }}</button>
                                        <button type="submit" class="btn btn-primary ml-2">{{ trans('profile.save') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
