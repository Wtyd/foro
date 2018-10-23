<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Mail\TokenMail;
use Illuminate\Support\Facades\Mail;

class Token extends Model
{
    protected $guarded = []; //Evita que un usuario cree un token desde un formulario ?

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Por defecto Model usa el atributo id como ruta de un elemento. Con este metodo podemos modificar este comportamiento para usar otro atributo,
     * en este caso, token.
     *
     * @return string url del token.
     */
    public function getRouteKeyName()
    {
        return 'token';
    }

    public static function generateFor(User $user)
    {
        $token = new static;
        
        $token->token = str_random(60);

        $token->user()->associate($user);

        $token->save();

        return $token;
    }

    public function sendByEmail()
    {
        Mail::to($this->user)->send(new TokenMail($this));
    }
}
