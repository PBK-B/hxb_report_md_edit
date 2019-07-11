<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <link rel="shoticon" href="./favicon.ico" type="image/x-icon">
  <meta name="viewport" content="width=device-width,height=device-height,initial-scale=1,user-scalable=0">
  <meta name="email" content="PBK-B@PBK6.cn">
  <meta name="description" content="报告邮件在线编辑生成系统，大量优质模版致力解决各种报告书写困难…">
  <title>报告在线编辑器_<?php echo isset($_GET['data']) ? $_GET['data'] : ''; ?>邮件在线编辑 - 哈希坊网络</title>
  <script>
    var data_test = "<?php echo isset($_GET['data']) ? $_GET['data'] : ''; ?>"
  </script>
  <script src="./js/index.js"></script>
  <link rel="stylesheet" href="./themes/github-v2.css" id="codeThemeId" />
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

    .active-model {
      position: fixed;
      width: 100vw;
      height: 100vh;
      z-index: 99999999;
      left: 0;
      top: 0;
      background: rgba(0, 0, 0, 0.5);
      transition: opacity 0.3s 0.1s;
      justify-content: center;
      align-items: center;
      display: flex;
      opacity: 1;
    }

    .active-model-topbuts {
      width: 1rem;
      height: 1rem;
      display: inline-block;
      margin: 5px;
      border-radius: 1.5rem;
    }

    .active-model-topbuts:hover {
      width: 1.1rem;
      height: 1.1rem;
    }

    .active-model-topbuts-green {
      background: #4CAF5099;
    }

    .active-model-topbuts-yellow {
      background: #FFC10799;
    }

    .active-model-topbuts-red {
      background: #FF572299;
    }

    .active-model-topbuts-green:hover {
      background: #4CAF50;
    }

    .active-model-topbuts-yellow:hover {
      background: #FFC107;
    }

    .active-model-topbuts-red:hover {
      background: #FF5722;
    }

    .setting-colorblock {
      width: 1rem;
      height: 1rem;
      display: inline-block;
      border: 1px solid #9E9E9E;
      margin-left: -1.6rem;
    }
  </style>
</head>

<body>

  <header class="col-editor-header">
    <div class="header-inner">
      <div class="header-main">
        <a onclick="javascript :history.back(-1);" class="header-back">重新选择</a>
      </div>
      <div class="header-opts">
        <button class="c-btn" data-clipboard-action="cut" data-clipboard-target="#outputCtt" id="cp_btn">全选报告</button>
        <button class="c-btn" id="st_btn" onclick="onSetting()">个性设置</button>
        <a href="/home" class="header-link user-center">
          <i class="com-avatar" style="background-image: url(&quot;https://haxibiao.com/image/head.jpg&quot;);"></i>
        </a>
      </div>
    </div>
  </header>

  <textarea id="input" spellcheck="false"></textarea>

  <div id="output">
    <div class="wrapper" id="outputCtt"></div>
  </div>

  <div class="active-model" style="visibility: hidden;" id="setting-active" onclick="offSetting()">

    <div class="themes-config" style="padding: 25px 50px 80px;background: #FFF;" onclick="ooo000()">

      <div>
        <div style="margin-left: auto;display: flex;min-height: 2.5rem;">
          <div style="margin-left: auto;min-width: 2rem;text-align: center;justify-content: center;">
            <p class="active-model-topbuts active-model-topbuts-red" title="关闭" onclick="offSetting()"></p>
          </div>
          <div style="min-width: 2rem;text-align: center;justify-content: center;">
            <p class="active-model-topbuts active-model-topbuts-yellow" title="恢复默认" onclick="SttingRes()"></p>
          </div>
          <div style="min-width: 2rem;text-align: center;justify-content: center;">
            <p class="active-model-topbuts active-model-topbuts-green" title="保存" onclick="SttingGo()"></p>
          </div>
        </div>
      </div>

      <div>
        <h2 style="margin-bottom: 0;">通用设置</h2>
        <div class="theme-wrapper">
          <label>页面主题选择：</label>
          <select class="page-theme"></select>
        </div>
        <div class="theme-wrapper">
          <label>代码主题选择：</label>
          <select class="code-theme"></select>
        </div>
      </div>
      <div>
        <h2 style="margin-top: 2.5rem;margin-bottom: 0;">个性设置</h2>
        <div class="theme-wrapper">
          <label>背景颜色：</label>
          <input type="text" value="#FFF" autocomplete="off" placeholder="请输入颜色代码" style="padding: 0 10px;"
            id="outputCtt_color"  οnkeypress="OutputCttColorEnterPress(event,'outputCtt_color')" onkeydown="OutputCttColorEnterPress(event,'outputCtt_color')">
          <i class="setting-colorblock" style="background: #4CAF50;" id="outputCtt_color_box"></i>
        </div>
        <div class="theme-wrapper">
          <label>标题字体颜色：</label>
          <input type="text" value="#FFF" autocomplete="off" placeholder="请输入颜色代码" style="padding: 0 10px;"
            id="font_color" οnkeypress="OutputCttColorEnterPress(event,'font_color')" onkeydown="OutputCttColorEnterPress(event,'font_color')">
          <i class="setting-colorblock" style="background: #4CAF50;" id="font_color_box"></i>
        </div>
      </div>

    </div>

  </div>


</body>

<script>
  window.onbeforeunload = function (e) {
    var e = window.event || e;
    e.returnValue = ("确定离开当前页面吗？");
  }

  var stting_data = {
    font_color: document.defaultView.getComputedStyle(document.getElementsByTagName('h2')[0], null).color,
    outputCtt_color: document.defaultView.getComputedStyle(document.getElementById('outputCtt'), null).backgroundColor
  };

  function onSetting() {

    // 获取标题字体颜色
    var title_font_color = document.defaultView.getComputedStyle(document.getElementsByTagName('h2')[0], null).color;
    document.getElementById('font_color').value = title_font_color;
    document.getElementById('font_color_box').style.backgroundColor = title_font_color;

    // 获取背景颜色
    var outputCtt_color = document.defaultView.getComputedStyle(document.getElementById('outputCtt'), null).backgroundColor;
    document.getElementById('outputCtt_color').value = outputCtt_color;
    document.getElementById('outputCtt_color_box').style.backgroundColor = outputCtt_color;

    document.getElementById('setting-active').style = "visibility: visible;";
  }

  function offSetting() {
    document.getElementById('setting-active').style = "visibility: hidden;";
  }

  function ooo000() {
    // 阻止事件冒泡
    window.event ? window.event.cancelBubble = true : e.stopPropagation();
  }

  function setHtagColor(color) {
    // 设置报告全部 h 标签字体颜色
    for (var i = 0; i < 6; i++) {
      var HTag = document.getElementsByTagName('h' + i);
      for (var i2 = 0; i2 < HTag.length; i2++) {
        HTag[i2].style.color = color;
      }
    }
  }

  function setOutputCttColor(color) {
    // 设置报告背景颜色
    document.getElementById('outputCtt').style.backgroundColor = color;
  }

  function SttingGo() {
    var tag_color = document.getElementById('font_color').value;
    setHtagColor(tag_color ? tag_color : '#000');
    var bj_color = document.getElementById('outputCtt_color').value;
    setOutputCttColor(bj_color ? bj_color : '#FFF');
    offSetting();
  }

  function SttingRes() {
    var tag_color = stting_data.font_color;
    setHtagColor(tag_color ? tag_color : '#000');
    var bj_color = stting_data.outputCtt_color;
    setOutputCttColor(bj_color ? bj_color : '#FFF');
    offSetting();
  }

  function OutputCttColorEnterPress(e,tag) {
    var e = e || window.event;
    if(e.keyCode == 13){
      // 监听回车事件
      var tag_color = document.getElementById(tag).value;
      document.getElementById(tag + '_box').style.backgroundColor = tag_color;
    }
  }

</script>

</html>