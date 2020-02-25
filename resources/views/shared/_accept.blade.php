@can('accept', $model)
    <a title="Mark this question as best answer" 
        class="{{ $model->status }} mt-2"
        onclick="event.preventDefault(); document.getElementById('accept-answer-{{ $model->id }}').submit();">
    <i class="fa fa-check fa-2x"></i>
    </a>
    <form action="{{ route('answer.accept', $model->id) }}" method="POST" id="accept-answer-{{ $model->id }}">
        @csrf
    </form>
@else    
    @if ($model->is_best) 
        <a title="Mark this question as best answer" class="{{ $model->status }} mt-2">
            <i class="fa fa-check fa-2x"></i>
        </a>
    @endif
@endcan