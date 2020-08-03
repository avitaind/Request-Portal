<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'job','no', 'brand', 'title', 'category_name', 'priority', 'summary', 'objective', 'reference', 'otherinfo'
    ];
    // Ticket.php file

    public function category()
    
    {
        return $this->belongsTo(Category::class);
    }

    

    
}
