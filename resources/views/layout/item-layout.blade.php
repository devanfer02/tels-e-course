<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('assets/icons/icon.png') }}">
    <script src="https://cdn.tiny.cloud/1/ltw3td3zvtwubfcv1jcwmmaa65o1ok8m1gjls0md2icsauij/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      function loadTinyMCE() {
        tinymce.init({
          selector: 'textarea',
          plugins: 'media code table lists image link',
          toolbar: 'image | undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table | media | link',
          setup: function(editor) {
            editor.on('keydown', function(e){
              if(e.keyCode===9) {
                editor.insertContent('\t\t')
                e.preventDefault();
              }
            })

            editor.on('change', function (e) {
              editor.save();
            });
          }
        });
      }

      function loadTinyAfter() {
        setTimeout(() => {
          loadTinyMCE()
        }, 1000)
      }

      loadTinyMCE()
    </script>
    @vite(['resources/css/app.css', 'resources/css/app.scss', 'resources/js/app.js'])
    <style>
      ol li {
        list-style-type: decimal;
      }
      html {
        scroll-behavior: smooth;
      }
    </style>
    @livewireStyles
    <title><?= $pageTitle?></title>
</head>
<body class="tw-h-screen tw-flex">
    @include('components.sidebar')
    <main class="tw-flex-1 tw-overflow-auto tw-pb-16">
      @yield('content')
    </main>
    @livewireScripts
</body>
<script src="{{ asset('js/script.js') }}"></script>
</html>
