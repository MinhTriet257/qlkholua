<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'full_name',
        'gender',
        'birthdate',
        'phone_number',
        'avarta',
        'warehouse_id',
    ];

    public function getAgeAttribute(): int
    {
        return date_diff(date_create($this->birthdate),date_create())->y;
       // return date_format(date_create($this->created_at), 'Y');
    }
    public function getGenderNameAttribute(): string
    {
        return ($this->gender === 0)? 'Nam'  : 'Nu' ;
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
        // lấy tên môn học 
    }

}
