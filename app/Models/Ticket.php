<?php

namespace App\Models;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //protected $relations = ['module', 'type', 'channel', 'company'];
    protected $fillable = ['opened_at','user_id','company_id','module_id','type_id','channel_id','closed', 'description', 'description_closed'];

    protected $dates = ['created_at', 'updated_at', 'opened_at'];

    protected function getOpenedAtFormatedAttribute()
    {
        return $this->opened_at->format('d/m/Y H:i:s');
    }

    protected function getClosedFormatedAttribute()
    {
        if($this->closed){
            return "Sim";
        }else{
            return "Não";
        }
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
