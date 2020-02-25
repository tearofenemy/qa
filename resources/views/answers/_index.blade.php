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
                            <a title="This answer is useful" 
                                class="vote-up top"
                                onclick="event.preventDefault(); document.getElementById('up-vote-answer-{{ $answer->id }}').submit();">
                                <i class="fa fa-caret-up fa-3x"></i>
                            </a>
                            <form action="/answers/{{ $answer->id }}/vote" method="POST" id="up-vote-answer-{{ $answer->id }}">
                                @csrf
                                <input type="hidden" name="vote" value="1">
                            </form>
                            <span class="votes-count">
                                {{ $answer->votes_count }}
                            </span>
                            <a title="This answer us useless" 
                                class="vote-down off"
                                onclick="event.preventDefault(); document.getElementById('down-vote-answer-{{ $answer->id }}').submit();">
                                <i class="fa fa-caret-down fa-3x"></i>
                            </a>
                            <form action="/answers/{{ $answer->id }}/vote" method="POST" id="down-vote-answer-{{ $answer->id }}">
                                @csrf
                                <input type="hidden" name="vote" value="-1">
                            </form>
                            
                            @include('shared._accept', [
                                'model' => $answer
                            ])
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
                                @include('shared._author', [
                                    'model' => $answer,
                                    'label' => 'Answered'
                                ])
                            </div>
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>