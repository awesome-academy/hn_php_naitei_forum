@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="d-flex align-items-center">
                            <h2>{{ $question->title }}</h2>
                            <div class="ml-auto">
                                <a href="{{ route('questions.index' )}}" class="btn btn-outline-secondary">{{ __('question.back-to-all') }}</a>
                            </div>
                        </div>
                    </div><hr>
                    <div class="media">
                        <div class="d-flex flex-column vote-controls">
                            <a title="This question is useful"
                                class="vote-up {{ Auth::guest() ? 'off' : '' }}"
                                data-id="{{ $question->id }}"
                                id="vote-question-{{ $question->id }}"
                            >
                                <i class="fas fa-caret-up fa-3x"></i>
                            </a>
                            <form id="up-vote-question-{{ $question->id }}" action="{{ route('vote.question', $question->id) }}" method="POST">
                                @csrf
                                <input type="hidden" value="1" name="vote">
                            </form>
                            <span class="votes-count">
                                {{ $question->up_vote - $question->down_vote }}
                            </span>
                            <a title="This question is not useful"
                                class="vote-down {{ Auth::guest() ? 'off' : '' }}"
                                data-id="{{ $question->id }}"
                                id="vote-question-{{ $question->id }}"
                            >
                                <i class="fas fa-caret-down fa-3x"></i>
                            </a>
                            <form id="down-vote-question-{{ $question->id }}" action="{{ route('vote.question', $question->id) }}" method="POST">
                                @csrf
                                <input type="hidden" value="-1" name="vote">
                            </form>
                            <a title="Click to mark as favorite question (or undo)"
                                class="favorite mt-2 {{ Auth::guest() ? 'off' : ($question->favorite ? 'favorited' : '') }}"
                                data-id="{{ $question->id }}"
                            >
                                <i class="fas fa-star fa-1x"></i>
                                <span class="favorites-count">{{ $question->favorites }}</span>
                            </a>
                            <form id="favorite-question-{{ $question->id }}" action="/questions/{{$question->id}}/favorites" method="POST">
                                @csrf
                                @if ($question->favorite)
                                  @method('DELETE')
                                @endif
                            </form>
                        </div>
                        <div class="media-body">
                            {{ $question->content }}
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-right mt-3">
                        <span class="text-muted"> {{ $question->created_at->diffForHumans() . __('question.who') }}</span>
                        <a href="">{{ $question->user->name}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('answers._index')
    @include('answers._create')
</div>
@endsection
