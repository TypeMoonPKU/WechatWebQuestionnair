# WechatWebQuestionnair
微信意见收集系统，支持出勤统计（微信版问卷星！）
## 开发环境
推荐使用wamp进行一键式安装。
* MySQL：5.5+
* PHP：5.5+ 
* Apache：2.4+
* 开发工具：推荐使用 PhpStorm（主要工具 版本：2016.1） 和 WebStorm 进行开发。

生产环境版本如下：

* OS: Ubuntu 14.04 LTS server x64
* MySQL: 5.5.47
* PHP：5.5.9
* Apache: 2.4.7 

## 目录含义
* ./api 存放问卷系统需要调用的API
    * 获取数据的API以get开头，返回json格式数据
    * 更改数据的API以set开头
* ./onlyForLocalHost 存放系统初次使用时的配置文件。
* ./wxq 关键文件夹，用户访问应用时的主要文件夹。
* ./util 功能函数所在的文件夹。

## 常用链接
* https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx75de8782f8e4f99c&redirect_uri=121.201.14.58%2fwxq%2fwxapi.php&response_type=code&scope=snsapi_base#wechat_redirect
    获取有关的用户信息。
##问题定义
##可行性分析
##需求分析
##项目计划
##成本分析
##测试计划