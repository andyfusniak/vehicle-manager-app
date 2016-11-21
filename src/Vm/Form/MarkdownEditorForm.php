<?php
namespace Vm\Form;

use Nitrogen\Form\Form;
use Nitrogen\Form\Element;

class MarkdownEditorForm extends Form
{
    public function __construct()
    {
        $id = new Element\Hidden('id');

        $markdown = new Element\Textarea('markdown');
        $this->add([
            $id,
            $markdown
        ]);
    }
}
