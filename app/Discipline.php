<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property Card[] $cards
 */
class Discipline extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'discipline';

    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cards()
    {
        return $this->hasMany('App\Card', 'id_discipline');
    }
}
