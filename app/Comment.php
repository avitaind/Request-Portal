<?php
<<<<<<< HEAD

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
}
=======
 
namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Comment extends Model
{
    protected $fillable = [
      'ticket_id', 'user_id', 'comment'
    ];
 
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
 
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
>>>>>>> f3943cbf5f65ff5df09959aaaa01fe3574208545
