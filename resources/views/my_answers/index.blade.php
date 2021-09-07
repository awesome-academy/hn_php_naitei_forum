@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form class="d-flex" action="{{ route('my-answers') }}" method="GET">
                <div class="form-group">
                    <input type="text" class="form-control" name="query" placeholder="Enter answer content ..." value="{{ request()->input('query') }}">
                    <span class="text-danger">@error('query'){{ $message }} @enderror</span>
                </div>
                <div class="form-group ml-2">
                    <button type="submit" class="btn btn-primary">{{ trans('auth.search') }}</button>
                </div>
            </form>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>{{ __('question.title-my-answer') }}</h2>
                    </div>
                </div>
                <div class="card-body">
                    @include('layouts._message')
                    @foreach ($answers as $answer)
                        <div class="media">
                            <div class="d-flex flex-column counters">
                                <div class="vote mt-5">
                                    <strong>{{ $answer->votes_count }}</strong>
                                    {{ __('question.vote') }}
                                </div>
                            </div>
                            <div class="media-body">
                                <div class="align-items-center">
                                    <p class="lead">
                                        {{ trans('question.form-title') }}: <a href="{{ route('questions.show', $answer->question_id) }}">{{ $answer->question->title }}</a>
                                    </p>
                                    <p class="lead">
                                        {{ trans('answer.title') }}: <a href="">{{ $answer->content }}</a>
                                    </p>
                                </div>
                                <p class="lead">
                                    {{ __('question.asked-by') }} <a href="">{{ $answer->user->name }}</a>
                                    <small class="text-muted">{{ $answer->created_at }}</small>
                                </p>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                    <div class="text-center">
                        {{ $answers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
