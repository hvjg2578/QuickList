# QuickList 文件目录列表系统
QuickList是Chuanrui系列文件目录列表系统的第二版，可用作下载站，个人网盘系统（暂不支持上传，第三版会逐步支持），相比于第一版CFDL Drive和其他文件目录列表系统，增加了分离式存储系统，即将目录列表节点和数据存储节点分离。

该项目前端与CFDL Drive相同，后端代码进行了重写，之前的代码有些冗余。



### 在开始之前

首先你要知道这个项目是干啥的，这是一个分离式存储的文件目录列表系统，即将目录列表节点和数据存储节点分离。目录列表节点负责用户交互，即提供下载等多种选项，数据存储节点用于存储文件并向用户传输文件。

### 有什么用呢？

应用1： 假设说你家里有公网ip，但是运营商不给开放80端口，你只能用域名:端口的形式来给外网你还有一台支持PHP的虚拟主机或服务器，有80端口，但是存储容量或者传输速度很弱（例如阿里的小水管）这时，你就可以把你家里的服务器用作数据传输节点，把阿里的服务器用作目录列表节点，这样，你既有传输速度，又能不带端口号访问，而且还能物尽其用。

应用2，可将数据传输节点的源码用作数据传输的API使用，用于获取文件信息和传输文件使用。

其他应用等待大家去探索。。。。

### DEMO

目录列表节点http://clientdemo.quicklist.1314.cool

数据传输节点http://serdemo.quicklist.1314.cool

#### 注意事项：

在配置时，要注意分清数据传输节点和目录列表节点分别的功能和作用。

### 联系作者

作者邮箱：admin@1314.cool

作者博客：https://blog.1314.cool

### 项目Git仓库

GitHub仓库：https://github.com/hvjg2578/QuickList


### 这是一个非常简洁的说明



### 特性

1.支持给文件夹设置密码

方法：在你要设置密码的文件夹内放置一个密码文件，文件名默认为：ChuanruiDirPassword.txt，此文件名称可以在config.php中更改（强烈建议你更改此文件名称！）

然后编辑密码文件，在里面输入文件夹密码

2. 支持在线预览xlsx，pptx，docx，等多种Office办公文件。

3. 支持在线预览视频、音频和图片文件（具体支持哪些视频和音频，取决于你的浏览器）

4. 支持在线预览XML，txt文件

5. 支持在线预览php，c等代码文件

4. pdf等文件预览，将在后续更新中加入
### 安装教程

#### 首先安装数据传输节点

1. 下载并解压仓库中的数据传输节点文件夹中的文件到你的站点根目录

2. 配置listpassconfig.php文件内的内容，填写方式和注意事项已经在文件内注明

3. 如果要开启伪静态，请填写如下伪静态规则，

Nginx：

```
if (!-f $request_filename)
{
     rewrite '^(.*)$' /index.php?f=$1;
}

if (-f $request_filename)
{

}

```

然后更改listpassconfig.php的rewrite选项为true


#### 然后安装目录列表节点

1. 下载并解压仓库中的目录列表节点文件夹中的文件到你的站点根目录

2. 配置config.php文件内的内容，填写方式和注意事项已经在文件内注明，

3. 如果要开启伪静态，请填写如下伪静态规则，此规则与数据传输节点相同

Nginx：

```
if (!-f $request_filename)
{
     rewrite '^(.*)$' /index.php?f=$1;
}

if (-f $request_filename)
{

}

```

然后更改listpassconfig.php的rewrite选项为true

### 注意

如果数据传输节点中设置的download_method中设置的为PHP，下载大文件请更改php超时时间，否则超时会断流。


### 开源许可证

本项目采用**GNU General Public License (GPL) V3**许可证开源

如果**不同意**此许可证，**请勿**使用本程序

本项目在编写过程中参考的项目：

1. Parsedown：项目地址：https://gitee.com/JonahXie/parsedown

2. 其他项目，例如404页面，我是从百度上看的，没有找到原作者，如果作者看见了，可以给我发邮件，我会把你的项目添上
