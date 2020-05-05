<?php
   
namespace App;
   
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
   
class River extends Authenticatable
{
    use Notifiable;
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'location', 'key','channel','width','height'
    ];

    public function waterLevels()
    {
        return $this->hasMany('App\WaterLevel');
    }

    public function section()
    {
        return $this->hasMany('App\Sections');
    }
}
