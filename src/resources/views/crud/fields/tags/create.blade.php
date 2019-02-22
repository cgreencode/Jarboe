
<label class="label">{{ $field->title() }}</label>
<label class="input {{ $errors->has($field->name()) ? 'state-error' : '' }}">

    <select class="select-2-{{ $field->name() }} form-control" multiple="multiple" name="{{ $field->name() }}[]">
        @if (!$field->isOptionsHidden())
            @foreach ($field->getOptions() as $id => $value)
                <option value="{{ $value }}" {{ $field->isCurrentOption($value) ? 'selected' : '' }}>{{ $value }}</option>
            @endforeach
        @endif
    </select>

</label>


@foreach ($errors->get($field->name()) as $message)
    <div class="note note-error">{{ $message }}</div>
@endforeach

@pushonce('script_files', <script>
    $(".select-2-{{ $field->name() }}").select2({
        tags: true
    });
</script>)