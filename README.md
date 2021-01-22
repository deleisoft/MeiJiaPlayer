<h1 align="center">
  <br>
  <a href="#" alt="logo" ><img src="https://raw.githubusercontent.com/deleisoft/ChineseMusic/main/images/p1.png" width="150" style="border-radius: 58px;"/></a>
  <br>
  ChineseMusic—MeiJia
  <br>
</h1>

<h4 align="center">基于PHP开发的音乐在线播放器</h4>

<p align="center">
  <a href="https://travis-ci.com/github/cloudreve/Cloudreve/">
    <img src="https://img.shields.io/travis/com/cloudreve/Cloudreve?style=flat-square"
         alt="travis">
  </a>
  <a href="#"><img src="https://img.shields.io/codecov/c/github/cloudreve/Cloudreve?style=flat-square"></a>
  <a href="#">
      <img src="https://goreportcard.com/badge/github.com/cloudreve/Cloudreve?style=flat-square">
  </a>
  <a href="#">
    <img src="https://img.shields.io/github/v/release/cloudreve/Cloudreve?include_prereleases&style=flat-square">
  </a>
</p>

![Screenshot](https://raw.githubusercontent.com/deleisoft/ChineseMusic/main/images/p2.png)

## 特性

* 极易部署，将静态资源上传至PHP服务器可立即工作；
* 支持检索解析网易云/酷狗/QQ音乐资源，API接口不易失效；
* 支持自定义URL回源，节约CDN流量；
* 开放式的歌单增删改查，数据以Json保存，无需数据库；
* 具有跨域解决地区限制的音乐流媒体播放特性；
* 自适应UI，正如所见的那样，它从IE9+向上兼容；

## 部署

下载完整代码包上传至PHP服务器，直接运行即可。

以上为最简单的部署示例，您可以参考 [跨地区限制](#) 进行更为完善的部署。

解决流媒体跨地区限制，需要配合反向代理，步骤如下：

```shell
# 修改\plugns\Meting.php   配置您的反向代理服务器地址
```
<img src="https://raw.githubusercontent.com/deleisoft/ChineseMusic/main/images/1.png">

```shell
# 以Nginx反代为例：

location /kugou/
{
    resolver 114.114.114.114;
    proxy_pass http://fs.ios.kugou.com/;
    proxy_set_header Host fs.ios.kugou.com;
}
location /wyy/ 
{
    resolver 114.114.114.114;
    set_by_lua $tou '
    local arg = ngx.req.get_uri_args()["tou"]
    return arg';
    set_by_lua $url '
    local arg = ngx.req.get_uri_args()["url"]
    return arg';
    proxy_pass http://$tou.music.126.net/$url;
    proxy_set_header Host $tou.music.126.net;
    proxy_set_header Range $http_Range;
}
```
完成以上配置，您的流媒体将在反代服务器进行中转，至此您将不再受地区限制（取决于服务器所在地）

## 版本

<p>我们使用 <a href="https://semver.org/lang/zh-CN/" target="_blank">https://semver.org/lang/zh-CN/</a> 进行版本控制。有关可用的版本，请:book:<a href="#">此存储库中的标记</a>。</p>

## 作者

* <strong>Billie Thompson</strong> - <em>Initial work</em> - <a href="https://links.jianshu.com/go?to=https%3A%2F%2Fgithub.com%2FPurpleBooth" target="_blank">PurpleBooth</a>

> GitHub [@deleisoft](https://github.com/deleisoft) &nbsp;&middot;&nbsp;
> Twitter [@tongzhongyan](https://twitter.com/tongzhongyan)

## 致谢

```shell
# 进入前端子模块
cd assets
# 安装依赖
yarn install
# 开始构建
yarn run build
```

## :alembic: 技术栈

* [Go ](https://golang.org/) + [Gin](https://github.com/gin-gonic/gin)
* [React](https://github.com/facebook/react) + [Redux](https://github.com/reduxjs/redux) + [Material-UI](https://github.com/mui-org/material-ui)

## :scroll: 许可证

<p>此项目根据 MIT 许可证获得许可 - 有关详细信息，请参阅 <a href="#">LICENSE.md</a> 文件。</p>

GPL V3
