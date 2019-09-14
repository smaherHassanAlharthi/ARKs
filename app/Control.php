<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\FilterByUser;

/**
 * Class Control
 *
 * @package App
 * @property string $name
 * @property tinyInteger $status
 * @property string $created_by
*/
class Control extends Model
{
    use SoftDeletes, FilterByUser;

    protected $fillable = ['name', 'status', 'created_by_id'];
    protected $hidden = [];
    
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCreatedByIdAttribute($input)
    {
        $this->attributes['created_by_id'] = $input ? $input : null;
    }
    
    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
    
}
