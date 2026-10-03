<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nim',
        'peran',
        'email',
        'tugas',
        'avatar',
        'github_url',
        'linkedin_url',
        'urutan',
    ];

    /**
     * Helper badges style for IT Development roles
     */
    public function getBadgeClassAttribute(): string
    {
        $role = strtolower($this->peran);
        return match (true) {
            str_contains($role, 'manager') || str_contains($role, 'pm') => 'bg-amber-100 text-amber-800 border-amber-300',
            str_contains($role, 'analyst') || str_contains($role, 'analis') => 'bg-indigo-100 text-indigo-800 border-indigo-300',
            str_contains($role, 'programmer') || str_contains($role, 'developer') || str_contains($role, 'dev') => 'bg-emerald-100 text-emerald-800 border-emerald-300',
            str_contains($role, 'database') || str_contains($role, 'db') => 'bg-purple-100 text-purple-800 border-purple-300',
            str_contains($role, 'tester') || str_contains($role, 'qa') || str_contains($role, 'quality') => 'bg-rose-100 text-rose-800 border-rose-300',
            str_contains($role, 'doc') || str_contains($role, 'support') || str_contains($role, 'dokumentasi') => 'bg-cyan-100 text-cyan-800 border-cyan-300',
            default => 'bg-slate-100 text-slate-800 border-slate-300',
        };
    }
}
