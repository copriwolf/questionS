<html lang="zh">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="telephone=no, email=no" name="format-detection">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="" name="description">
    <meta content="" name="keywords">
    <title>2017年豪华品牌净推荐值调研问卷</title>
    <link href="css/style.css" rel="stylesheet">
    <script>
      !function () {
          var a, b = document.documentElement;
          (a = function () {
              b.style.fontSize = (b.clientWidth > 640 ? 640 : b.clientWidth) / 375 * 625 + "%"
          })();
          window.addEventListener("resize", a, false);
      }();
    </script>
  </head>
  <body>
    <!--1.入口-->
    <div class="wrap wrap1">
      <div class="container">
        <p class="title word1">2017年<br>豪华品牌净推荐值</p>
        <p class="title1 word1">调查问卷</p><a class="enterBtn btn-loca1 word2">进入调查</a>
      </div>
    </div>
    <!--车主姓名-->
    <div class="wrap wrap2">
      <div class="container">
        <p class="tip1"><span class="user-name word3">车主姓名</span>
          <input class="input-name">
        </p><a class="enterBtn btn-loca2 word2">确认</a>
      </div>
    </div>
    <!--根据时间跳转-->
    <div class="wrap wrap3">
      <h1 class="q-title word6">2017年豪华品牌净推荐值调研问卷</h1>
      <div class="content word7">
        <h2 class="q-title-1 word1">甄别部分</h2>
        <div class="qBox">
          <p class="q-question word9">S1.【单选】请问您是否在__年__月 (档案中被访者车辆购买日期) 购买了一辆___品牌 (档案中被访者车辆品牌) 的车？</p>
          <ul class="q-1-ul">
            <li>1.是（根据时间，跳转内容）</li>
            <li>2.否（记录具体购车日期，根据时间，选择跳转问卷）</li>
          </ul>
          <table class="time-select-table">
            <tr>
              <th>时间</th>
              <th>跳转至问卷</th>
            </tr>
            <tr>
              <td>2017年1月-至今</td>
              <td><a class="a-link" id="sale">点击继续访问销售问卷</a></td>
            </tr>
            <tr>
              <td>2013年8月-2016年12月</td>
              <td><a class="a-link" id="afterSales">点击继续访问售后问卷</a></td>
            </tr>
            <tr>
              <td>2013年8月以前</td>
              <td><a class="a-link-end" id="end">致谢，终止</a></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    <!--销售问卷-->
    <div class="wrap wrap4">
      <h1 class="q-title word6">2017年豪华品牌净推荐值调研问卷<em class="word6-red"> (销售)</em></h1>
      <div class="content word7" id="content_4"></div>
    </div>
    <!--售后-->
    <div class="wrap wrap5">
      <h1 class="q-title word6">2017年豪华品牌净推荐值调研问卷<em class="word6-red"> (售后)</em></h1>
      <div class="content word7" id="content_5"></div>
    </div>
    <!--4.弹窗-->
    <div id="pop">
      <div class="msg msg-1">
        <h1 class="msg-tip1 word4">请选择你所在的4S门店</h1>
        <div class="placeBox">
          <h2 class="head word5"> 所在门店</h2>
        </div>
      </div>
      <div class="layer"></div>
    </div>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>
        

