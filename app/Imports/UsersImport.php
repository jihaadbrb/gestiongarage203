<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**

     * @param array $row

     *

     * @return \Illuminate\Database\Eloquent\Model|null

     */
    public function model(array $row)
    {
        $errors = []; // Array to store validation errors

        // Validate required fields (adjust based on your needs)
        if (empty($row['name'])) {
            $errors[] = 'Name is required.';
        }
        if (empty($row['email']) || !filter_var($row['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Invalid email address.';
        }
        if (empty($row['password'])) {
            $errors[] = 'Password is required.';
        }

        // Check for duplicate email (if applicable)
        if (User::where('email', $row['email'])->exists()) {
            $errors[] = 'Email "' . $row['email'] . '" already exists.';
        }

        // If there are errors, store them in the session and skip creating the user
        if (!empty($errors)) {
            session()->flash('import_errors', $errors);
            return null;
        }
        return new User([
            'name' => $row['name'],
            'email' => $row['email'],
            'password' => Hash::make($row['password']),
            'role' => $row['role'],
            'address' => $row['address'],
            'phoneNumber' => $row['phone'] ?? '1111111',
        ]);
    }
}
