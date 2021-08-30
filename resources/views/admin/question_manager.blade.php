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
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>{{ trans('admin.id') }}</th>
                        <th>{{ trans('admin.title') }}</th>
                        <th>{{ trans('admin.created_by') }}</th>
                        <th class="text-center">{{ trans('admin.status') }}</th>
                        <th class="text-center">{{ trans('admin.action') }}</th>
                    </tr>
                </thead>
                @foreach ($questions as $question)
                <tbody>
                    <tr>
                        <th>{{ $question->id }}</th>
                        <th>{{ $question->title }}</th>
                        <th>{{ $question->user->name }}</th>
                        <th><button type="button" class="{{ $question->active ? 'btn-outline-success' : 'btn-outline-secondary' }} btn" disabled>{{ $question->active ? __('question.active') : __('question.inactive') }}</button></th>
                        <th class="d-flex justify-content-between align-items-center" style="border-top:0">
                            <span>
                                <form class="form-delete" action="{{route('active-question', $question->id)}}" method="POST">
                                    @csrf
                                    <button class="btn btn-success submit_del" type="submit">{{ __('question.active') }}</button>
                                </form>
                            </span>
                            <span class="mx-1">
                                <form class="form-delete" action="{{route('inactive-question', $question->id)}}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-warning submit_del">{{ __('question.inactive') }}</button>
                                </form>
                            </span>
                            <span>
                                <form class="form-delete" action="{{route('delete-question', $question->id)}}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger submit_del">{{ __('question.delete') }}</button>
                                </form>
                            </span>
                        </th>
                    </tr>
                </tbody>
            @endforeach
            </table>
            <div class="text-center">
                {{ $questions->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
