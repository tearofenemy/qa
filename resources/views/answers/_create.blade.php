<div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3>Put your answer</h3>
                    </div>
                    <hr>
                    <form action="{{ route('questions.answers.store', $question->slug) }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <textarea class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" name="body" rows="7"></textarea>
                            @if ($errors->has('body'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('body') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-outline-primary">Reply</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>