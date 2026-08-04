<x-layouts::app :title="__('スケジュール')">
    <div class="w-full py-6">
        <div class="mx-auto w-full max-w-3xl px-4">
            <div class="overflow-hidden rounded border border-gray-300 bg-white shadow-sm dark:border-zinc-700 dark:bg-zinc-900">

                <!-- カード見出し -->
                <div class="border-b border-gray-300 bg-gray-50 px-4 py-2 dark:border-zinc-700 dark:bg-zinc-800">
                    <h1 class="text-sm font-medium text-gray-900 dark:text-zinc-100">
                        スケジュール
                    </h1>
                </div>

                <!-- カレンダー表示部分 -->
                <div class="bg-white px-4 py-3 dark:bg-zinc-900">
                    <div id="calendar"></div>
                </div>

            </div>
        </div>
    </div>
    <style>
    /* 土曜日 */
    #calendar .fc-day-sat .fc-col-header-cell-cushion,
    #calendar .fc-day-sat .fc-daygrid-day-number {
        color: #2563eb !important;
    }

    /* 日曜日 */
    #calendar .fc-day-sun .fc-col-header-cell-cushion,
    #calendar .fc-day-sun .fc-daygrid-day-number {
        color: #dc2626 !important;
    }

    /* 土曜日の背景 */
    #calendar .fc-day-sat {
        background-color: #eff6ff;
    }

    /* 日曜日の背景 */
    #calendar .fc-day-sun {
        background-color: #fef2f2;
    }
    /* 平日の文字色を元に戻す */
#calendar .fc-col-header-cell-cushion,
#calendar .fc-daygrid-day-number {
    color: #111827 !important;
    text-decoration: none !important;
}
</style>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.min.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
              const events=@json($events);
                const calendarEl = document.getElementById('calendar');

                const calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    events: events,
                    locale: 'ja', // 日本語化
                    height: 'auto', // 高さを自動調整
                    firstDay: 1, // 週の開始曜日を日曜日に設定
                    eventDisplay: 'block',// 予定を「点」ではなく横長の帯で表示
                    displayEventEnd: true,    // 終了時間も表示

                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay, listWeek'
                        
                    
                        
                    },
                    buttonText: {
                        today: '今月',
                        month: '月',
                        week: '週',
                        day: '日',
                        list: 'リスト'
                    },
                    noEventsContent: '予定はありません', // イベントがない場合の表示
                    fixedWeekCount: false, // 月の表示を固定せず、必要に応じて行数を調整
                    showNonCurrentDates: false, // 前月・翌月の日付を非表示
                    
                    dateClick: function (info) {
                        // 日付をクリックしたときの処理
                        const date = info.dateStr;
                        const url = "{{ route('schedules.create') }}?date=" + date;
                        window.location.href = url;
                    },
                    eventMouseEnter: function (info) {
                    const start = info.event.start?.toLocaleString('ja-JP') ?? '未設定';
                    const end = info.event.end?.toLocaleString('ja-JP') ?? '未設定';
                  $(info.el).popover({
                    title: info.event.title,
                    content: `開始：${start}<br>
                    終了：${end}<br>
                    詳細：${info.event.extendedProps.description ?? 'なし'}`,
                    placement: 'top',
                    container: 'body',
                    html: true
                  }).popover('show');
              },
              eventMouseLeave: function (info) {
                $(info.el).popover('dispose');
              $('.popover').remove();
            },





                });

                calendar.render();
            });
        </script>
    @endpush
</x-layouts::app>