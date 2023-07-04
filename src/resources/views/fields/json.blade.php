{{-- json field based on: https://github.com/josdejong/jsoneditor --}}
@php
    $value = new stdClass();

    if (old($field['name'])) {
        $value = old($field['name']);
    } elseif (isset($field['value']) && isset($field['default'])) {
        $value = array_merge_recursive($field['default'], $field['value']);
    } elseif (isset($field['value'])) {
        $value = $field['value'];
    } elseif (isset($field['default'])) {
        $value = $field['default'];
    }

    // if attribute casting is used, convert to JSON
    if (is_array($value) || is_object($value) ) {
        $value = json_encode($value);
    }

    // bug in laravel @json blade directive, it cannot accept an array of more than 3 items directly.
    // hence the need to declare a variable here 1st then pass to @json later.
    $defaultModes = ['form', 'tree', 'code', 'preview', 'text'];
@endphp

@if ($crud->checkIfFieldIsFirstOfItsType($field, $fields))
    @push('crud_fields_styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsoneditor/9.10.2/jsoneditor.min.css" />
    @endpush

    @push('crud_fields_scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jsoneditor/9.10.2/jsoneditor.min.js"></script>
        <script>
            let container, jsonString, options, editor;
        </script>
    @endpush
@endif

@include('crud::fields.inc.wrapper_start')
<label>{!! $field['label'] !!}</label>

<div id="jsoneditor-{{ $field['name'] }}" style="height: 400px;"></div>

<input type="hidden" id="{{ $field['name'] }}"
       name="{{ $field['name'] }}"
        @include('crud::fields.inc.attributes') />

@if (isset($field['hint']))
    <p class="help-block">{!! $field['hint'] !!}</p>
@endif
@include('crud::fields.inc.wrapper_end')

@push('crud_fields_scripts')
    <script>
        container = document.getElementById('jsoneditor-{{ $field['name'] }}');
        jsonString = @json($value);

        options = {
            onChange: function() {
                const hiddenField = document.getElementById('{{ $field['name'] }}');
                hiddenField.value = window['editor_{{ $field['name'] }}'].getText();
            },
            modes: @json($field['modes'] ?? $defaultModes),
        };

        window['editor_{{ $field['name'] }}'] = new JSONEditor(container, options, JSON.parse(jsonString));
        document.getElementById('{{ $field['name'] }}').value = window['editor_{{ $field['name'] }}'].getText();
    </script>
    <style>
        div.jsoneditor.jsoneditor-mode-preview pre.jsoneditor-preview, .jsoneditor input {
            background: #FFF;
        }

    </style>
@endpush
