<?php

namespace App\Models;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Symfony\Component\Serializer\Attribute\Groups;

#[ApiResource(
    normalizationContext: ['groups' => ['read']],
    paginationItemsPerPage: 5,
)]
#[ApiProperty(property: 'title', serialize: [new Groups(['read'])])]
#[ApiProperty(property: 'completed', serialize: [new Groups(['read'])])]
class Todo extends Model
{
    use HasFactory;

    /**
     * Get the subtasks for the todo.
     */
    #[ApiProperty(readableLink: true)]
    #[Groups(['read'])]
    public function subtasks(): HasMany
    {
        return $this->hasMany(Subtask::class);
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'completed',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'completed' => 'boolean',
    ];
}
