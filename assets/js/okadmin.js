/^http(s*):\/\//.test(location.href) || alert('请先部署到 localhost 下再访问');

var objOkTab = "";
layui.use(["element", "layer", "okUtils", "okTab", "okLayer", "okContextMenu"], function () {
var okUtils = layui.okUtils;
var $ = layui.jquery;
var layer = layui.layer;
var okLayer = layui.okLayer;

function randomStr(length = 4){
  var charactors="1234567890";
  value = "";
  for(j=1;j<=length;j++){
    i = parseInt(10*Math.random()); 　
    value = value + charactors.charAt(i);
  }
  return value;
}

var okTab = layui.okTab({
  url: "/admin/menu?t="+randomStr(4),
  openTabNum: 30,
  parseData: function (data) {
    return data;
  }
});
objOkTab = okTab;

/**
 * 左侧导航渲染完成之后的操作
 */
okTab.render(function () {
  /**tab栏的鼠标右键事件**/
  $("body .ok-tab").okContextMenu({
    width: 'auto',
    itemHeight: 30,
    menu: [
      {
        text: "定位所在页",
        icon: "ok-icon ok-icon-location",
        callback: function () {
          okTab.positionTab();
        }
      },
      {
        text: "关闭当前页",
        icon: "ok-icon ok-icon-roundclose",
        callback: function () {
          okTab.tabClose(1);
        }
      },
      {
        text: "关闭其他页",
        icon: "ok-icon ok-icon-roundclose",
        callback: function () {
          okTab.tabClose(2);
        }
      },
      {
        text: "关闭所有页",
        icon: "ok-icon ok-icon-roundclose",
        callback: function () {

          okTab.tabClose(3);
        }
      }
    ]
  });
});

/**
 * 添加新窗口
 */
$("body").on("click", "#navBar .layui-nav-item a, #userInfo a", function () {
  // 如果不存在子级
  if ($(this).siblings().length == 0) {
    okTab.tabAdd($(this));
  }
  // 关闭其他展开的二级标签
  $(this).parent("li").siblings().removeClass("layui-nav-itemed");
  if (!$(this).attr("lay-id")) {
    var topLevelEle = $(this).parents("li.layui-nav-item");
    var childs = $("#navBar > li > dl.layui-nav-child").not(topLevelEle.children("dl.layui-nav-child"));
    childs.removeAttr("style");
  }
});

/**
 * 左侧菜单展开动画
 */
$("#navBar").on("click", ".layui-nav-item a", function () {
  if (!$(this).attr("lay-id")) {
    var superEle = $(this).parent();
    var ele = $(this).next('.layui-nav-child');
    var height = ele.height();
    ele.css({"display": "block"});
    // 是否是展开状态
    if (superEle.is(".layui-nav-itemed")) {
      ele.height(0);
      ele.animate({height: height + "px"}, function () {
        ele.css({height: "auto"});
      });
    } else {
      ele.animate({height: 0}, function () {
        ele.removeAttr("style");
      });
    }
  }
});

/**
 * 左边菜单显隐功能
 */
$(".ok-menu").click(function () {
  $(".layui-layout-admin").toggleClass("ok-left-hide");
  $(this).find("i").toggleClass("ok-menu-hide");
  localStorage.setItem("isResize", false);
  setTimeout(function () {
    localStorage.setItem("isResize", true);
  }, 1200);
});

/**
 * 移动端的处理事件
 */
$("body").on("click", ".layui-layout-admin .ok-left a[data-url], .ok-make", function () {
  if ($(".layui-layout-admin").hasClass("ok-left-hide")) {
    $(".layui-layout-admin").removeClass("ok-left-hide");
    $(".ok-menu").find('i').removeClass("ok-menu-hide");
  }
});

/**
 * tab左右移动
 */
$("body").on("click", ".okNavMove", function () {
  var moveId = $(this).attr("data-id");
  var that = this;
  okTab.navMove(moveId, that);
});

/**
 * 刷新当前tab页
 */
$("body").on("click", ".ok-refresh", function () {
  okTab.refresh(this);
});

/**
 * 关闭tab页
 */
$("body").on("click", "#tabAction a", function () {
  var num = $(this).attr("data-num");
  okTab.tabClose(num);
});

/**
 * 键盘的事件监听
 */
$("body").on("keydown", function (event) {
  event = event || window.event || arguments.callee.caller.arguments[0];

  // 按 Esc
  if (event && event.keyCode === 27) {
    console.log("Esc");
    $("#fullScreen").children("i").eq(0).removeClass("layui-icon-screen-restore");
  }
  // 按 F11
  if (event && event.keyCode == 122) {
  	console.log("F11");
    $("#fullScreen").children("i").eq(0).addClass("layui-icon-screen-restore");
  }
});

/**
 * 全屏/退出全屏
 */
$("body").on("click", "#fullScreen", function () {
  if ($(this).children("i").hasClass("layui-icon-screen-restore")) {
    screenFun(2).then(function () {
      $("#fullScreen").children("i").eq(0).removeClass("layui-icon-screen-restore");
    });
  } else {
    screenFun(1).then(function () {
      $("#fullScreen").children("i").eq(0).addClass("layui-icon-screen-restore");
    });
  }
});

/**
 * 全屏和退出全屏的方法
 * @param num 1代表全屏 2代表退出全屏
 * @returns {Promise}
 */
function screenFun(num) {
  num = num || 1;
  num = num * 1;
  var docElm = document.documentElement;

  switch (num) {
    case 1:
      if (docElm.requestFullscreen) {
        docElm.requestFullscreen();
      } else if (docElm.mozRequestFullScreen) {
        docElm.mozRequestFullScreen();
      } else if (docElm.webkitRequestFullScreen) {
        docElm.webkitRequestFullScreen();
      } else if (docElm.msRequestFullscreen) {
        docElm.msRequestFullscreen();
      }
      break;
    case 2:
      if (document.exitFullscreen) {
        document.exitFullscreen();
      } else if (document.mozCancelFullScreen) {
        document.mozCancelFullScreen();
      } else if (document.webkitCancelFullScreen) {
        document.webkitCancelFullScreen();
      } else if (document.msExitFullscreen) {
        document.msExitFullscreen();
      }
      break;
  }

  return new Promise(function (res, rej) {
    res("返回值");
  });
}


/**
 * 捐赠作者
 */
$(".layui-footer button.donate").click(function () {
  layer.tab({
    area: ["330px", "350px"],
    tab: [{
      title: "支付宝",
      content: "<img src='/assets/images/alipay.png' width='256' height='256' style='margin: 0 auto; display: block;'>"
    }, {
      title: "微信",
      content: "<img src='/assets/images/weixin.jpg' width='256' height='340' style='margin: 0 auto; display: block;'>"
    }]
  });
});

/**
 * 退出操作
 */
$("#logout").click(function () {
  okLayer.confirm("确定要退出吗？", function (index) {
    window.location = "/adminlogin/out.html";
  });
});

/**
 * 弹窗皮肤
 */
$("#reUserInfo").click(function () {
  okLayer.open("基本资料", "/admin/info.html", "50%", "50%",
    function (layero) {
    }, function () {
  });
});

/**
 * 弹窗皮肤
 */
$("#rePwd").click(function () {
  okLayer.open("修改密码", "/admin/repwd.html", "50%", "50%", function (layero) {
  }, function () {
  });
});



console.log("系统：DDVideo" +
    "版本：v1.0\n" +
    "作者：midoks\n" +
    "邮箱：midoks@163.com\n" +
    "描述：一个很简单的视频管理系统！");
});
