<?php

namespace Mr4Lax\TinyMce;

class TinyMceEditor extends \Encore\Admin\Form\Field\Textarea
{
    protected $view = 'mr4-lax::tinymce_editor';

    protected $plugins = null;

    protected $toolbar = null;

    protected static $css = [];

    protected static $js = [
        'vendor/mr4-lax/js/tinymce/tinymce.min.js',
    ];

    public function setPlugins($plugins): self
    {
        $this->plugins = $plugins;
        return $this;
    }

    public function setToolbar($toolbar): self
    {
        $this->toolbar = $toolbar;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function render()
    {
        if (!$this->shouldRender()) {
            return '';
        }

        if (is_array($this->value)) {
            $this->value = json_encode($this->value, JSON_PRETTY_PRINT);
        }

        $this->mountPicker(function ($btn) {
            $this->addPickBtn($btn);
        });

        if (!isset($this->plugins)) {
            $this->plugins = config('admin.extensions.mr4lax.tinymce.editor.plugins', 'table lists link image media wordcount');
        }

        if (!isset($this->toolbar)) {
            $this->toolbar = config('admin.extensions.mr4lax.tinymce.editor.toolbar', 'undo redo | formatselect| bold italic underline strikethrough forecolor backcolor | alignleft aligncenter alignright alignjustify | indent outdent | bullist numlist | code | table | image media link');
        }

        return parent::fieldRender([
            'append'        => $this->append,
            'rows'          => $this->rows,
            'plugins'       => $this->plugins,
            'toolbar'       => $this->toolbar,
            'uploadRouter'  => route(config('admin.extensions.mr4lax.tinymce.upload.router', 'mr4.lax.tinymce.upload')),
        ]);
    }
}
