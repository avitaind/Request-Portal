<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravelista\Comments\Commentable;


class Ticket extends Model
{
    use Commentable;
    
    protected $fillable = [
        'job','no', 'brand', 'country', 'title', 'category_name', 'priority', 'summary', 'objective', 'reference', 'otherinfo', 'comments'
    ];
    // Ticket.php file

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
  
    public function status()
    {
        return $this->hasMany(Status::class);
    }
 
    
}
