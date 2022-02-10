<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskItem extends Model
{
    use HasFactory;

    protected $table = 'task_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'php',
        'js',
        'css',
        'isFinished',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'task_id'
    ];

    /**
     * Map values into model.
     * @param Object $item
     * @return Model $this
     */
    public function mapping($item)
    {
        foreach ($item as $key => $value) {
            if ($key == '' || $value == '') {
                continue;
            }
            
            if ($key === 'php' || $key === 'js' || $key === 'css') {
                $value = $value === 'on';
            }

            $this->attributes[$key] = $value;
        }
    }

    /**
     * Get the task list this item belongs to.
     */
    public function task()
    {
        return $this->belongsTo(TodoList::class);
    }
}
