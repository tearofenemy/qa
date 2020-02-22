@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h3>All Questions</h3>
                        <div class="ml-auto">
                            <a href="{{ route('questions.create') }}" class="btn btn-outline-secondary">Ask Question</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @include('layouts._messages')
                    @foreach ($questions as $question)
                    
                        <div class="media">
                            <div class="d-flex flex-column counters">
                                <div class="votes">
                                    <strong>{{ $question->votes_count }}</strong> votes
                                </div>
                                <div class="status {{ $question->status }}">
                                    <strong>{{ $question->answers_count }}</strong> {{ str_plural('answer', $question->answers_count) }}
                                </div>
                                <div class="views">
                                    <strong>{{ $question->views }}</strong> views
                                </div>
                            </div>

                            <div class="media-body">
                                <div class="d-flex align-items-center">
                                    <h3 class="mt-0"><a href="{{ $question->url }}">{{ $question->title }}</a></h3>
                                    <div class="ml-auto">
                                        @can ('update', $question)
                                            <a href="{{ route('questions.edit', $question->slug) }}" class="btn btn-outline-primary">Edit</a>
                                        @endcan
                                        
                                        @can ('delete', $question)
                                            <form action="{{ route('questions.destroy', $question->slug) }}" class="form-delete" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you shure to delete?')">Delete</button>
                                            </form>
                                        @endcan
                                    </div>
                                </div>    
                                <p class="lead">
                                    Asked by <a href="{{ $question->user->url }}">{{ $question->user->name }}</a>
                                    <small class="text-muted">{{ $question->date }}</small>
                                </p>
                                {{ str_limit($question->body, 250) }}
                            </div>                        
                        </div>
                        <hr>
                    @endforeach
                    <div class="mx-auto">
                        {{ $questions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection