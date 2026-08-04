<x-layouts::app :title="__('スケジュール編集')">
<style>
  
  </style>
    <div class="w-full py-6">

        {{-- 登録成功メッセージ --}}
        @if (session('status'))
            <div class="mb-6 w-full border border-green-200 bg-green-100 py-3 text-center text-sm text-green-800">
                {{ session('status') }}
            </div>
        @endif

        {{-- カードを中央へ配置 --}}
        <div class="mx-auto w-full max-w-xl px-4">

            <div class="overflow-hidden rounded border border-gray-300 bg-white">

                {{-- カード見出し --}}
                <div class="border-b border-gray-300 bg-gray-50 px-4 py-2">
                    <h1 class="text-sm font-medium">
                        スケジュール編集
                    </h1>
                </div>

                <div class="px-8 py-6">

                    {{-- 入力エラー --}}
                    @if ($errors->any())
                        <div class="mb-5 rounded border border-red-300 bg-red-50 p-3 text-sm text-red-700">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form
                        id="update-form"
                        method="POST"
                        action="{{ route('schedules.update', $schedule) }}">
                        @csrf
                        @method('PUT')
                        

                        {{-- タイトル --}}
                        <div class="mb-4 grid grid-cols-[90px_1fr] items-center gap-4">

                            <label
                                for="title"
                                class="text-right text-sm"
                            >
                                タイトル
                            </label>

                            <div>
                                <input
                                    type="text"
                                    id="title"
                                    name="title"
                                    value="{{ old('title', $schedule->title) }}"
                                    class="w-full rounded border px-3 py-2 text-sm
                                        @error('title')
                                            border-red-500
                                        @else
                                            border-gray-300
                                        @enderror"
                                    required
                                    autofocus
                                >

                                @error('title')
                                    <p class="mt-1 text-sm text-red-500">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                        </div>

                        {{-- 概要 --}}
                        <div class="mb-4 grid grid-cols-[90px_1fr] items-start gap-4">

                            <label
                                for="description"
                                class="pt-2 text-right text-sm"
                            >
                                概要
                            </label>

                            <div>
                                <textarea
                                    id="description"
                                    name="description"
                                    rows="3"
                                    class="w-full rounded border px-3 py-2 text-sm
                                        @error('description')
                                            border-red-500
                                        @else
                                            border-gray-300
                                        @enderror"
                                >{{ old('description', $schedule->description ) }}</textarea>

                                @error('description')
                                    <p class="mt-1 text-sm text-red-500">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                        </div>
                      {{-- ---------- 開始日欄：ここから ---------- --}}
                        <div class="mb-4 grid grid-cols-[90px_1fr] items-center gap-4">
                            <label for="start_date" class="text-right text-sm font-medium text-gray-700">開始日</label>
                            <div class="min-w-0">
                                <input type="date" id="start_date" name="start_date" value="{{ old('start_date', $schedule->start_date) }}"
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
                                <input type="time" id="start_time" name="start_time" value="{{ old('start_time', $schedule->start_time) }}"
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
                                <input type="date" id="end_date" name="end_date" value="{{ old('end_date', $schedule->end_date) }}"
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
                                <input type="time" id="end_time" name="end_time" value="{{ old('end_time', $schedule->end_time) }}"
                                    class="w-full rounded-md border px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 @error('end_time') border-red-500 @else border-gray-300 @enderror"
                                    required>
                                @error('end_time')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        {{-- ---------- 終了時間欄：ここまで ---------- --}}


                    </form>

                    {{-- 削除フォームと更新ボタンは、更新フォームの外に置く --}}
                    <div class="mt-6 flex items-center justify-center gap-6">
                        <form method="POST" action="{{ route('schedules.destroy', $schedule) }}">
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="whitespace-nowrap rounded bg-red-600 px-4 py-2 text-sm text-white hover:bg-red-700"
                                onclick="return confirm('本当に削除しますか？')"
                            >
                                削除
                            </button>
                        </form>

                        <button
                            type="submit"
                            form="update-form"
                            class="whitespace-nowrap rounded bg-blue-600 px-4 py-2 text-sm text-white hover:bg-blue-700"
                        >
                            更新
                        </button>
                    </div>

                </div>

            </div>

        </div>

    </div>

</x-layouts::app>
