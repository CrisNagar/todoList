<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'user_id'
    ];

    /**
     * Map values into model.
     * @param Object $item
     * @return Model $this
     */
    public function mapping($item)
    {
        foreach ($item as $key => $value) {
            $this->attributes[$key] = $value;
        }
    }

    /**
     * Get the user that owns the todo list.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the items on the task list.
     */
    public function taskItems()
    {
        return $this->hasMany(TaskItem::class,);
    }
}
