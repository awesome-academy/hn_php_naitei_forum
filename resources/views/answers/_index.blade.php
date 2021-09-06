<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h2>{{ $question->answers . __('answer.title') }}</h2>
                </div>
                <hr>
                @include('layouts._message')
                @foreach ($answers as $answer)
                    <div class="media">
                        <div class="d-flex flex-column vote-controls">
                            <a>
                                <i class="fas fa-caret-up fa-3x"></i>
                            </a>
                            <span class="votes-count">
                            {{ $answer->votes_count }}
                            </span>
                            <a>
                                <i class="fas fa-caret-down fa-3x"></i>
                            </a>
                            @can('accept', $answer)
                                <a>
                                    <i class="fas fa-check fa-2x"></i>
                                </a>
                            @else
                                @if ($answer->is_best)
                                    <a>
                                        <i class="fas fa-check fa-2x"></i>
                                    </a>
                                @endif
                            @endcan
                        </div>
                        <div class="media-body">
                            {{ $answer->content }}
                            <div class="row">
                                <div class="mt-3">
                                    @can('update-answer', $answer)
                                        <a href="{{ route('answers.edit', $answer->id) }}"
                                            class="btn btn-sm btn-outline-info">{{ __('question.edit') }}</a>
                                    @endcan
                                    @can('delete-answer', $answer)
                                        <form class="form-delete" action="{{ route('answers.destroy', $answer->id) }}"
                                            method="POST">
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
                        </div>
                        <div class="mt-auto float-right ">
                            <span class="text-muted"> {{ __('question.answered') . $answer->created_at->diffForHumans() . __('question.who') }}</span>
                            <a href="">{{ $answer->user->name }}</a>
                        </div>
                    </div><hr>
                @endforeach
            </div>
        </div>
    </div>
</div>
