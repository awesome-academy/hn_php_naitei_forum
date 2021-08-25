@csrf
<div class="form-group">
    <label for="quesiton-title">{{ __('question.tag') }}</label><br>
    <select class="multi-tag" name="tags[]" multiple="multiple" data-placeholder="{{ __('question.option-tag') }}">
        @foreach ($tags as $item)
            <option value="{{ $item->id }}">{{ $item->title }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="quesiton-title">{{ __('question.form-title') }}</label>
    <input type="text" name="title" id="question-title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }} "
        value="{{ old('title', $question->title) }}"
    />
    @if ($errors->has('title'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('title')}}</strong>
        </div>
    @endif
</div>
<div class="form-group">
    <label for="quesiton-content">{{ __('question.form-content') }}</label><br>
    <textarea name="content" id="question-content" rows="10" class="form-control
        {{ $errors->has('content') ? 'is-invalid' : '' }}">{{ old('content', $question->content) }}
    </textarea>
    @if ($errors->has('content'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('content')}}</strong>
        </div>
    @endif
</div>
<div class="form-group">
    <button id="submit-form-add" type="submit" class="btn btn-outline-primary btn-lg">{{ $buttonText }}</button>
</div>
