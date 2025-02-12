<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GraphData extends Model
{
    use HasFactory;
    protected $table = 'graph_data'; // Define the table name if it's different from the model name in plural form

    protected $fillable = [
        'project_name',
        // Add other fields as needed
    ];

    // If you want to disable timestamps (created_at and updated_at columns), set the following property to false
    public $timestamps = true;
}
