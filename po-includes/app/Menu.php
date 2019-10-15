<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Menu extends Model
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
    protected $table = 'menus';

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
		'parent', 'group', 'title', 'url', 'class', 'target', 'position', 'created_by', 'updated_by'
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
		return $this->hasOne('App\Menu', 'id', 'parent')->orderBy('position');
	}
	
	public function children() {
		return $this->hasMany('App\Menu', 'parent', 'id')->orderBy('position');
	}
	
	public static function tree() {
		return static::with(implode('.', array_fill(0, 100, 'children')))->where('parent', '=', '0')->orderBy('position')->get();
	}
	
	protected static $logAttributes = ['*'];
}
