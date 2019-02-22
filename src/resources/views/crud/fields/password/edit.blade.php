
<label class="label">{{ $field->title() }}</label>
<label class="input {{ $errors->has($field->name()) ? 'state-error' : '' }}">
    @if ($field->hasTooltip())
        <i class="icon-append fa fa-question-circle"></i>
    @endif

    <input type="password" value="{{ $field->hasOld() ? $field->old() : '' }}" name="{{ $field->name() }}" placeholder="{{ $field->oldOrAttribute($model) ? '••••••••' : $field->getPlaceholder() }}">

    @if ($field->hasTooltip())
        <b class="tooltip tooltip-top-right">
            <i class="fa fa-warning txt-color-teal"></i>
            {{ $field->getTooltip() }}
        </b>
    @endif
</label>


@foreach ($errors->get($field->name()) as $message)
    <div class="note note-error">{{ $message }}</div>
@endforeach
