<x-layouts::app :title="__('スケジュール登録')">
    {{-- ==================== ページ本体：ここから ==================== --}}
    <div class="w-full py-6">
        {{-- 登録に成功した場合のメッセージ --}}
        @if (session('status'))
            <div class="mx-auto mb-6 w-full max-w-xl rounded border border-green-200 bg-green-50 px-4 py-3 text-center text-sm text-green-800">
                {{ session('status') }}
            </div>
        @endif

        {{-- ==================== 登録カード：ここから ==================== --}}
        <div class="mx-auto w-full max-w-xl px-4">
            <div class="overflow-hidden rounded border border-gray-300 bg-white">
                {{-- カードの見出し --}}
                <div class="border-b border-gray-300 bg-gray-50 px-4 py-2">
                    <h1 class="text-sm font-medium text-gray-800">スケジュール登録</h1>
                </div>

                {{-- カードの入力エリア：ここから --}}
                <div class="px-8 py-6">
                    {{-- 入力内容にエラーがある場合は、すべてのメッセージを表示 --}}
                    @if ($errors->any())
                        <div class="mb-6 rounded-md border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                            <ul class="list-disc space-y-1 pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- ==================== 登録フォーム：ここから ==================== --}}
                    {{-- 入力内容は ScheduleController の store メソッドへ送信される --}}
                    <form method="POST" action="{{ route('schedules.store') }}">
                        {{-- クロスサイトリクエストフォージェリ対策 --}}
                        @csrf

                        {{-- ---------- タイトル欄：ここから ---------- --}}
                        <div class="mb-4 grid grid-cols-[90px_1fr] items-center gap-4">
                            <label for="title" class="text-right text-sm font-medium text-gray-700">タイトル</label>
                            {{-- タイトル入力とエラーメッセージを囲む部分 --}}
                            <div class="min-w-0">
                                <input type="text" id="title" name="title" value="{{ old('title') }}"
                                    class="w-full rounded-md border px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 @error('title') border-red-500 @else border-gray-300 @enderror"
                                    required autofocus>
                                @error('title')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        {{-- ---------- タイトル欄：ここまで ---------- --}}

                        {{-- ---------- 概要欄：ここから ---------- --}}
                        <div class="mb-4 grid grid-cols-[90px_1fr] items-start gap-4">
                            <label for="description" class="pt-2 text-right text-sm font-medium text-gray-700">概要</label>
                            <div class="min-w-0">
                                <textarea id="description" name="description" rows="3"
                                    class="w-full resize-y rounded-md border px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 @error('description') border-red-500 @else border-gray-300 @enderror">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        {{-- ---------- 概要欄：ここまで ---------- --}}

                        {{-- ---------- 開始日欄：ここから ---------- --}}
                        <div class="mb-4 grid grid-cols-[90px_1fr] items-center gap-4">
                            <label for="start_date" class="text-right text-sm font-medium text-gray-700">開始日</label>
                            <div class="min-w-0">
                                <input type="date" id="start_date" name="start_date" value="{{ old('start_date', request('date')) }}"
                                    class="w-full rounded-md border px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 @error('start_date') border-red-500 @else border-gray-300 @enderror"
                                    required>
                                @error('start_date')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        {{-- ---------- 開始日欄：ここまで ---------- --}}

                        {{-- ---------- 開始時間欄：ここから ---------- --}}
                        <div class="mb-4 grid grid-cols-[90px_1fr] items-center gap-4">
                            <label for="start_time" class="text-right text-sm font-medium text-gray-700">開始時間</label>
                            {{-- 開始時間入力とエラーメッセージを囲む部分 --}}
                            <div class="min-w-0">
                                <input type="time" id="start_time" name="start_time" value="{{ old('start_time') }}"
                                    class="w-full rounded-md border px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 @error('start_time') border-red-500 @else border-gray-300 @enderror"
                                    required>
                                @error('start_time')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        {{-- 上の2個目の閉じタグで「開始時間の行」を閉じている --}}
                        {{-- ---------- 開始時間欄：ここまで ---------- --}}

                        {{-- ---------- 終了日欄：ここから ---------- --}}
                        <div class="mb-4 grid grid-cols-[90px_1fr] items-center gap-4">
                            <label for="end_date" class="text-right text-sm font-medium text-gray-700">終了日</label>
                            {{-- 終了日入力とエラーメッセージを囲む部分 --}}
                            <div class="min-w-0">
                                <input type="date" id="end_date" name="end_date" value="{{ old('end_date', request('date')) }}"
                                    class="w-full rounded-md border px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 @error('end_date') border-red-500 @else border-gray-300 @enderror"
                                    required>
                                @error('end_date')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        {{-- 上の2個目の閉じタグで「終了日の行」を閉じている --}}
                        {{-- ---------- 終了日欄：ここまで ---------- --}}

                        {{-- ---------- 終了時間欄：ここから ---------- --}}
                        <div class="mb-5 grid grid-cols-[90px_1fr] items-center gap-4">
                            <label for="end_time" class="text-right text-sm font-medium text-gray-700">終了時間</label>
                            <div class="min-w-0">
                                <input type="time" id="end_time" name="end_time" value="{{ old('end_time') }}"
                                    class="w-full rounded-md border px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 @error('end_time') border-red-500 @else border-gray-300 @enderror"
                                    required>
                                @error('end_time')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        {{-- ---------- 終了時間欄：ここまで ---------- --}}

                        {{-- ---------- 登録ボタン：ここから ---------- --}}
                        <div class="grid grid-cols-[90px_1fr] gap-4">
                            <div></div>
                            <div>
                                <button type="submit"
                                    class="whitespace-nowrap rounded bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
                                    登録
                                </button>
                            </div>
                        </div>
                        {{-- ---------- 登録ボタン：ここまで ---------- --}}
                    </form>
                    {{-- ==================== 登録フォーム：ここまで ==================== --}}
                </div>
                {{-- カードの入力エリア：ここまで --}}
            </div>
        </div>
        {{-- ==================== 登録カード：ここまで ==================== --}}
    </div>
    {{-- ==================== ページ本体：ここまで ==================== --}}
</x-layouts::app>
