<?php
class FileUpload extends CFormModel
{
    public $file;
 
    public function rules()
    {
        return array(
            array('file', 'file', 'types'=>'jpg, jpeg, png, pdf, doc, docx','safe'=>true),
        );
    }
}?>