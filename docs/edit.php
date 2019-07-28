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
    var data_test = "<?php echo isset($_GET['data']) ? $_GET['data'] : ''; ?>";
    // 图片上传 API，api = 接口 url ，file = 文件参数
    var upload_c = { 
      api : "https://sm.ms/api/upload",
      file : "smfile"
    };

    function getUpImg(e) {
      // 图片上传回调，需要返回图片 URL
      return e.data.url;
    }
    // var upload_c = { 
    //   api : "http://haxibiao.local/api/image/upload",
    //   file : "picfile"
    // };
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

  <div style="height: 100%;width: 50%;">
    <div style="position: absolute;width: 50%;height: 100%;background-color: #999E;left: 0;z-index: 10;visibility: hidden;" id="upload-model">
      <p style="text-align: center;color: #FFF;font-size: 30px;justify-content: center;line-height: calc(100vh - 64px);margin: 0;" id="upload-win">拖拽图片至此可以上传！</p>
      <button style="position: absolute;top: 50%;right: calc(50% - 2rem);text-align: center;background: #FFF;padding: 0.6rem 2rem;" onclick="offUploadModel();">取消</button>
    </div>
    <textarea id="input" spellcheck="false"></textarea>
  </div>

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

  <div class="active-model" style="visibility: hidden;" id="test-active" onclick="offModel('test-active')">

    <div class="themes-config" style="padding: 25px 50px 80px;background: #FFF;" onclick="ooo000()">

      <div>
        <div style="margin-left: auto;display: flex;min-height: 2.5rem;">
          <div style="margin-left: auto;min-width: 2rem;text-align: center;justify-content: center;">
            <p class="active-model-topbuts active-model-topbuts-red" title="关闭" onclick="offModel('test-active')"></p>
          </div>
          <div style="min-width: 2rem;text-align: center;justify-content: center;">
            <p class="active-model-topbuts active-model-topbuts-yellow" title="恢复默认" onclick="offModel('test-active')"></p>
          </div>
          <div style="min-width: 2rem;text-align: center;justify-content: center;">
            <p class="active-model-topbuts active-model-topbuts-green" title="保存" onclick="offModel('test-active')"></p>
          </div>
        </div>
      </div>

      <div>
        <h2 style="margin-top: 2.5rem;margin-bottom: 0;">Test 测试</h2>
        <div class="theme-wrapper">
          <label>测试：</label>
          <input type="text" value="#FFF" autocomplete="off" placeholder="代码" style="padding: 0 10px;"
            id="font_color" οnkeypress="OutputCttColorEnterPress(event,'font_color')" onkeydown="OutputCttColorEnterPress(event,'font_color')">
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

  var us_OutputCttColor = localStorage.us_OutputCttColor ? localStorage.us_OutputCttColor : stting_data.outputCtt_color ;
  var us_HtagColor = localStorage.us_HtagColor ? localStorage.us_HtagColor : stting_data.font_color;
  
  setOutputCttColor(us_OutputCttColor);
  setHtagColor(us_HtagColor);
	
  document.getElementById('input').value = '#666';

  // 打开设置弹窗
  function onSetting() {

    // 获取标题字体颜色
    var title_font_color = document.defaultView.getComputedStyle(document.getElementsByTagName('h2')[0], null).color;
    document.getElementById('font_color').value = title_font_color;
    document.getElementById('font_color_box').style.backgroundColor = title_font_color;

    // 获取背景颜色
    var outputCtt_color = document.defaultView.getComputedStyle(document.getElementById('outputCtt'), null).backgroundColor;
    document.getElementById('outputCtt_color').value = outputCtt_color;
    document.getElementById('outputCtt_color_box').style.backgroundColor = outputCtt_color;

    onModel('setting-active');
  }

  // 关闭设置弹窗
  function offSetting() {
    offModel('setting-active');
  }

  // 打开指定弹出层
  function onModel(id) {
    document.getElementById(id).style.visibility = "visible";
  }

  // 关闭指定弹出层
  function offModel(id) {
    document.getElementById(id).style.visibility = "hidden";
  }

  function ooo000() {
    // 阻止事件冒泡
    window.event ? window.event.cancelBubble = true : e.stopPropagation();
  }

  // 添加css设置全局 h 标签字体颜色
  function setHtagColor(color) {

    // 设置报告全部 h 标签字体颜色 ( 该方法有Bug,被废弃 )
    // for (var i = 0; i < 6; i++) {
    //   var HTag = document.getElementsByTagName('h' + i);
    //   for (var i2 = 0; i2 < HTag.length; i2++) {
    //     HTag[i2].style.color = color;
    //   }
    // }

	localStorage.us_HtagColor=color;
    // 添加css设置全局 h 标签字体颜色
    addCSS('h1,h2,h3,h4,h5,h6{ color:'+ color +';}');

  }

  // 设置报告背景颜色
  function setOutputCttColor(color) {
    document.getElementById('outputCtt').style.backgroundColor = color;
	localStorage.us_OutputCttColor=color;
  }

  // 应用设置
  function SttingGo() {
    var tag_color = document.getElementById('font_color').value;
    setHtagColor(tag_color ? tag_color : '#000');
    var bj_color = document.getElementById('outputCtt_color').value;
    setOutputCttColor(bj_color ? bj_color : '#FFF');
    offSetting();
  }

  // 还原设置
  function SttingRes() {
    var tag_color = stting_data.font_color;
    setHtagColor(tag_color ? tag_color : '#000');
    var bj_color = stting_data.outputCtt_color;
    setOutputCttColor(bj_color ? bj_color : '#FFF');
    offSetting();
  }

  // 监听颜色设置编辑框回车事件
  function OutputCttColorEnterPress(e,tag) {
    var e = e || window.event;
    if(e.keyCode == 13){
      // 监听回车事件
      var tag_color = document.getElementById(tag).value;
      document.getElementById(tag + '_box').style.backgroundColor = tag_color;
    }
  }

  // 添加css辅助方法
  function addCSS(cssText){
    // 创建一个style元素并获取head元素
    var style = document.createElement('style'),head = document.head || document.getElementsByTagName('head')[0];
    style.type = 'text/css';
    // 这里必须显示设置style元素的type属性为text/css，否则在ie中不起作用
    if(style.styleSheet){
      var func = function(){
          try {
            // 防止IE中stylesheet数量超过限制而发生错误
            style.styleSheet.cssText = cssText;
          }catch(e) {

          }
      }
      // 如果当前styleSheet还不能用，则放到异步中则行
      if(style.styleSheet.disabled){
        setTimeout(func,10);
      } else {
        func();
      }
    } else {
      // w3c浏览器中只要创建文本节点插入到style元素中就行了
      var textNode = document.createTextNode(cssText);
      style.appendChild(textNode);
    }
    // 把创建的style元素插入到head中
    head.appendChild(style);
  }

  // 获取光标辅助方法
  function getCursorPosition(textarea) {
    var rangeData = {text: "", start: 0, end: 0 };
    textarea.focus();
    if (textarea.setSelectionRange) { // W3C
        rangeData.start= textarea.selectionStart;
        rangeData.end = textarea.selectionEnd;
        rangeData.text = (rangeData.start != rangeData.end) ? textarea.value.substring(rangeData.start, rangeData.end): "";
    } else if (document.selection) { // IE
        var i,
            oS = document.selection.createRange(),
            // Don't: oR = textarea.createTextRange()
            oR = document.body.createTextRange();
        oR.moveToElementText(textarea);

        rangeData.text = oS.text;
        rangeData.bookmark = oS.getBookmark();

        // object.moveStart(sUnit [, iCount])
        // Return Value: Integer that returns the number of units moved.
        for (i = 0; oR.compareEndPoints('StartToStart', oS) < 0 && oS.moveStart("character", -1) !== 0; i ++) {
            // Why? You can alert(textarea.value.length)
            if (textarea.value.charAt(i) == '\n') {
                i ++;
            }
        }
        rangeData.start = i;
        rangeData.end = rangeData.text.length + rangeData.start;
    }

    return rangeData;
  }

  function insertAtCursor(myField, myValue) {
    if (document.selection) {
        // IE support
        myField.focus();
        sel = document.selection.createRange();
        sel.text = myValue;
        sel.select();
    } else if (myField.selectionStart || myField.selectionStart == '0') {
        // MOZILLA/NETSCAPE support
        var startPos = myField.selectionStart;
        var endPos = myField.selectionEnd;
        var beforeValue = myField.value.substring(0, startPos);
        var afterValue = myField.value.substring(endPos, myField.value.length);

        myField.value = beforeValue + myValue + afterValue;

        myField.selectionStart = startPos + myValue.length;
        myField.selectionEnd = startPos + myValue.length;
        myField.focus();
    } else {
        myField.value += myValue;
        myField.focus();
    }
  }

  setTimeout(funcName(),500);

  function funcName() {
    // getCursorPosition(document.getElementById('input'));
    insertAtCursor(document.getElementById('input'),"33333");
  }


</script>

<script>

  (function () {

    // 阻止浏览器默认行
    document.addEventListener("dragleave", function (e) {
      // 拖离窗口事件
      e.preventDefault();
      // offUploadModel();
    }, false);
    document.addEventListener("drop", function (e) {
      // 拖放到窗口事件
      e.preventDefault();
      offUploadModel();
    }, false);
    document.addEventListener("dragenter", function (e) {
      // 拖
      e.preventDefault();
      // offUploadModel();
    }, false);
    document.addEventListener("dragover", function (e) {
      // 拖入窗口事件
      e.preventDefault();
      onUploadModel();
    }, false);
    
    // 拖拽区域 
    var box = document.getElementById('upload-win');
    box.addEventListener("drop", function (e) {
        // 取消默认浏览器拖拽效果
        e.preventDefault();
        // 获取文件对象 
        var fileList = e.dataTransfer.files;

        // 检测是否是拖拽文件到页面的操作 
        if (fileList.length == 0) {
            return false;
        }
        //检测文件是不是图片 
        if (fileList[0].type.indexOf('image') === -1) {
            alert("你拖的不是图片！");
            return false;
        }

        // 拖拉图片到浏览器，可以实现预览功能 
        // var img = window.webkitURL.createObjectURL(fileList[0]);
        // 获取图片名称
        var filename = fileList[0].name; 
        var filesize = Math.floor((fileList[0].size) / 1024);
        if (filesize > 500) {
          alert("上传大小不能超过500K.");
          return false;
        }
        // var str = "<img src='" + img + "'><p>图片名称：" + filename + "</p><p>大小：" + filesize + "KB</p>";
        // document.getElementById("preview").innerHTML = str;

        // 上传
        xhr = new XMLHttpRequest();
        xhr.open("post", upload_c.api, true);
        var fd = new FormData();
        fd.append(upload_c.file, fileList[0]);
        xhr.onreadystatechange = function () {
          if (xhr.readyState === XMLHttpRequest.DONE && xhr.status >= 200 && xhr.status <= 201) {
            // console.log(JSON.parse(xhr.responseText).data.path);
            insertAtCursor(document.getElementById('input'),"\n!["+ filename +"]("+ getUpImg(JSON.parse(xhr.responseText)) +")");
          }
          offUploadModel();
          document.getElementById('input').dispatchEvent(new Event('keydown'));
        }
        xhr.send(fd);

    }, false);

  })();

  function offUploadModel() {
    document.getElementById('upload-model').style.visibility = "hidden";
  }

  function onUploadModel() {
    document.getElementById('upload-model').style.visibility = "visible";
  }

</script>

</html>