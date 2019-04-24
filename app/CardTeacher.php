<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_card
 * @property int $id_teacher
 * @property Card $card
 * @property Teacher $teacher
 */
class CardTeacher extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'card_teacher';

    /**
     * @var array
     */
    protected $fillable = ['id_card', 'id_teacher'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function card()
    {
        return $this->belongsTo('App\Card', 'id_card');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function teacher()
    {
        return $this->belongsTo('App\Teacher', 'id_teacher');
    }
}
