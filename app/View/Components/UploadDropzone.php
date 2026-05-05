<?php

namespace App\View\Components;

use Illuminate\View\Component;

class UploadDropzone extends Component
{
    public $name;
    public $label;
    public $hint;
    public $note;
    public $accept;
    public $id;
    public $currentFile;
    public $showCurrent;

    public function __construct(
        $name = 'file',
        $label = 'Upload file dokumen',
        $hint = 'Drag & drop atau klik untuk memilih file',
        $note = 'Kosongkan jika tidak ingin mengganti file',
        $accept = '',
        $id = null,
        $currentFile = null,
        $showCurrent = true
    ) {
        $this->name = $name;
        $this->label = $label;
        $this->hint = $hint;
        $this->note = $note;
        $this->accept = $accept;

        // 🔥 FIX UTAMA DI SINI
        $this->id = $id ?? 'upload_' . uniqid();

        $this->currentFile = $currentFile;
        $this->showCurrent = $showCurrent;
    }

    public function render()
    {
        return view('components.upload-dropzone');
    }
}