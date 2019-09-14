<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Consumption
 *
 * @package App
 * @property integer $liters
 * @property integer $cost
 * @property string $date
 * @property string $control
*/
class Consumption extends Model
{
    use SoftDeletes;

    protected $fillable = ['liters', 'cost', 'date'];
    protected $hidden = [];



    /**
     * Set attribute to money format
     * @param $input
     */
    public function setLitersAttribute($input)
    {
        $this->attributes['liters'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setCostAttribute($input)
    {
        $this->attributes['cost'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getDateAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setControlIdAttribute($input)
    {
        $this->attributes['control_id'] = $input ? $input : null;
    }

    public function control()
    {
        return $this->belongsTo(Control::class, 'control_id')->withTrashed();
    }

}
