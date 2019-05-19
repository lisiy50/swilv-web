<?php


namespace App\Service;


use Symfony\Component\Validator\Validator\ValidatorInterface;

class ValidatorService
{
    private $validator;

    private $errors;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function validate($value): bool
    {
        $this->errors = $this->validator->validate($value);

        return $this->getIsValid();
    }

    public function getIsValid(): bool
    {
        return !count($this->errors);
    }

    public function getErrors(): array
    {
        $result = [];
        foreach ($this->errors as $error) {
            $result[] = [
                'property' => $error->getPropertyPath(),
                'message' => $error->getMessage(),
            ];
        }

        return $result;
    }
}