@extends('layouts.admin')

@section('content')
@if (session()->has('message'))
    <div>
        <p>
            <h2 class="text-success">{{ session()->get('message') }}</h2>
        </p>
    </div>
@endif

<div class="ml-5  pl-3 row container-fluid col-12 d-flex justify-content-center">
    <div>
		<h3>{{ trans('admin.manager_user') }}</h3>
	</div>
    <div class="col-12 span-3 mt-5">
        <div class="bs-example1 my-2">
            <table class="table">
                <thead>
                    <tr>
                        <th>{{ trans('admin.id') }}</th>
                        <th>{{ trans('admin.user_name') }}</th>
                        <th>{{ trans('admin.email') }}</th>
                        <th>{{ trans('admin.status') }}</th>
                        <th>{{ trans('admin.action') }}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@endsection
