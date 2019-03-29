
# EFPHP 简介
EFPHP(easy fast php) 是一个易于上手的高性能PHP框架。

# 为什么要使用EFPHP
足够简单：框架的核心文件仅有8个，且平均每个文件只有100行。虽然很少，但已经可以稳定运行了。
        你觉得完全掌握这8个文件需要1天吗？

高效稳定：此框架经历过多个项目高并发项目的验证，可以在20亿日PV下稳定运行。

容易扩展：因为框架结构设计的十分清晰简洁，所以很容易做出能够保证质量的扩展，相比大型框架要简单太多。

没错，本框架的设计理念就是简单，高效，易重构。

这3个设计理念在高并发和持续迭代的项目中十分重要。

## 简单
一个简单的有多重要呢？
* 节省时间：大型框架，从初步了解到彻底掌握，一般情况下至少要1个月；简单框架，从初步了解到彻底掌握，不超过3天。
* 容易重构：大型框架，重构难度很大，结果难以预估，可能因为未知的关联而导致bug或潜在bug；简单框架，重构难度很小，
          而且结果完全可控。
* 技术提高：学习小型框架会比学习大型框架需要的时间少很多，省下的时间如果花在PHP源码学习上，
          比学习PHP框架所带来的提高要大的多。毕竟源码才是根本。
    
## 高效
* 被迫重构：PHP项目经常会被使用在高访问量的场景下，框架本身的性能如果不高，在访问量增大时程序员会遇到大麻烦（被迫重构），
          因为任何公司都不会随意投入硬件设备，除非你的理由足够充分。
          如果你经历过被迫重构，你一定不想经历第二次。
* 主动重构：另一种场景是，由于框架性能太好，业务需求又不多，程序员只能自己换个语言比如go来主动重构，
          毕竟闲着就意味着技术没有提高，技术不提高收入怎么能提高呢。
* 多余功能：大型框架提供了很多功能，甚至多到你只用了10%就可以完成自己的项目，
          而那90%没用到的功能只能产生拖累你快速开发的绊脚石。
          当你的项目遇到bug时，你可能要为哪些无用功能花费大量时间，因为你不知道哪里出了问题。
          而在简单框架中，你可以快速定位问题的范围，因为一共也没有多少功能。
* 快速调试：你也许遇到过写一个业务功能花了2天，结果为了调试通过花了3天的情况。平均来看，
          程序员花费的开发时间有近一半是在处理各种问题。一个简单的框架会让你减少花费在非业务功能上的调试时间，
          使你的工作更有效率。
    
## 易重构
* 场景变更：业务场景变了，还用之前的框架吗？
          每个框架都有擅长的领域，如果用对事半功倍，用错那就连事倍功半都达不到。
          不存在适用于所有场景的框架，那是不是要每个项目都要重新做一次框架选型？
          选型之后就是重新学习？再摸索着使用？那留给自己的只能是各种各样的困难。
* 最终框架：一个简单的框架，你可以花3天时间全部掌握，在此基础上重构出完全匹配公司业务场景的内部框架，
          这个新框架可以帮你节省大量的时间，这才是你需要的。
          很重要的一个经验是：最合适的框架都是定制的。

# EFPHP以后会更新成什么样子
* EFPHP将会持续更新，但不会变成一个拥有复杂框架库的大型框架，这违背了框架设计的初衷。
* EFPHP将会提供更多更安全的模块（位于module目录，每个文件就是1个模块，没有相互依赖关系），以加快项目开发，是的，为了效率。
* EFPHP将会逐步升级为一个简单、设计精巧、高性能、高安全、模块丰富、适用于快速开发和重构的PHP框架。
* EFPHP将始终控制框架的学习时间，即对PHP语法达到熟练程度的程序员学习时间不超过3天，工作2年的程序员应该能达到熟悉PHP语法的要求吧。

# EFPHP 框架目录

app 目录是存放业务代码的目录。
lib 目录是框架文件目录，你重构框架时需要改动此目录。
config.php文件是项目配置文件，包括数据库，缓存等配置都在此文件中。
    
    project  
       ├─app                               应用目录（demo）
       │  ├─controllers                    控制器目录
       │  │  ├─index                       控制器分组目录
       │  │  │   └─IndexController.php     控制器（demo)
       │  │  └─BaseController.php          控制器基类（demo)
       │  │
       │  ├─models                         模型目录
       │  │  └─NewsModel.php               模型（demo)
       │  │
       │  ├─services                       服务目录
       │  │  └─index                       服务分组目录
       │  │      └─NewsService.php         新闻服务（demo)
       │  │ 
       │  └─views                          视图目录
       │     └─index                       控制器分组目录（demo)
       │         └─index                   控制器名（demo)
       │            ├─index.php            方法名视图（demo)
       │            └─newslist.php         方法名视图（demo)
       │
       ├─lib                               框架目录
       │  ├─module                         模块目录
       │  │  ├─MysqliModule.php            mysqli模块 		
       │  │  └─RedisModule.php             redis模块 
       │  │ 		
       │  ├─Controller.php                 框架-控制器基类
       │  ├─Model.php                      框架-模型基类
       │  ├─Request.php                    框架-请求类
       │  ├─Service.php                    框架-服务基类
       │  ├─Start.php                      框架-入口类
       │  └─View.php                       框架-视图类
       │   
       ├─public                            公开访问目录（静态资源和站点入口）
       │  ├─50x.html                       500错误页面
       │  ├─404.html                       404错误页面
       │  └─index.php                      框架入口文件（单一入口指向文件）
       │
       └─config.php                        框架配置文件




