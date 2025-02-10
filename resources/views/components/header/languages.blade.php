<li class="list-inline-item dropdown hidden-xs hidden-sm">
    <a class="text-muted" href="javascript:void(0)" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img src="{{asset("assets/images/flags/".app()->getLocale().".png")}}" class="mg-b-5 wd-20 img-fluid" alt="">
    </a>
    <ul class="dropdown-menu languages-dropdown shadow-2">
        @foreach(config('app.locales') as $lang)
            @continue($lang == app()->getLocale())
            <li>
                <a href="{{route('dashboard.changeLang', $lang)}}" data-lang="{{$lang}}">
                    <img src="{{asset("assets/images/flags/".$lang.".png")}}" class="img-fluid wd-20" alt="">
                    <span>{{$lang == 'uz' ? 'Uzbek' : 'Русский'}}</span>
                </a>
            </li>
        @endforeach
    </ul>
</li>
