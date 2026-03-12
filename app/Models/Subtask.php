<?php

namespace App\Models;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Symfony\Component\Serializer\Attribute\Groups;

#[ApiResource(normalizationContext: ['groups' => ['read']])]
#[ApiProperty(property: 'title', serialize: [new Groups(['read'])])]
#[ApiProperty(property: 'completed', serialize: [new Groups(['read'])])]
class Subtask extends Model
{
    use HasFactory;

    /** 
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'completed',
        'todo_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'completed' => 'boolean',
    ];

    /**
     * Get the todo that owns the subtask.
     * Shown as IRI to avoid circular reference (Todo has subtasks).
     */
    #[ApiProperty(readableLink: false)]
    #[Groups(['read'])]
    public function todo(): BelongsTo
    {
        return $this->belongsTo(Todo::class);
    }
}
