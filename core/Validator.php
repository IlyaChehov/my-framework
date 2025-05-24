<?php

namespace My\Framework\Core;

class Validator
{
    private array $errors = [];
    private array $rulesList = ['require', 'min', 'max', 'email', 'match'];
    private array $dataItem = [];
    private array $errorMessages = [
        'require' => 'Поле :fieldname: обязательно для заполнения',
        'min' => 'Поле :fieldname: должно содеражть не менее :rulevalue: символов',
        'max' => 'Поле :fieldname: должно содеражть не более :rulevalue: символов',
        'email' => 'Введите корректный Email',
        'match' => 'Пароли не совпадают',
    ];

    public function validate(array $data, array $rules): void
    {
        $this->dataItem = $data;
        foreach ($data as $field => $value) {
            if (array_key_exists($field, $rules)) {
                $this->check([
                    'field' => $field,
                    'value' => $value,
                    'rules' => $rules[$field]
                ]);
            }
        }
    }

    private function check($data)
    {
        foreach ($data['rules'] as $rule => $ruleValue) {
            if (in_array($rule, $this->rulesList)) {
                if (!call_user_func_array([$this, $rule], [$data['value'], $ruleValue])) {
                    $this->addError(
                        $data['field'],
                        str_replace(
                            [':fieldname:', ':rulevalue:'],
                            [$data['field'], $ruleValue],
                            $this->errorMessages[$rule]
                        )
                    );
                }
            }
        }
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    private function addError($fieldName, $errorMessage): void
    {
        $this->errors[$fieldName][] = $errorMessage;
    }

    private function removeEmptyLines(mixed $value): string
    {
        return trim($value);
    }

    private function require(mixed $value, mixed $ruleValue): bool
    {
        return !empty($this->removeEmptyLines($value));
    }

    private function min(mixed $value, mixed $ruleValue): bool
    {
        $value = $this->removeEmptyLines($value);
        return mb_strlen($value, 'UTF-8') >= $ruleValue;
    }

    private function max(mixed $value, mixed $ruleValue): bool
    {
        $value = $this->removeEmptyLines($value);
        return mb_strlen($value, 'UTF-8') <= $ruleValue;
    }

    private function email(mixed $value, mixed $ruleValue): bool
    {
        $value = $this->removeEmptyLines($value);
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    private function match(mixed $value, mixed $ruleValue): bool
    {
        return $value === $this->dataItem[$ruleValue];
    }
}
