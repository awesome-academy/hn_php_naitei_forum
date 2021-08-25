@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>{{ __('question.title') }}</h2>
                        <div class="ml-auto">
                            <a href="{{ route('questions.create' )}}" class="btn btn-outline-secondary">{{ __('question.add-question') }}</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('layouts._message')
                    @foreach ($questions as $q)
                        <div class="media">
                            <div class="d-flex flex-column counters">
                                <div class="vote">
                                    <strong>{{ ($q->up_vote + $q->down_vote) }}</strong>
                                    {{ __('question.vote') }}
                                </div>
                                <div class="status {{ $q->status }}">
                                    <strong>{{ $q->answers }}</strong>
                                    {{ __('question.answer') }}
                                </div>
                                <div class="view">
                                    {{ $q->views . " " . __('question.view') }}
                                </div>
                            </div>
                            <div class="media-body">
                                <div class="d-flex align-items-center">
                                    <h3 class="mt-0"><a href="">{{ $q->title }}</a></h3>
                                    <div class="ml-auto">
                                        @can('update-question', $q)
                                            <a href="{{route('questions.edit', $q->id)}}" class="btn btn-sm btn-outline-info">{{ __('question.edit') }}</a>
                                        @endcan
                                        @can('delete-question', $q)
                                            <form class="form-delete" action="{{route('questions.destroy', $q->id)}}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-danger submit_del"
                                                data-confirm="{{ __('question.confirmSentence') }}">
                                                  {{ __('question.delete') }}
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </div>
                                <p class="lead">
                                    {{ __('question.asked-by') }} <a href="">{{ $q->user->name }}</a>
                                    <small class="text-muted">{{ $q->created_at }}</small>
                                </p>
                                {{ $q->content }}
                            </div>
                        </div>
                        <hr>
                    @endforeach
                    <div class="text-center">
                        {{ $questions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
