@php
    $readonly = 'false';
    if (Str::contains($attributes, 'readOnly="true"')) {
        $readonly = 'true';
    }

    $menubar = 'true';
    if (Str::contains($attributes, 'menubar="false"')) {
        $menubar = 'false';
    }

    $statusbar = 'true';
    if (Str::contains($attributes, 'statusbar="false"')) {
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
