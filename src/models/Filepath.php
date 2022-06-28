<?php

namespace mvorobiov\models;


/**
 * @property string $filepath
 */
class Filepath extends \yii\base\Model
{
    public string $filepath;

    public function rules(): array {
        return [
            ['filepath', 'required'],
            ['filepath', 'filepathValidate']
        ];
    }

    public function filepathValidate($attribute, $params)
    {
        if(!file_exists($this->$attribute)) {
            $this->addError($attribute, sprintf('File "%s" is not exists', $this->$attribute));
        }

        $ext = pathinfo($this->$attribute, PATHINFO_EXTENSION);

        if(!in_array($ext, $this->allowedExtensions())) {
            $this->addError($attribute, sprintf('Extension of "%s" is not allowed', $this->$attribute));
        }
    }

    protected function allowedExtensions(): array {
        return ['json'];
    }
}