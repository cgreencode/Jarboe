
@if ($field->isRelationField())
    {{ $model && $model->{$field->getRelationMethod()} ? $model->{$field->getRelationMethod()}->{$field->getRelationTitleField()} : '' }}
@else
    {{ $options[$field->getAttribute($model)] ?? '' }}
@endif
