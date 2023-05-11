<?php

namespace App\Models\Faq;

use App\Models\Faq\Traits\FaqMethod;
use App\Models\Faq\Traits\FaqRelationship;
use App\Models\Faq\Traits\FaqScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
    use FaqMethod;
    use FaqScope;
    use FaqRelationship;
    use SoftDeletes;

    protected $table = 'frequently_asked_questions';

    protected $fillable = [
        'question',
        'slug',
        'answer',
        'active',
    ];
}
