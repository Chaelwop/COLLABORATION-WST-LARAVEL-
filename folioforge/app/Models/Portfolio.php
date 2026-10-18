<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = [
        'full_name', 'tagline', 'email', 'phone', 'address', 'about', 'photo',
        'education', 'skills', 'projects', 'experience', 'links', 'template',
    ];

    protected $casts = [
        'education' => 'array',
        'skills' => 'array',
        'projects' => 'array',
        'experience' => 'array',
        'links' => 'array',
    ];

    public const TEMPLATE_NAMES = [1 => 'Simple', 2 => 'Modern', 3 => 'Creative'];

    /** Repeatable form groups: name => [title, add-button label, fields [key,label,type]] */
    public static function groups(): array
    {
        return [
            'education' => ['Educational background', 'Add education', [
                ['school', 'School or university', 'text'],
                ['degree', 'Degree or course', 'text'],
                ['years', 'Years (e.g. 2020 - 2024)', 'text'],
            ]],
            'experience' => ['Work experience', 'Add experience', [
                ['role', 'Job title', 'text'],
                ['company', 'Company', 'text'],
                ['years', 'Years (e.g. 2022 - Present)', 'text'],
                ['description', 'What you did', 'textarea'],
            ]],
            'projects' => ['Projects', 'Add project', [
                ['title', 'Project name', 'text'],
                ['link', 'Project link (optional)', 'text'],
                ['description', 'Short description', 'textarea'],
            ]],
            'links' => ['Social media and website links', 'Add link', [
                ['label', 'Label (e.g. GitHub)', 'text'],
                ['url', 'URL', 'text'],
            ]],
        ];
    }
}
