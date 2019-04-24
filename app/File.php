<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $path
 * @property string $name
 * @property string $ext
 * @property Card[] $cards
 */
class File extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'file';
    public $timestamps = false;


    /**
     * @var array
     */
    protected $fillable = ['path', 'name', 'ext'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function cards()
    {
        return $this->belongsToMany('App\Card', 'card_files', 'id_files', 'id_card');
    }
}
