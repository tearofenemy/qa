@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h3>Ask Question</h3>
                        <div class="ml-auto">
                            <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">Back to all questions</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('questions.store') }}" method="post">
                        @csrf
                        @method('post')
                        <div class="form-group">
                            <label for="question-title">Title</label>
                            <input type="text" value="{{ old('title') }}" name="title" id="question-title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" placeholder="Input title">

                            @if ($errors->has('title'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="question-body">Explain your question</label>
                            <textarea name="body" value="{{ old('body') }}" id="question-body" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" placeholder="Input body"></textarea>

                            @if ($errors->has('body'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('body') }}</strong>
                                </div>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary btn-md">Ask Question</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection