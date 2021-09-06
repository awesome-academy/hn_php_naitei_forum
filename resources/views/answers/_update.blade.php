@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <div class="d-flex align-items-center">
                                <h2>{{ __('answer.title-update-form') }}</h2>
                                <div class="ml-auto">
                                    <a href="{{ route('questions.show', $answerToUpdate->question_id) }}" class="btn btn-outline-secondary">{{ __('answer.back') }}</a>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <form action="{{ route('answers.update', $answerToUpdate->id) }}"
                            method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <textarea rows="7" class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}"
                                    name="content">{{ old('content', $answerToUpdate->content) }}</textarea>
                                @if ($errors->has('content'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-outline-primary">{{ __('answer.update-button') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
