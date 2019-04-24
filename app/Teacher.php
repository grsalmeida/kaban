<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property Card[] $cards
 */
class Teacher extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'teacher';

    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function cards()
    {
        return $this->belongsToMany('App\Card', null, 'id_teacher', 'id_card');
    }
}
