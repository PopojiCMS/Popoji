<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Gallery extends Model
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
    protected $table = 'gallerys';

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
		'album_id', 'title', 'content', 'picture', 'created_by', 'updated_by'
	];
	
	public function createdBy()
	{
		return $this->belongsTo('App\User', 'created_by');
	}
	
	public function updatedBy()
	{
		return $this->belongsTo('App\User', 'updated_by');
	}
	
	public function album()
	{
		return $this->belongsTo('App\Album', 'album_id');
	}
	
	protected static $logAttributes = ['*'];
}
