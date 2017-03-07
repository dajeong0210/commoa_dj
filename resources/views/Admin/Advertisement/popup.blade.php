<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Exo+2" rel="stylesheet">
    <link href="/css/normalize.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
    
    
    <!-- Scripts -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app" class="admin">
    <div class="page list mypage admin" id="popup">
        <div class="form">
            <form class="validate" name="advertisement" enctype="multipart/form-data">
                <div class="group">
                    <div class="form-group">
                        <label for="ad_image">이미지</label>
                        <input type="file" id="ad_image" name="image{{$index-1}}" class="required"/>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="id" value="{{$index-1}}"/>
                        <input type="hidden" name="image" value=""/>
                    </div>
                </div>
                <div class="group">
                    <input type="submit" class="btn submit" value="전송">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Scripts -->
<script src="/js/app.js"></script>
<script type="text/javascript" src="/js/jquery.validate.js"></script>
<script type="text/javascript" src="/js/additional-methods.js"></script>
<script type="text/javascript" src="/js/messages_ko.min.js"></script>
<script type="text/javascript" src="{{ url('/').'/js/adminScript.js' }}"></script>
</body>
</html>