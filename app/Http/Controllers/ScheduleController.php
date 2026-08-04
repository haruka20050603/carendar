<?php

namespace App\Http\Controllers;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function index()
    {    $schedules = Schedule::all();
        $events=[];
        foreach($schedules as $schedule){
        $events[] = [
            'id' => $schedule->id,
            'title' => $schedule->title,
            'description' => $schedule->description,
            'start' => $schedule->start_date.'T'.$schedule->start_time,
            'end' => $schedule->end_date.'T'.$schedule->end_time,
            'backgroundColor' => '#f6ad55', // 背景色
            'borderColor' => '#e53e3e', // 枠線の色
            'url' => route('schedules.edit', $schedule->id), // 予定詳細ページへのリンク


        ];
    }
        return view('schedules.index', compact('events'));
    }



    public function create()
    {
        return view('schedules.create');
    }
    public function store(Request $request){
        $request->merge([
            'user_id' => auth()->id(),
        ]);
        Schedule ::create($request->all());
        return redirect()->route('schedules.index')->with('status', '予定を登録しました。');
    }
    // 予定編集ページを表示
    public function edit(Schedule $schedule)
    {

        return view('schedules.edit', compact('schedule'));
    }
    // 編集を更新する
    public function update(Request $request, Schedule $schedule)
    {
        $schedule->update($request->all());

        return redirect()->route('schedules.index')
        ->with('status', '予定を更新しました。');
    }
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('schedules.index')->with('status', '予定を削除しました。');
    }



}
