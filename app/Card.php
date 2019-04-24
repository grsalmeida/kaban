<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $id_course
 * @property int $id_discipline
 * @property integer $type
 * @property integer $educational_material
 * @property string $year
 * @property integer $status
 * @property Course $course
 * @property Discipline $discipline
 * @property File[] $files
 * @property Teacher[] $teachers
 */
class Card extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'card';


    /**
     * @var array
     */
    protected $fillable = ['id_course', 'id_discipline', 'type', 'educational_material', 'year', 'status'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course()
    {
        return $this->belongsTo('App\Course', 'id_course');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function discipline()
    {
        return $this->belongsTo('App\Discipline', 'id_discipline');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function files()
    {
        return $this->belongsToMany('App\File', 'card_files', 'id_card', 'id_files');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function teachers()
    {
        return $this->belongsToMany('App\Teacher', 'card_teacher', 'id_card', 'id_teacher');
    }
}
