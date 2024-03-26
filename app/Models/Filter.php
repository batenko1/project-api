<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'alias',
        'entity_id',
        'type',
        'is_default',
        'is_required'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $with = [
        'values'
    ];

    const CHECKBOX_FIELD = 'checkbox';

    const SELECT_FIELD = 'select';

    const INPUT_TEXT_FIELD = 'input_text';

    const INPUT_DATE_FIELD = 'input_date';

    const INPUT_FILE_FIELD = 'input_file';

    const TEXTAREA_FIELD = 'textarea';

    const FIELDS = [
        self::CHECKBOX_FIELD,
        self::SELECT_FIELD,
        self::INPUT_TEXT_FIELD,
        self::TEXTAREA_FIELD,
        self::INPUT_DATE_FIELD,
        self::INPUT_FILE_FIELD
    ];


    public function entity() {
        return $this->belongsTo(Entity::class);
    }

    public function values() {
        return $this->hasMany(FilterValue::class, 'filter_id');
    }

}
