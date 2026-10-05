<?php
/**
 * Validation Helper Functions
 * 
 * Provides simple, extensible server-side input validation.
 */

declare(strict_types=1);

/**
 * Validates an input dataset against a set of validation rules.
 *
 * Example rules:
 * [
 *     'name'  => 'required|min:3|max:50',
 *     'email' => 'required|email',
 *     'phone' => 'numeric'
 * ]
 *
 * @param array $data Data array to validate (e.g. $_POST).
 * @param array $rules Associative array of field => rules.
 * @return array{isValid: bool, errors: array<string, string[]>, data: array}
 */
function validate(array $data, array $rules): array {
    $errors = [];
    $sanitized = [];

    foreach ($rules as $field => $ruleString) {
        $value = $data[$field] ?? null;
        $ruleList = is_array($ruleString) ? $ruleString : explode('|', $ruleString);

        if (is_string($value)) {
            $value = trim($value);
        }
        $sanitized[$field] = $value;

        foreach ($ruleList as $rule) {
            $ruleName = $rule;
            $parameter = null;

            if (str_contains($rule, ':')) {
                [$ruleName, $parameter] = explode(':', $rule, 2);
            }

            // Required check
            if ($ruleName === 'required') {
                if ($value === null || $value === '' || (is_array($value) && empty($value))) {
                    $errors[$field][] = ucfirst(str_replace('_', ' ', $field)) . ' is required.';
                    // Skip other rules if empty
                    break;
                }
            }

            // Skip remaining checks if field is optional and value is empty
            if (($value === null || $value === '') && $ruleName !== 'required') {
                continue;
            }

            // Rule implementations
            switch ($ruleName) {
                case 'email':
                    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        $errors[$field][] = ucfirst(str_replace('_', ' ', $field)) . ' must be a valid email address.';
                    }
                    break;

                case 'min':
                    $min = (int)$parameter;
                    if (is_string($value) && mb_strlen($value) < $min) {
                        $errors[$field][] = ucfirst(str_replace('_', ' ', $field)) . " must be at least {$min} characters.";
                    } elseif (is_numeric($value) && (float)$value < $min) {
                        $errors[$field][] = ucfirst(str_replace('_', ' ', $field)) . " must be at least {$min}.";
                    }
                    break;

                case 'max':
                    $max = (int)$parameter;
                    if (is_string($value) && mb_strlen($value) > $max) {
                        $errors[$field][] = ucfirst(str_replace('_', ' ', $field)) . " may not exceed {$max} characters.";
                    } elseif (is_numeric($value) && (float)$value > $max) {
                        $errors[$field][] = ucfirst(str_replace('_', ' ', $field)) . " may not exceed {$max}.";
                    }
                    break;

                case 'numeric':
                    if (!is_numeric($value)) {
                        $errors[$field][] = ucfirst(str_replace('_', ' ', $field)) . ' must be a number.';
                    }
                    break;

                case 'alpha':
                    if (!ctype_alpha(str_replace(' ', '', (string)$value))) {
                        $errors[$field][] = ucfirst(str_replace('_', ' ', $field)) . ' may only contain letters.';
                    }
                    break;

                case 'url':
                    if (!filter_var($value, FILTER_VALIDATE_URL)) {
                        $errors[$field][] = ucfirst(str_replace('_', ' ', $field)) . ' must be a valid URL.';
                    }
                    break;

                case 'match':
                    $otherField = $parameter;
                    if (($data[$otherField] ?? null) !== $value) {
                        $errors[$field][] = ucfirst(str_replace('_', ' ', $field)) . ' does not match ' . str_replace('_', ' ', $otherField) . '.';
                    }
                    break;
            }
        }
    }

    return [
        'isValid' => empty($errors),
        'errors'  => $errors,
        'data'    => $sanitized,
    ];
}
