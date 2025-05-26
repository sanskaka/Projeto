<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Task extends Model
{
    use SoftDeletes, HasFactory, Notifiable;

    protected $table = 'tasks';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'titulo',
        'descricao',
        'status',
    ];

    /**
     * Enum of available status.
     *
     * @return array
     */
    public static function getStatusOptions()
    {
        return [
            'pendente',
            'concluida',
        ];
    }
}