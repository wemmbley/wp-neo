<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@title</title>
    {{-- Easy assets integration --}}
    @style("css/main.css")
</head>
<body>
    {{-- PHP Code --}}
    @php
        echo 'Hi from template! This is clear PHP output!';
        echo 'Don\'t use it, but if needed you can do it!';
    @endphp

    {{-- Include other template --}}
    @include("hero-section")

    {{-- Default WP loop example --}}
    <div class="posts">
        @loop('films|category:action|orderby:date|limit:5')
            {{ $post->title() }}
        @empty
            Ничего не найдено
        @endloop
    </div>

    @include("testimonials")

    {{-- Form example --}}
    @form("contact-us")
        @input("name")->title("Имя")
        @input("number")->title("Номер мобильного")
        @textarea("text")->title("Текст")
    @endform

    {{-- Access to assets folder --}}
    <img src="@assets("img/my-section.png")" alt="section image">
</body>
<footer>
    {{-- Another wat to access assets folder and include script from it --}}
    @script("js/scripts.js")
</footer>
</html>