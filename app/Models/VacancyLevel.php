<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VacancyLevel extends Model
{
    use HasFactory;
    private $remainingCount;

    public function __construct(int $remainingCount) {
        $this->remainingCount = $remainingCount;
    }

    public function mark(): string {
        if ($this->remainingCount === 0) {
            return '×';
        } elseif ($this->remainingCount < 5) {
            return '△';
        }
        return '◎';
    }

    public function __toString() {
        return $this->mark();
    }
}
