<?php

use Illuminate\Http\Request;

use App\Point;
use App\Connection;

// Index page
$app->get('/', function () use ($app) {

    return view('index', ['connections' => Connection::all()]);
});

// find path
$app->get('/path', function (Request $request) {
    $fromName = trim($request->input('from'));
    $from = Point::where('name', $fromName)->first();

    $toName = trim($request->input('to'));
    $to = Point::where('name', $toName)->first();

    $error = "";
    if (!$from) {
        $error .= "Cant't find origin point";
    }
    if (!$to) {
        $error .= "Cant't find destination point";
    }
    if ($error) {
        return response($error, 403);
    }

    $graph = new \App\Graph\Graph(Point::count());
    foreach (Connection::all() as $connection) {
        $graph->addEdge($connection->from->id, $connection->to->id, $connection->time);
    }
    
    try {
        $path = $graph->findPath($from->id, $to->id);
    } catch (\Exception $e) {
        return response("cant find route", 403);
    }
    
    $result = [];
    foreach ($path->vertexes as $index => $vertex) {
        $result[] = [
            'name' => Point::find($vertex)->name,
            'time' => $path->distances[$index]
        ];
    }

    return response()->json($result);
});

// add connection
$app->post('/connections', function (Request $request) {
    $error = "";
    
    $fromName = trim($request->input('from'));
    if (!$fromName) {
        $error .= "From name required\n";
    }

    $toName = trim($request->input('to'));
    if (!$toName) {
        $error .= "To name required\n";
    }
    
    $time = intval($request->input('time'));
    if ($time < 1) {
        $error .= "Time should be grater than 1 minute\n";
    }

    if ($error) {
        return response($error, 403);
    }

    $from = Point::firstOrCreate(['name' => $fromName]);
    $to = Point::firstOrCreate(['name' => $toName]);

    $connection = Connection::firstOrNew(['from_id' => $from->id, 'to_id' => $to->id]);
    $connection->time = $time;
    $connection->save();

    return response()->json(
        [
            'from' => $connection->from->name,
            'to' => $connection->to->name,
            'time' => $connection->time
        ]
    );
});
