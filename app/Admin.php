<?php

    namespace App;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Laravelista\Comments\Commenter;

    class Admin extends Authenticatable
    {
        use Notifiable, Commenter;

        protected $guard = 'admin';

        protected $fillable = [
            'name', 'email', 'password',
        ];

        protected $hidden = [
            'password', 'remember_token',
        ];

        public function comments()
        {
            return $this->hasMany(Comment::class);
        }
     
        public function tickets()
        {
            return $this->hasMany(Ticket::class);
        }
    }