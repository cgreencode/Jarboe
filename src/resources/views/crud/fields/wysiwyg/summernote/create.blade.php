<label class="label">
    {{ $field->title() }}
    @include('jarboe::crud.fields.wysiwyg.summernote.inc.translatable_locales_selector')
</label>

@if ($field->isTranslatable())
    @foreach ($field->getLocales() as $locale => $title)
        <label class="input {{ $errors->has($field->name() .'.'. $locale) ? 'state-error' : '' }}">
            <div class="locale-field locale-tab-{{ $locale }} locale-field-{{ $field->name() }} locale-field-{{ $field->name() }}-{{ $locale }}"
                 style="{{ $field->isCurrentLocale($locale) ? '' : 'display:none;' }}">
                <textarea class="summernote-{{ $field->name() }}-{{ $locale }}" name="{{ $field->name() }}[{{ $locale }}]" style="display: none;">{!! $field->oldOrDefault($locale) !!}</textarea>
                @include('jarboe::crud.fields.wysiwyg.summernote.inc.error_messages', [
                    'messages' => $errors->get($field->name() .'.'. $locale)
                ])
            </div>
            @include('jarboe::crud.fields.wysiwyg.summernote.inc.styles_and_scripts', compact('field', 'locale'))
        </label>
    @endforeach
@else
    <label class="input {{ $errors->has($field->name()) ? 'state-error' : '' }}">
        <textarea class="summernote-{{ $field->name() }}-default" name="{{ $field->name() }}" style="display: none;">{!! $field->oldOrDefault() !!}</textarea>
        @include('jarboe::crud.fields.wysiwyg.summernote.inc.error_messages', [
            'messages' => $errors->get($field->name())
        ])
        @include('jarboe::crud.fields.wysiwyg.summernote.inc.styles_and_scripts', [
            'field' => $field,
            'locale' => 'default',
        ])
    </label>
@endif

@push('scripts')
    <script>
      $(document).on('click', 'label.translation-{{ $field->name() }}-locale-label', function(){
          $('.locale-field-{{ $field->name() }}').hide();
          $('.locale-field-{{ $field->name() }}-'+ $(this).data('locale')).show();
      });
    </script>
@endpush
