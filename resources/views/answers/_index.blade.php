<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h2>{{ $answersCount . " " . str_plural('answer', $answersCount) }}</h2>
                </div>
                <hr>
                @include('layouts._messages')
                @foreach ($answers as $answer)
                    <div class="media">
                        <div class="d-flex flex-column vote-controls">
                            <a title="This question is useful" class="vote-up top">
                                <i class="fa fa-caret-up fa-3x"></i>
                            </a>
                            <span class="votes-count">
                                123
                            </span>
                            <a title="This question us useless" class="vote-down off">
                                <i class="fa fa-caret-down fa-3x"></i>
                            </a>
                            @can('accept', $answer)
                                <a title="Mark this question as best answer" 
                                    class="{{ $answer->status }} mt-2"
                                    onclick="event.preventDefault(); document.getElementById('accept-answer-{{ $answer->id }}').submit();">
                                <i class="fa fa-check fa-2x"></i>
                                </a>
                                <form action="{{ route('answer.accept', $answer->id) }}" method="POST" id="accept-answer-{{ $answer->id }}">
                                    @csrf
                                </form>
                            @else    
                                @if ($answer->is_best) 
                                    <a title="Mark this question as best answer" class="{{ $answer->status }} mt-2">
                                        <i class="fa fa-check fa-2x"></i>
                                    </a>
                                @endif
                            @endcan
                        </div>
                        <div class="media-body">
                            {!! $answer->body_html !!}
                            <div class="row">
                                <div class="col-4">
                                    <div class="ml-auto">
                                        @can ('update', $answer)
                                            <a href="{{ route('questions.answers.edit', [$question->slug, $answer->id]) }}" class="btn btn-outline-primary">Edit</a>
                                        @endcan
                                        
                                        @can ('delete', $answer)
                                            <form action="{{ route('questions.answers.destroy', [$question->slug, $answer->id]) }}" class="form-delete" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you shure to delete?')">Delete</button>
                                            </form>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                            <div class="float-right">
                                <span class="text-muted">Answered <strong>{{ $answer->created_date }}</strong></span>
                                <div class="media mt-2">
                                    <a href="{{ $answer->user->url }}" class="pr-2">
                                        <img src="{{ $answer->user->avatar }}">
                                    </a>
                                    <div class="media-body mt-1">
                                        <a href="{{ $answer->user->url }}">{{ $answer->user->name }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>