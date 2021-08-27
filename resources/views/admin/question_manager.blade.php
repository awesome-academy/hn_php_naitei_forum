@extends('layouts.admin')

@section('content')
@if (session()->has('message'))
    <div>
        <p>
            <h2 class="text-success">{{ session()->get('message') }}</h2>
        </p>
    </div>
@endif

<div class="ml-5 pl-3 row container-fluid col-12 d-flex justify-content-center">
    <div>
		<h3>{{ trans('admin.manager_QA') }}</h3>
	</div>
    <div class="col-12 span-3 mt-5">
        <div class="bs-example1 my-2">
            <table class="table">
                <thead>
                    <tr>
                        <th>{{ trans('admin.id') }}</th>
                        <th>{{ trans('admin.title') }}</th>
                        <th>{{ trans('admin.description') }}</th>
                        <th>{{ trans('admin.created_by') }}</th>
                        <th>{{ trans('admin.status') }}</th>
                        <th>{{ trans('admin.action') }}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@endsection
