<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GraphData;
use App\Models\Project;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Illuminate\Support\Facades\DB;

use function Ramsey\Uuid\v1;

class GraphController extends Controller
{
    // Get Data from my project

    // store data function
    public function storeData(Request $request)
    {
        $data = new GraphData();
        $data->label = $request->input('label');
        $data->value = $request->input('value');
        $data->save();

        return redirect()->route('graph.index')->with('success', 'Data saved successfully');
    }
}
