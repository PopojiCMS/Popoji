<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Post extends Model
{
	use LogsActivity;
	
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    // public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'category_id', 'title', 'seotitle', 'content', 'meta_description', 'picture', 'picture_description', 'tag', 'type', 'active', 'headline', 'comment', 'hits', 'created_by', 'updated_by'
	];
	
	public function createdBy()
	{
		return $this->belongsTo('App\User', 'created_by');
	}
	
	public function updatedBy()
	{
		return $this->belongsTo('App\User', 'updated_by');
	}
	
	public function category()
	{
		return $this->belongsTo('App\Category', 'category_id');
	}
	
	public function comments() {
		return $this->hasMany('App\Comment', 'post_id');
	}
	
	protected static $logAttributes = ['*'];
}
