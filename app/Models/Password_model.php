<?php
namespace App\Models;

class Password_model {

    public function validatePassword($password, $confirmPassword, $currentPassword = null, $storedPasswordHash = null) {

        // Password changing disabled check
        if ($this->isPasswordChangingDisabled()) {
            return ['valid' => false, 'error' => 'Password changing is currently disabled.'];
        }

        // Current password correctness check
        if (!is_null($currentPassword) && !is_null($storedPasswordHash)) {
            if (!password_verify($currentPassword, $storedPasswordHash)) {
                return ['valid' => false, 'error' => 'Current password is incorrect.'];
            }
        }

        // Confirm passwords match
        if ($password !== $confirmPassword) {
            return ['valid' => false, 'error' => 'Passwords do not match.'];
        }

        // Minimum length
        if (strlen($password) < 8) {
            return ['valid' => false, 'error' => 'Password must be at least 8 characters long.'];
        }

        // Uppercase check
        if (!preg_match('/[A-Z]/', $password)) {
            return ['valid' => false, 'error' => 'Password must contain at least one uppercase letter.'];
        }

        // Lowercase check
        if (!preg_match('/[a-z]/', $password)) {
            return ['valid' => false, 'error' => 'Password must contain at least one lowercase letter.'];
        }

        // Number check
        if (!preg_match('/[0-9]/', $password)) {
            return ['valid' => false, 'error' => 'Password must contain at least one number.'];
        }

        // Symbol check
        if (!preg_match('/[\W_]/', $password)) {
            return ['valid' => false, 'error' => 'Password must contain at least one symbol.'];
        }

        // Same character repetition check (no more than 3 identical chars consecutively)
        if (preg_match('/(.)\1{3,}/', $password)) {
            return ['valid' => false, 'error' => 'Password cannot have more than 3 identical consecutive characters.'];
        }

        // Repeated patterns (e.g. "ababab")
        if (preg_match('/(..+)\1{2,}/', $password)) {
            return ['valid' => false, 'error' => 'Password cannot have repeated patterns.'];
        }

        return ['valid' => true];
    }

    private function isPasswordChangingDisabled() {
        // Placeholder for checking a configuration or database flag
        return false; // return true if password changing is disabled
    }
}
