<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['title', 'scenario', 'image_path', 'order'];

    // คำถาม 1 ข้อ มีหลายตัวเลือก
    public function choices()
    {
        return $this->hasMany(Choice::class);
    }
}