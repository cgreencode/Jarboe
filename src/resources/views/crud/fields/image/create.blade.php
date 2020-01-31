<label class="label">{{ $field->title() }}</label>

<div class="input-block" style="display: flex;">
    <div class="image-left-part">
        <img src="/vendor/jarboe/img/placeholder.png">
    </div>

    @include('jarboe::crud.fields.image.inc.modal')

    <div class="image-right-part">
        <div class="input input-file {{ $errors->has($field->name()) ? 'state-error' : '' }}">
            <span class="button">
                <input type="file"
                       name="{{ $field->name() }}[file]"
                       onchange="onImageUpload_{{ $field->name() }}(this)"
                       accept="image/*">
                {{ __('jarboe::fields.image.browse') }}
            </span>
            <input type="text"
                   placeholder="{{ $field->getPlaceholder() }}"
                   readonly="readonly">
        </div>
        <div class="image-manipulate">
            <a href="javascript:void(0);" class="btn btn-default cropper-modal-open">Open</a>
            <a href="javascript:void(0);" class="btn btn-danger image-remove"><i class="fa fa-times"></i></a>
        </div>

        <input type="hidden" name="{{ $field->name() }}[sources][original]">
        <input type="hidden" name="{{ $field->name() }}[sources][cropped]">
        <input type="hidden" name="{{ $field->name() }}[crop][width]" class="crop-width">
        <input type="hidden" name="{{ $field->name() }}[crop][height]" class="crop-height">
        <input type="hidden" name="{{ $field->name() }}[crop][x]" class="crop-x">
        <input type="hidden" name="{{ $field->name() }}[crop][y]" class="crop-y">
    </div>
</div>




@pushonce('style_files', <style>

    div.field-modal {
        box-sizing:border-box;
        margin:initial;
        padding: initial;
    }

    div.field-modal .modal-dialog {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
    div.field-modal .modal-dialog .modal-content {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
    div.field-modal .modal-dialog .modal-content .modal-header {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        padding: 15px;
    }
    div.field-modal .modal-dialog .modal-content .modal-body {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        padding: 20px;
    }




    .input-block .field-modal * {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
    @media (min-width: 768px) {
        .input-block .field-modal .modal-dialog {
            width:600px;
            margin: 30px auto
        }
        .input-block .field-modal .modal-content {
            -webkit-box-shadow: 0 5px 15px rgba(0,0,0,.5);
            box-shadow: 0 5px 15px rgba(0,0,0,.5)
        }
        .input-block .field-modal .modal-sm {
            width: 300px
        }
    }
    @media (min-width: 992px) {
        .input-block .field-modal .modal-lg {
            width:900px
        }
    }



    .image-left-part {
        float: left;
        margin-right: 10px;
        max-width: 50%;
    }
    .image-left-part img {
        height: 100px;
    }
    .image-right-part {
        float: left;
        width: 100%;
    }
    .image-right-part .image-manipulate {
        margin-top: 12px;
    }
    .image-right-part .image-manipulate a {
        padding: 3px 8px;
    }
</style>)

@foreach ($errors->get($field->name()) as $message)
    <div class="note note-error">{{ $message }}</div>
@endforeach


@if ($field->isCrop())
    @pushonce('style_files', <link href="/vendor/jarboe/js/plugin/jquery-cropper/cropper.min.css" rel="stylesheet">)
    @pushonce('script_files', <script src="/vendor/jarboe/js/plugin/jquery-cropper/cropper.min.js"></script>)
    @pushonce('script_files', <script src="/vendor/jarboe/js/plugin/jquery-cropper/jquery-cropper.min.js"></script>)
@endif

@push('scripts')
<script>
    $('.image-manipulate a.cropper-modal-open').on('click', function() {
        $(this).closest('.input-block').find('.field-modal').modal('show');
    });

    function onImageUpload_{{ $field->name() }}(ctx) {
        var $wrapper = $(ctx).closest('.input-block');
        $(ctx).parent().next().val(ctx.value);

        var files = ctx.files;
        if (!files || !files.length) {
            return;
        }

        $.each(files, function(index, file) {
            if (!/^image\/\w+$/.test(file.type)) {
                return;
            }

            var $modal = $wrapper.find('.field-modal');

            var reader = new FileReader();
            reader.onload = function(e) {
                $wrapper.find('.image-left-part img').attr('src', e.target.result);
                $modal.find('.image-row-container img').attr('src', e.target.result);
            };
            reader.readAsDataURL(file);

            $modal.modal('show');
            $modal.find('.cropper-init').on('click', function() {
                $wrapper.find('.image-left-part').css('overflow', 'hidden');
                $modal.find('.image-row-container img').cropper({
                    @if ($field->getRatio('width') && $field->getRatio('height'))
                        aspectRatio: {{ $field->getRatio('width') }} / {{ $field->getRatio('height') }},
                    @endif
                    preview:  $wrapper.find('.image-left-part'),
                    viewMode: 2,
                    crop: function(event) {
                        $wrapper.find('.crop-width').val(event.detail.width);
                        $wrapper.find('.crop-height').val(event.detail.height);
                        $wrapper.find('.crop-x').val(event.detail.x);
                        $wrapper.find('.crop-y').val(event.detail.y);
                    },
                });
            });
            $modal.find('.cropper-destroy').on('click', function() {
                $modal.find('.image-row-container img').cropper('destroy');
                $wrapper.find('.crop-width').val(null);
                $wrapper.find('.crop-height').val(null);
                $wrapper.find('.crop-x').val(null);
                $wrapper.find('.crop-y').val(null);
            });
        });
    }
</script>
@endpush
