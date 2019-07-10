<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="shoticon" href="./favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width,height=device-height,initial-scale=1,user-scalable=0">
    <meta name="description" content="Markdown 排版工具">
    <title>邮件 Markdown 排版工具</title>
    <script>
        var data_test = "<?php echo isset($_GET['data']) ? $_GET['data'] : ''; ?>"
    </script>
    <script src="./js/index.js"></script>
    <link rel="stylesheet" href="./themes/github-v2.css" id="codeThemeId" />
    <link rel="stylesheet" href="index.css" />
    <link rel="stylesheet" id="pageThemeId" />
    <style type="text/css">
        html,
        body {
            height: 100%;
        }

        .topheader {
            width: 100%;
            float: left;
        }

        #input {
            width: 50%;
            position: absolute;
            left: 0px;
        }

        #output {
            width: 50%;
            position: absolute;
            left: 50%;
            margin: 0;
        }

        .convert-button,
        .copy-button {
            position: inherit;
        }
    </style>
</head>

<body>
    <!-- <div class="topheader">
        <a href="#">
            <h1>Zm Markdown 排版工具</h1>
        </a>
        <span></span>
        <ul>
            <li class="forkbtn">
                <div class="theme-wrapper">
                    <button class="btn copy-button" data-clipboard-action="cut"
                        data-clipboard-target="#outputCtt">复制</button>
                </div>
            </li>
            <li class="forkbtn">
                <div class="theme-wrapper">
                    <button class="btn copy-button">设置</button>
                </div>
            </li>
        </ul>
    </div> -->
    <header class="col-editor-header">
        <div class="header-inner">
            <div class="header-main">
                <a onclick="javascript :history.back(-1);" class="header-back">重新选择</a>
            </div>
            <div class="header-opts">
                <button class="c-btn" data-clipboard-action="cut" data-clipboard-target="#outputCtt"
                    id="cp_btn">全选报告</button>
                <button class="c-btn">个性设置</button>
                <a href="/home" class="header-link user-center">
                    <i class="com-avatar"
                        style="background-image: url(&quot;https://haxibiao.com/image/head.jpg&quot;);"></i>
                </a>
            </div>
        </div>
    </header>

    <!--编辑-->
    <textarea id="input" spellcheck="false"></textarea>

    <!--预览-->
    <div id="output" class="themes-config">
        <div class="theme-wrapper" style="display: none;">
            <label>页面主题选择：</label><select class="page-theme"></select><br><br>
            <label>代码主题选择：</label><select class="code-theme"></select>
        </div>

        <div class="wrapper" id="outputCtt"></div>
    </div>

</body>


<script>
    window.onbeforeunload = function (e) {
        var e = window.event || e;
        e.returnValue = ("确定离开当前页面吗？");
    }
</script>

</html>
