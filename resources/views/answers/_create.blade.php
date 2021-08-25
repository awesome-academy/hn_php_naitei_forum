<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h2>{{ __('answer.your-answer') }}</h2>
                </div>
                <hr>
                <form action="{{ route('answers.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <textarea rows="7" class="form-control {{ $errors->has('content') ? 'is-invalid' : ''}}" name="content"></textarea>
                        @if ($errors->has('content'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('content') }}</strong>
                            </div>
                        @endif
                        <input type="hidden" name="questionId" value="{{ $question->id }}">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-outline-primary">{{ __('answer.submit-your-answer') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
