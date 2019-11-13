<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Category extends Model
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
    protected $table = 'categories';

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
		'parent', 'title', 'seotitle', 'picture', 'active', 'created_by', 'updated_by'
	];
	
	public function createdBy()
	{
		return $this->belongsTo('App\User', 'created_by');
	}
	
	public function updatedBy()
	{
		return $this->belongsTo('App\User', 'updated_by');
	}
	
	public function mainParent() {
		return $this->hasOne('App\Category', 'id', 'parent');
	}

	public function children() {
		return $this->hasMany('App\Category', 'parent', 'id');
	}

	public static function tree() {
		return static::with(implode('.', array_fill(0, 100, 'children')))->get();
	}
	
	public function posts() {
		return $this->hasMany('App\Post', 'category_id');
	}
	
	protected static $logAttributes = ['*'];
}
