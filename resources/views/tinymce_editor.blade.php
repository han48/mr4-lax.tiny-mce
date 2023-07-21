@php
    $lowerAttributes = strtolower($attributes);

    $readonly = 'false';
    if (Str::contains($lowerAttributes, strtolower('readOnly="true"')) || Str::contains($lowerAttributes, strtolower('readOnly="1"'))) {
        $readonly = 'true';
    }

    $menubar = 'true';
    if (Str::contains($lowerAttributes, strtolower('menubar="false"'))) {
        $menubar = 'false';
    }

    $statusbar = 'true';
    if (Str::contains($lowerAttributes, strtolower('statusbar="false"'))) {
        $statusbar = 'false';
    }

    // TOP: 90px | BOTTOM: 25px
    $height = 115 + $rows * 40 . 'px';

@endphp

<div class="{{ $viewClass['form-group'] }} {!! !$errors->has($errorKey) ? '' : 'has-error' !!}">
    <label for="{{ $id }}" class="{{ $viewClass['label'] }} control-label">{{ $label }}</label>
    <div class="{{ $viewClass['field'] }}">
        @include('admin::form.error')
        <textarea name="{{ $name }}" id="{{ $id }}" class="form-control {{ $class }}"
            rows="{{ $rows }}" placeholder="{{ $placeholder }}" {!! $attributes !!}>{{ old($column, $value) }}</textarea>
        {!! $append !!}
        @include('admin::form.help-block')
    </div>
</div>

@if (config('admin.extensions.mr4lax.enable', true))
    <script>
        initTinyMce = (readonly = false, height = 370) => {
            tinymce.init({
                selector: '#{{ $id }}',
                plugins: '{{ $plugins }}',
                toolbar: '{{ $toolbar }}',
                readonly: readonly,
                height: height,
                branding: false,

                menubar: {{ $menubar }},
                statusbar: {{ $statusbar }},

                images_upload_url: '{{ $uploadRouter }}',
                automatic_uploads: true,
                relative_urls: false,
                remove_script_host: false,
            })
        }
        document.onreadystatechange = function() {
            if (document.readyState == "complete") {
                initTinyMce({{ $readonly }}, '{{ $height }}')
            }
        };
    </script>
@endif
