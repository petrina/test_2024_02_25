<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    const CRITERIA = [
        [
            'start' => 0,
            'stop' => 60,
            'criteria' => 100,
        ],
        [
            'start' => 60,
            'stop' => 80,
            'criteria' => 200,
        ],
        [
            'start' => 80,
            'stop' => 91,
            'criteria' => 300,
        ],
        [
            'start' => 91,
            'stop' => 100,
            'criteria' => 500,
        ],
    ];

    public function save(array $options = [])
    {
        if ($this->grade !== null) {
            foreach (self::CRITERIA as $row) {
                if ($this->grade <= $row['stop'] && $this->grade > $row['start']) {
                    $this->criteria = $row['criteria'];
                    break;
                }
            }
        }
        return parent::save($options);
    }
}
