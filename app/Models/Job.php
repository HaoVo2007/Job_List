<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = 'jobs_company';

    protected $fillable = [
        'title',
        'description',
        'employer_id',
        'salary',
        'location',
        'category',
        'experience',
    ];

    public static array $experience = ['Intern', 'Fresher', 'Junior', 'Senior'];
    public static array $category = ['IT', 'Marketing', 'Sales', 'Finance'];

    public function employer() {
        return $this->belongsTo(Employer::class);
    }

    public function jobApplications() {
        return $this->hasMany(JobApplication::class);
    }

}
