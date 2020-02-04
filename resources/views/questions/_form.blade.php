@csrf
<div class="form-group">
    <label for="question-title">Title</label>
    <input type="text" value="{{ old('title', $question->title) }}" name="title" id="question-title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" placeholder="Input title">

    @if ($errors->has('title'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('title') }}</strong>
        </div>
    @endif
</div>

<div class="form-group">
    <label for="question-body">Explain your question</label>
    <textarea name="body" id="question-body" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" placeholder="Input body">{{ old('body', $question->body) }}</textarea>

    @if ($errors->has('body'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('body') }}</strong>
        </div>
    @endif
</div>
<button type="submit" class="btn btn-primary btn-md">{{ $btnText }}</button>