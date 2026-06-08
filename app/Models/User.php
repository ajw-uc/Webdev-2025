<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // <-- wajib ada untuk authentication
use Illuminate\Notifications\Notifiable;
use App\Enums\UserRoleEnum;

#[Fillable(['name', 'email', 'password', 'role'])] // <-- Fitur baru di Laravel 13, kode ini equivalent dengan protected $fillable
#[Hidden(['password', 'remember_token'])] // <-- Atribut untuk menyembunyikan field dari response
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRoleEnum::class
        ];
    }
}
