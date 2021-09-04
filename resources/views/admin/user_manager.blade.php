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
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>{{ trans('admin.id') }}</th>
                        <th>{{ trans('admin.user_name') }}</th>
                        <th>{{ trans('admin.email') }}</th>
                        <th>{{ trans('admin.role') }}</th>
                        <th class="text-center">{{ trans('admin.status') }}</th>
                        <th class="text-center">{{ trans('admin.action') }}</th>
                    </tr>
                </thead>
                @foreach ($users as $user)
                <tbody>
                    <tr>
                        <th>{{ $user->id }}</th>
                        <th>{{ $user->name }}</th>
                        <th>{{ $user->email }}</th>
                        <th>{{ $user->role->name }}</th>
                        <th>
                            <button type="button" class="{{ $user->status ? 'btn-outline-success' : 'btn-outline-secondary' }} btn" disabled>
                                {{ $user->status ? __('question.active') : __('question.inactive') }}
                            </button>
                        </th>
                        <th class="d-flex justify-content-between align-items-center" style="border-top:0">
                            <span>
                                <form class="form-delete" action="{{route('active-user', $user->id)}}" method="POST">
                                    @csrf
                                    <button class="btn btn-success submit_del" type="submit">
                                    {{ __('question.active') }}
                                    </button>
                                </form>
                            </span>
                            <span class="mx-1">
                                <form class="form-delete" action="{{route('inactive-user', $user->id)}}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-warning submit_del">
                                    {{ __('question.inactive') }}
                                    </button>
                                </form>
                            </span>
                            <span>
                                <form class="form-delete" action="{{route('delete-user', $user->id)}}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger submit_del">
                                        {{ __('question.delete') }}
                                    </button>
                                </form>
                            </span>
                        </th>
                    </tr>
                </tbody>
            @endforeach
            </table>
            <div class="text-center">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
