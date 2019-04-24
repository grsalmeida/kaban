<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_card
 * @property int $id_files
 * @property Card $card
 * @property File $file
 */
class CardFile extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['id_card', 'id_files'];

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
    public function file()
    {
        return $this->belongsTo('App\File', 'id_files');
    }
}
