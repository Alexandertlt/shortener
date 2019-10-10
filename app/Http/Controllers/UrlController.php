<?php

namespace App\Http\Controllers;

use App\Http\Requests\UrlCreateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Url;

class UrlController extends Controller
{
    /**
     * Получаем список ссылок
     */
    public function index()
    {

        $items = Url::paginate(5);

        return view('main', compact('items'));

    }


    /**
     * Удаление одной записи
     */
    public function destroy($id)
    {
        $result = Url::destroy($id);

        if ($result) {
            return redirect()
                ->route('urls.index')
                ->with(['success' => "Запись удалена"]);
        } else {
            return back()->withErrors(['msg' => 'Ошибка удаления']);
        }
    }

    /**
     * Сама переадресация на длинный URL
     */
    public function shortenLink($path)
    {
        $item = Url::where('path', $path)->first();
        if (empty($item)) {
            abort(404);
        }

        // Считаем переходы
        $item->increment('counter');

        return redirect($item->origin);
    }

    /**
     * Подготовка информации для форма добавлений новой ссылки.
     * Предлагаем пользователю сгенерированный URL.
     * Пользователь может его изменить на свой
     */
    public function create()
    {

        $urlDomain = env('APP_URL') . '/';
        $urlPath = $this->generationRandomKey();

        return view('create', compact('urlDomain', 'urlPath'));
    }

    /**
     * Добавление новой ссылки
     * Проверка входных данных в UrlCreateRequest
     */
    public function store(UrlCreateRequest $request)
    {

        $data = $request->input();

        $item = (new Url())->create($data);

        if ($item) {
            return redirect()->route('urls.index')
                ->with(['success' => 'Успешно добавлено']);
        } else {
            return back()->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }

    }

    /**
     * Берем запись для формы редактирования ссылки
     */
    public function edit($id)
    {
        $item = Url::find($id);
        if (empty($item)) {
            abort(404);
        }

        // Получаем домен, где расположен сайт
        $urlDomain = env('APP_URL') . '/';

        return view('edit', compact('item', 'urlDomain'));
    }

    /**
     * Обновление записи.
     * Проверка входных данных в UrlCreateRequest
     */
    public function update(UrlCreateRequest $request, $id)
    {
        $item = Url::find($id);

        if(empty($item)){
            return back()
                ->withErrors(['msg' => "Запись id=[{$id}] не найдена"])
                ->withInput();
        }

        // Обнуляем счетчик
        $item->counter = 0;
        $item->save();

        $data = $request->all();

        $result = $item->update($data);

        if($result) {
            return redirect()
                ->route('urls.index', $item->id)
                ->with(['success' => 'Успешно сахранено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }


    /**
     * Генератор строки для короткой ссылки
     *
     * @return string
     */
    private function generationRandomKey()
    {
        return Str::random(6);

    }
}
