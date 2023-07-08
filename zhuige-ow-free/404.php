<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>404</title>

    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
            background: #F2F2F2;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            background: #F2F2F2;
            height: 100%;
        }

        .zhuige-fof {
            text-align: center;
        }

        .zhuige-fof img {
            width: 280px;
            height: auto;
        }

        .zhuige-fof h2 {
            font-size: 16px;
            font-weight: 500;
            padding: 10px 0;
        }

        .zhuige-fof p {
            font-size: 12px;
            color: #999999;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="zhuige-fof">
            <img src="<?php echo get_stylesheet_directory_uri() . '/images/404.jpg' ?>" alt=" " />
            <h2>这里好像什么也没有...</h2>
            <p>您所查看的页面不存在，返回首页看看其他的吧</p>
        </div>
    </div>
    <script>
        setTimeout(() => {
            window.location.href = '/';
        }, 2000)
    </script>
</body>

</html>