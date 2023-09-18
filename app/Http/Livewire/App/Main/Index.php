<?php

namespace App\Http\Livewire\App\Main;

use App\Models\Article;
use App\Models\Carousel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
/*
        if ( Auth::user() ) {
            $this->redirect(route('panel.order.index'));
        }
*/
        $displayItems = [];

        if(config('bap.home.display-carousels')) {
            $carousels = Carousel::where('language', app()->getLocale())->orderBy('created_at', 'DESC')->take(config('bap.home.count-carousels'))->get();
            $displayItems = ['carousels' => $carousels];
        }

        if(config('bap.home.display-articles')) {
            $articles = Article::where('language', app()->getLocale())->orderBy('created_at', 'DESC')->take(config('bap.home.count-articles'))->get();
            $displayItems['articles'] = $articles;
        }

        return view('livewire.app.main.index', $displayItems);
    }
}
