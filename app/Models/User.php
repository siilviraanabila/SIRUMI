<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nip',
        'email',
        'role',
        'password',
    ];

    public static function rules()
    {
        return [
            'nip' => 'required|numeric',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6|max:10',
            'role' => 'required|string|max:255',
        ];
    }

    public static function messages()
    {
        return [
            'nip.required' => 'NIM/NIP harus diisi.',
            'nip.numeric' => 'NIM/NIP harus berupa angka.',
            'asal_kantor.max' => 'Asal kantor tidak boleh melebihi :max karakter.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email tidak boleh melebihi :max karakter.',
            'password.required' => 'Password harus diisi.',
            'password.string' => 'Password harus berupa teks.',
            'password.min' => 'Password minimal harus :min karakter.',
            'password.max' => 'Password tidak boleh melebihi :max karakter.',
            'role.required' => 'Role harus diisi.',
            'role.string' => 'Role harus berupa teks.',
            'role.max' => 'Role tidak boleh melebihi :max karakter.',
        ];
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

}
