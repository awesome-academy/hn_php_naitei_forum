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
                            <a>
                                <i class="fas fa-caret-up fa-3x"></i>
                            </a>
                            <span class="votes-count">
                                {{ $question->votes_count }}
                            </span>
                            <a>
                                <i class="fas fa-caret-down fa-3x"></i>
                            </a>
                            <a>
                                <i class="fas fa-star fa-1x"></i>
                                <span class="favorites-count">{{ $question->favorites_count }}</span>
                            </a>
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
