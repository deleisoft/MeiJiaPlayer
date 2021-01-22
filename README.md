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

如果您需要解决音乐资源跨地区限制，请再部署您的反向代理：

```shell
# 修改\plugns\Meting.php   配置您的反向代理服务器地址
```
<img src="https://raw.githubusercontent.com/deleisoft/ChineseMusic/main/images/1.png">

```shell
# 以Nginx反向代理配置为例：
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


## :gear: 构建

自行构建前需要拥有 `Go >= 1.13`、`yarn`等必要依赖。

#### 克隆代码

```shell
git clone --recurse-submodules https://github.com/cloudreve/Cloudreve.git
```

#### 构建静态资源

```shell
# 进入前端子模块
cd assets
# 安装依赖
yarn install
# 开始构建
yarn run build
```

#### 嵌入静态资源

```shell
# 回到项目主目录
cd ../

# 安装 statik, 用于嵌入静态资源
go get github.com/rakyll/statik

# 开始嵌入
statik -src=assets/build/  -include=*.html,*.js,*.json,*.css,*.png,*.svg,*.ico -f
```

#### 编译项目

```shell
# 获得当前版本号、Commit
export COMMIT_SHA=$(git rev-parse --short HEAD)
export VERSION=$(git describe --tags)

# 开始编译
go build -a -o cloudreve -ldflags " -X 'github.com/cloudreve/Cloudreve/v3/pkg/conf.BackendVersion=$VERSION' -X 'github.com/cloudreve/Cloudreve/v3/pkg/conf.LastCommit=$COMMIT_SHA'"
```

你也可以使用项目根目录下的`build.sh`快速开始构建：

```shell
./build.sh  [-a] [-c] [-b] [-r]
	a - 构建静态资源
	c - 编译二进制文件
	b - 构建前端 + 编译二进制文件
	r - 交叉编译，构建用于release的版本
```

## :alembic: 技术栈

* [Go ](https://golang.org/) + [Gin](https://github.com/gin-gonic/gin)
* [React](https://github.com/facebook/react) + [Redux](https://github.com/reduxjs/redux) + [Material-UI](https://github.com/mui-org/material-ui)

## :scroll: 许可证

GPL V3

---
> GitHub [@HFO4](https://github.com/HFO4) &nbsp;&middot;&nbsp;
> Twitter [@abslant00](https://twitter.com/abslant00)
